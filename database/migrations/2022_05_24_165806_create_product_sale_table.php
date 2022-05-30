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
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')
                ->nullable()
                ->constrained('sales')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete()
                ->nullOnDelete();
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
        Schema::dropIfExists('product_sale');
    }
};
