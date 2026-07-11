<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('tracking_number')->nullable()->after('order_status');

            $table->string('courier')->nullable()->after('tracking_number');

            $table->date('expected_delivery')->nullable()->after('courier');

            $table->timestamp('delivered_at')->nullable()->after('expected_delivery');

            $table->text('customer_note')->nullable()->after('delivered_at');

            $table->text('admin_note')->nullable()->after('customer_note');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'tracking_number',
                'courier',
                'expected_delivery',
                'delivered_at',
                'customer_note',
                'admin_note',
            ]);

        });
    }
};