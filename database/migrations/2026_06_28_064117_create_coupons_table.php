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
    Schema::create('coupons', function (Blueprint $table) {

        $table->id();

        $table->string('code')->unique();

        $table->enum('type', ['Percentage', 'Fixed']);

        $table->decimal('value', 10, 2);

        $table->decimal('minimum_order', 10, 2)->default(0);

        $table->integer('usage_limit')->default(1);

        $table->integer('used')->default(0);

        $table->date('expiry_date');

        $table->boolean('status')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
