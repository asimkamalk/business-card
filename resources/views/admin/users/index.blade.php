@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-users mr-3"></i>
    {{ __('User Management') }}
</h2>
<p class="text-indigo-100 mt-2">Manage and monitor all platform users</p>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body {
        font-family: "Inter", sans-serif;
    }
    .users-wrapper {
        background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        margin-top: -3rem;
        margin-bottom: -3rem;
        min-height: calc(100vh - 200px);
        padding: 2rem 1rem;
    }
    @media (min-width: 768px) {
        .users-wrapper {
            padding: 2rem 1.5rem;
        }
    }
    @media (min-width: 1024px) {
        .users-wrapper {
            padding: 2rem 2rem;
        }
    }
    .stats-grid-users {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
        margin-bottom: 2rem !important;
    }
    @media (min-width: 640px) {
        .stats-grid-users {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    @media (min-width: 1024px) {
        .stats-grid-users {
            grid-template-columns: repeat(5, 1fr) !important;
        }
    }
    .stats-grid-users > div {
        width: 100% !important;
        max-width: 100% !important;
    }
</style>
@endpush

@section('content')
<style>
    .users-wrapper {
        background-color: #f3f4f6 !important;
        margin-left: -1.5rem !important;
        margin-right: -1.5rem !important;
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
        min-height: calc(100vh - 200px) !important;
        padding: 2rem 1rem !important;
    }
    @media (min-width: 768px) {
        .users-wrapper {
            padding: 2rem 1.5rem !important;
        }
    }
    @media (min-width: 1024px) {
        .users-wrapper {
            padding: 2rem 2rem !important;
        }
    }
    .stats-grid-users {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
        margin-bottom: 2rem !important;
        width: 100% !important;
    }
    @media (min-width: 640px) {
        .stats-grid-users {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    @media (min-width: 1024px) {
        .stats-grid-users {
            grid-template-columns: repeat(5, 1fr) !important;
        }
    }
    .stats-grid-users > * {
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
    }
    
    /* Dropdown styling for better visibility */
    select#bulkAction {
        color: #111827 !important;
        background-color: white !important;
    }
    
    select#bulkAction option {
        color: #111827 !important;
        background-color: white !important;
    }
    
    select#bulkAction:focus {
        outline: none;
        border-color: white;
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
    }
</style>
<div class="users-wrapper">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <main style="max-width: 1280px; margin: 0 auto; width: 100%;">
        <!-- Stats Cards -->
        <div class="stats-grid-users" style="display: grid !important;">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-indigo-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white shadow-lg mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white shadow-lg mr-4">
                        <i class="fas fa-user-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Active</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['active'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center text-white shadow-lg mr-4">
                        <i class="fas fa-user-slash text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Suspended</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['suspended'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pending</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white shadow-lg mr-4">
                        <i class="fas fa-trash text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Deleted</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['deleted'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or username..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="suspended" {{ $status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="deleted" {{ $status === 'deleted' ? 'selected' : '' }}>Deleted</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
                <div>
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white flex items-center justify-between">
                <h3 class="font-heading font-bold text-xl flex items-center">
                    <i class="fas fa-users mr-2"></i>Users
                </h3>
                @if($users->count() > 0)
                <form id="bulkActionForm" method="POST" action="{{ route('admin.users.bulk-action') }}" class="flex items-center gap-3">
                    @csrf
                    <select name="action" id="bulkAction" class="px-4 py-2.5 bg-white text-gray-900 border-2 border-white/30 rounded-lg focus:ring-2 focus:ring-white focus:border-white transition shadow-sm font-medium">
                        <option value="" class="text-gray-900">Bulk Actions</option>
                        <option value="suspend" class="text-gray-900">Suspend</option>
                        <option value="activate" class="text-gray-900">Activate</option>
                        <option value="delete" class="text-gray-900">Delete</option>
                        <option value="restore" class="text-gray-900">Restore</option>
                    </select>
                    <button type="submit" class="px-5 py-2.5 bg-white text-indigo-600 rounded-lg hover:bg-gray-50 font-semibold shadow-md hover:shadow-lg transition">
                        Apply
                    </button>
                </form>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="{{ $user->trashed() ? 'bg-red-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!$user->is_admin)
                                <input type="checkbox" name="users[]" value="{{ $user->id }}" class="user-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $user->username ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->trashed())
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Deleted</span>
                                @else
                                {!! $user->statusBadge !!}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->is_admin)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Admin</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    @if($user->trashed())
                                        @if(!$user->is_admin)
                                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" title="Restore">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Permanently Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @else
                                        @if(!$user->is_admin)
                                            @if($user->status === 'suspended')
                                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900" title="Restore/Activate">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('admin.users.suspend', $user->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="Suspend" onclick="return confirm('Are you sure you want to suspend this user?');">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                        <span class="text-gray-400 text-xs">Admin User</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                No users found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    // Select All functionality
    document.getElementById('selectAll')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk action form validation
    document.getElementById('bulkActionForm')?.addEventListener('submit', function(e) {
        const action = document.getElementById('bulkAction').value;
        const checked = document.querySelectorAll('.user-checkbox:checked');
        
        if (!action) {
            e.preventDefault();
            alert('Please select an action');
            return false;
        }
        
        if (checked.length === 0) {
            e.preventDefault();
            alert('Please select at least one user');
            return false;
        }
        
        const actionText = action.charAt(0).toUpperCase() + action.slice(1);
        if (!confirm(`Are you sure you want to ${action} ${checked.length} user(s)?`)) {
            e.preventDefault();
            return false;
        }
    });
</script>
@endpush
