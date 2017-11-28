<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->default(0)->comment = 'seller_id of the seller, 0 for Admin';
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('size');
            $table->tinyInteger('condition')->default(1)->comment = '1 = New, 2 = Used';
            $table->string('department');
            $table->float('standard_price', 10, 2);
            $table->float('discounted_price', 10, 2);
            $table->float('discounted_percentage', 10, 2);
            $table->integer('quantity');
            $table->integer('shipping_template_id')->unsigned()->nullable();
            $table->text('key_feature');
            $table->text('description');
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('shipping_template_id')->references('id')->on('shipping_templates')->onDelete('set null');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
