<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            #Category Relation
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('image');                      #Product Picture
            $table->string('name');                         #Product Name
            $table->date('production_date');                #Product Production Date
            $table->date('expiry_date');                    #Product Expiry Date
            $table->string('price');                        #Product Price
            $table->string('barcode_number');               #Barcode Number
            $table->string('unit');                         #Unit
            $table->boolean('is_available')->default(true); #Product Available
            $table->string('description');                      #Product Details
            $table->timestamps();                           #Created At and Updated At
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
};
