<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250)->index();
            $table->text('description');
            $table->integer('critical_id')->index();
            $table->integer('type_id')->index();
            $table->integer('status_id')->index();
            $table->timestamps();
        });

        Schema::create('incidents_critics', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100)->index();
            $table->timestamps();
        });

        Schema::create('incidents_types', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100)->index();
            $table->timestamps();
        });

        Schema::create('incidents_status', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100)->index();
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
        Schema::dropIfExists('incidents');
        Schema::dropIfExists('incidents_critics');
        Schema::dropIfExists('incidents_types');
        Schema::dropIfExists('incidents_status');
    }
}
