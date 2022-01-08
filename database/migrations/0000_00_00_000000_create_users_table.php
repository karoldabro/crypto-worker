<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { 
            $table->uuid('id'); 
            $table->string('name')->comment('User name'); 
            $table->string('email')->comment('User email address'); 
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password'); 
            $table->primary(['id']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
