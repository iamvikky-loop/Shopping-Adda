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
    Schema::create('products', function (Blueprint $table) {

        $table->id();

        $table->foreignId('category_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('sub_category_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('brand_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('name');

        $table->string('slug')->unique();

        $table->string('sku')->unique();

        $table->longText('description')->nullable();

        $table->decimal('price',10,2);

        $table->decimal('sale_price',10,2)->nullable();

        $table->integer('stock')->default(0);

        $table->float('weight')->nullable();

        $table->string('thumbnail')->nullable();

        $table->boolean('featured')->default(false);

        $table->boolean('trending')->default(false);

        $table->boolean('status')->default(true);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
