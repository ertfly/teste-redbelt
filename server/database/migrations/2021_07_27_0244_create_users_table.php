<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 250)->index();
            $table->string('email', 250)->index();
            $table->string('pass', 64);
            $table->string('username', 30)->index();
            $table->string('phone', 30)->index();
            $table->string('gender', 1)->index();
            $table->timestamp('birth')->index();
            $table->string('photo', 250)->nullable();
            $table->integer('provider_id')->nullable()->index();
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
        Schema::dropIfExists('users');
    }
}
