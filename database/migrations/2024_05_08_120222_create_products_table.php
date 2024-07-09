<?php

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
            $table->string('product_name');
            $table->unsignedBigInteger('category_id');
            $table->text('description')->nullable();
            $table->decimal('actual_price',10,2);
            $table->decimal('tax_rate',10,2);
            $table->string('unit');
            $table->enum('availablity_status',['available','not_available']);
            $table->time('preparation_time')->nullable();
            $table->decimal('discount',10,2);
            $table->integer('available_qty');
            $table->integer('minimum_qty');
            $table->decimal('final_price',10,2);  
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
