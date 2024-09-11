<?php

use App\Enums\ProductType;
use App\Enums\PublishStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('type')->default(ProductType::COMMODITY);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->text('short_description')->nullable();
            $table->text('body')->nullable();
            $table->integer('price');
            $table->integer('inventory')->default(1);
            $table->foreignId('image_id');
            $table->tinyInteger('status')->default(PublishStatuses::DRAFTED);
            $table->timestamps();
            $table->softDeletes();
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
