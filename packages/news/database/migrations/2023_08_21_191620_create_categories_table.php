<?php

use Akrbdk\News\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(Category::DEFAULT_INT)->index();
            $table->boolean('active')->default(false)->index();
            $table->integer('sort')->default(Category::DEFAULT_SORT)->index();
            $table->char('locale', 2)->default('ua')->index();
            $table->string('alias')->nullable()->default(null)->index();
            $table->string('title')->nullable();
            $table->timestamps();

            $table->unique(['locale', 'alias']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
