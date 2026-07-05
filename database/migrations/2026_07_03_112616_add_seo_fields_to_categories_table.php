<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->string('banner')->nullable()->after('image');

            $table->string('icon')->nullable()->after('banner');

            $table->string('meta_title')->nullable()->after('icon');

            $table->text('meta_description')->nullable()->after('meta_title');

        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropColumn([
                'banner',
                'icon',
                'meta_title',
                'meta_description',
            ]);

        });
    }
};