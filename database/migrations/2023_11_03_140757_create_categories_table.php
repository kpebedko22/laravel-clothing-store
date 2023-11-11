<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('categories')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('root_category_id')
                ->nullable()
                ->references('id')
                ->on('categories')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('path');
            $table->json('breadcrumbs');
            $table->timestamps();

            $table->index(['_lft', '_rgt', 'parent_id']);
            $table->index(['path']);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['root_category_id']);
            $table->dropForeign(['parent_id']);
        });

        Schema::dropIfExists('categories');
    }
};
