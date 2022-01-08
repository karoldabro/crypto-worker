<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) { 
            $table->uuid('id'); 
            $table->uuid('strategy_id'); 
            $table->uuid('exchange_id'); 
            $table->string('pair'); 
            $table->string('kandle_interval')->nullable(); 
            $table->string('refresh_interval')->nullable(); 
            $table->primary(['id']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
