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

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_dish_id');
            $table->unsignedBigInteger('side_dish_id');
            $table->unsignedBigInteger('dessert_id');
            $table->decimal('price', 8, 2);
            $table->timestamps();
            
            $table->foreign('main_dish_id')->references('id')->on('main_dishes')->onDelete('cascade');
            $table->foreign('side_dish_id')->references('id')->on('side_dishes')->onDelete('cascade');
            $table->foreign('dessert_id')->references('id')->on('desserts')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
