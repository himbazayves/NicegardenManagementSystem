<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('cheif_id')->nullable();
            $table->integer('waiter_id')->nullable();
            $table->integer('stock_manager_id')->nullable();
            $table->integer('resto_chef_id')->nullable();
            $table->integer('accountant_id')->nullable();
            $table->integer('house_keeper_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('user_id');
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('product_requests');
    }
}
