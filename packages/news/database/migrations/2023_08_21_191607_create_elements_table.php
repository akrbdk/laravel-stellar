<?php

use Akrbdk\News\Models\Element;
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
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(Element::DEFAULT_INT)->index();
            $table->unsignedBigInteger('category_id')->nullable()->default(Element::DEFAULT_INT)->index();
            $table->boolean('active')->default(false)->index();
            $table->integer('sort')->nullable()->default(Element::DEFAULT_SORT)->index();
            $table->unsignedBigInteger('preview_image')->nullable()->default(Element::DEFAULT_INT);
            $table->unsignedBigInteger('main_image')->nullable()->default(Element::DEFAULT_INT);
            $table->timestamp('publish_date')->nullable()->index();
            $table->timestamp('active_from')->nullable()->index();
            $table->timestamp('active_to')->nullable()->index();
            $table->char('locale', 2)->default('ua')->index();
            $table->string('alias')->nullable()->default(null)->index();
            $table->string('title')->nullable();
            $table->text('preview_text')->nullable();
            $table->text('body_text')->nullable();
            $table->timestamps();
            $table->unique(['category_id', 'locale', 'alias']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements');
    }
};
