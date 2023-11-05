<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->references('id')
                ->on('categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('color_id')
                ->references('id')
                ->on('colors')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('size_id')
                ->references('id')
                ->on('sizes')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->unsignedBigInteger('price');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['size_id']);
            $table->dropForeign(['color_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('products');
    }
};
