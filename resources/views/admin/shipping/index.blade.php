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
        Schema::create('customer_addresses', function (Blueprint $table) {

            $table->id();

            // User
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Customer Details
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('mobile',20);
            $table->string('alternate_mobile',20)->nullable();

            // Address
            $table->string('country')->default('India');
            $table->string('state');
            $table->string('city');
            $table->string('pincode',10);

            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();

            $table->string('landmark')->nullable();

            // Home / Office / Other
            $table->enum('address_type',[
                'Home',
                'Office',
                'Other'
            ])->default('Home');

            // Default Address
            $table->boolean('is_default')
                ->default(false);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};