<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrategiesTable extends Migration
{
    public function up()
    {
        Schema::create('strategies', function (Blueprint $table) { 
            $table->uuid('id'); 
            $table->string('name'); 
            $table->string('kandle_interval'); 
            $table->string('refresh_interval'); 
            $table->primary(['id']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('strategies');
    }
}
