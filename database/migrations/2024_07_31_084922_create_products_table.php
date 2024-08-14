<?php

use App\Models\Category;
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
            $table->foreignIdFor(Category::class)->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('img_thumbnail')->nullable();
            $table->double('price_regular');
            $table->double('price_sale')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('material')->nullable()->conment('Chat lieu');
            $table->text('user_manual')->nullable()->comment('Huong dan su dung');
            // $table->enum('status', ['draft', 'pending-review', 'published'])->default(true);
            // $table->date('published_at')->comment('Lap lich');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('views');
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_good_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_show_home')->default(false);
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
