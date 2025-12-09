<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\AdminProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new order.
     */
    public function create($productId)
    {
        $product = AdminProduct::where('is_active', true)->findOrFail($productId);
        return view('orders.create', compact('product'));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request, $productId)
    {
        $product = AdminProduct::where('is_active', true)->findOrFail($productId);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_whatsapp' => 'required|string|max:20',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:cash,card,bank_transfer',
        ]);

        $order = Order::create([
            'admin_product_id' => $product->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_whatsapp' => $validated['customer_whatsapp'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'customer_address' => $validated['customer_address'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'total_amount' => $product->price,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('orders.success', $order->id)
            ->with('success', 'Your order has been placed successfully! We will contact you soon.');
    }

    /**
     * Display order success page.
     */
    public function success($id)
    {
        $order = Order::with('adminProduct')->findOrFail($id);
        return view('orders.success', compact('order'));
    }
}

