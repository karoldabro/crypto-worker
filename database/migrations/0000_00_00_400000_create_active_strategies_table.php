<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveStrategiesTable extends Migration
{
    public function up()
    {
        Schema::create('active_strategies', function (Blueprint $table) { 
            $table->uuid('id'); 
            $table->uuid('strategy_id'); 
            $table->uuid('exchange_id'); 
            $table->string('pair'); 
            $table->string('kline_interval')->comment('Kandle interval')->nullable(); 
            $table->integer('kline_quantity')->comment('How much klines goes to strategy calculation'); 
            $table->string('refresh_interval')->comment('How frequently strategy is calculated')->nullable(); 
            $table->primary(['id']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('active_strategies');
    }
}
