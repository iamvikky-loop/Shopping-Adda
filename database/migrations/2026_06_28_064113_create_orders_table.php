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

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->foreignId('address_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('order_number')->unique();

        $table->decimal('subtotal', 10, 2);

        $table->decimal('shipping_charge', 10, 2)->default(0);

        $table->decimal('discount', 10, 2)->default(0);

        $table->decimal('tax', 10, 2)->default(0);

        $table->decimal('grand_total', 10, 2);

        $table->enum('payment_method', [
            'COD',
            'UPI',
            'CARD',
            'NETBANKING',
            'WALLET'
        ]);

        $table->enum('payment_status', [
            'Pending',
            'Paid',
            'Failed',
            'Refunded'
        ])->default('Pending');

        $table->enum('order_status', [
            'Pending',
            'Confirmed',
            'Packed',
            'Shipped',
            'Out For Delivery',
            'Delivered',
            'Cancelled',
            'Returned'
        ])->default('Pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
