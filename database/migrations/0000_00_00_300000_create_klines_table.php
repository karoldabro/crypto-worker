<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlinesTable extends Migration
{
    public function up()
    {
        Schema::create('klines', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->string('symbol'); 
            $table->uuid('exchange_id'); 
            $table->timestamp('timestamp'); 
            $table->string('interval'); 
            $table->decimal('open')->default(20,12); 
            $table->decimal('high')->default(20,12); 
            $table->decimal('low')->default(20,12); 
            $table->decimal('close')->default(20,12); 
            $table->decimal('volume')->default(20,2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('klines');
    }
}
