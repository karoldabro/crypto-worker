<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) { 
            $table->uuid('id'); 
            $table->string('external_id')->comment('Id on exchange')->nullable(); 
            $table->uuid('active_strategy_id'); 
            $table->uuid('strategy_id'); 
            $table->uuid('exchange_id'); 
            $table->string('status')->comment('Describes what is happening with order'); 
            $table->string('symbol'); 
            $table->string('type'); 
            $table->string('side')->comment('Long or Short'); 
            $table->double('price',20,12); 
            $table->integer('quantity'); 
            $table->double('activation_price',20,12)->nullable(); 
            $table->double('stop_loss',20,12)->nullable(); 
            $table->timestamp('registered_at')->comment('When is registered on exchange')->nullable(); 
            $table->timestamp('executed_at')->comment('When is activated at exchange')->nullable(); 
            $table->timestamp('closed_at')->nullable(); 
            $table->primary(['id']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
