<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BlacklistedEmail;
use App\Notifications\AccountStatusChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        $query = User::withTrashed();

        if ($status !== 'all') {
            if ($status === 'deleted') {
                $query->onlyTrashed();
            } else {
                $query->where('status', $status);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);
        $users->appends(['status' => $status, 'search' => $search]);

        $stats = [
            'total' => User::count(),
            'active' => User::active()->count(),
            'suspended' => User::suspended()->count(),
            'pending' => User::pending()->count(),
            'deleted' => User::onlyTrashed()->count(),
        ];

        return view('admin.users.index', compact('users', 'stats', 'status', 'search'));
    }

    public function suspend(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot suspend an admin user.');
        }

        $user->update(['status' => 'suspended']);

        // Send status change notification
        $user->notify(new AccountStatusChangedNotification('suspended'));

        Log::info('User suspended', [
            'user_id' => $user->id,
            'suspended_by' => auth()->id(),
            'email' => $user->email
        ]);

        return back()->with('success', 'User suspended successfully!');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        
        if ($user->is_admin) {
            return back()->with('error', 'Cannot modify an admin user.');
        }

        // If user is soft deleted, restore them
        if ($user->trashed()) {
            $user->restore();
        }
        
        // Update status to active
        $user->update(['status' => 'active']);

        // Send status change notification
        $user->notify(new AccountStatusChangedNotification('active'));

        Log::info('User restored', [
            'user_id' => $user->id,
            'restored_by' => auth()->id(),
            'email' => $user->email
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User restored successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot delete an admin user.');
        }

        $email = $user->email;
        
        // Send status change notification before deletion
        $user->notify(new AccountStatusChangedNotification('deleted', 'Account deleted by administrator'));
        
        $user->delete();

        // Add email to blacklist
        BlacklistedEmail::firstOrCreate(['email' => $email], [
            'reason' => 'User account deleted by admin'
        ]);

        Log::info('User soft deleted', [
            'user_id' => $user->id,
            'deleted_by' => auth()->id(),
            'email' => $email
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User moved to trash successfully!');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->is_admin) {
            return back()->with('error', 'Cannot permanently delete an admin user.');
        }

        $user->profile?->delete();
        $user->forceDelete();

        Log::info('User permanently deleted', [
            'user_id' => $user->id,
            'deleted_by' => auth()->id(),
            'email' => $user->email
        ]);

        return redirect()->route('admin.users.index', ['status' => 'deleted'])
            ->with('success', 'User permanently deleted!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:suspend,activate,delete,restore',
            'users' => 'required|array|min:1'
        ]);

        $users = User::whereIn('id', $request->users)->get();
        $action = $request->action;
        $count = 0;

        foreach ($users as $user) {
            if ($user->is_admin) continue; // Skip admin users

            switch ($action) {
                case 'suspend':
                    if ($user->status !== 'suspended') {
                        $user->update(['status' => 'suspended']);
                        $user->notify(new AccountStatusChangedNotification('suspended'));
                        $count++;
                    }
                    break;
                case 'activate':
                    if ($user->status !== 'active') {
                        $user->update(['status' => 'active']);
                        $user->notify(new AccountStatusChangedNotification('active'));
                        $count++;
                    }
                    break;
                case 'delete':
                    if (!$user->trashed()) {
                        $user->notify(new AccountStatusChangedNotification('deleted', 'Account deleted by administrator'));
                        $user->delete();
                        $count++;
                    }
                    break;
                case 'restore':
                    if ($user->trashed()) {
                        $user->restore();
                        $user->update(['status' => 'active']);
                        $user->notify(new AccountStatusChangedNotification('active'));
                        $count++;
                    }
                    break;
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', "Successfully performed {$action} action on {$count} users.");
    }
}
