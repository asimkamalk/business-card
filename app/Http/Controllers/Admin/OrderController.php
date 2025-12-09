<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with('adminProduct')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with('adminProduct')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,completed,cancelled',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the specified order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}

