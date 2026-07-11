<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_settings', function (Blueprint $table) {

            $table->id();

            $table->enum('shipping_type', [
                'flat',
                'free',
                'weight',
                'location'
            ])->default('flat');

            $table->decimal('shipping_charge',10,2)->default(0);

            $table->decimal('free_shipping_above',10,2)->default(0);

            $table->decimal('cod_charge',10,2)->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_settings');
    }
};