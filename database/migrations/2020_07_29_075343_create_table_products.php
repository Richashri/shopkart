<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('category_id');
            $table->integer('section_id');
            $table->integer('brand_id');
            $table->longText('description')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('other_images')->nullable();
            $table->longText('video')->nullable();
            $table->float('weight', 8, 2)->nullable();
            $table->string('color')->nullable();
            $table->string('fit')->nullable();
            $table->float('mrp', 8, 2);
            $table->float('price', 8, 2);
            $table->float('discount', 8, 2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('meta_title')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->integer('order')->nullable();            
            $table->enum('is_featured', ['No', 'Yes'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_products');
    }
}
