<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_product_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_whatsapp');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer'])->default('cash');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
        
        // Add foreign key constraint after admin_products table is created
        // This will be handled by a separate migration or manually after both tables exist
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
