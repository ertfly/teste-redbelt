<?php

use App\Models\IncidentsCritics;
use App\Models\IncidentsStatus;
use App\Models\IncidentsTypes;
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
        foreach (['Alta', 'Média', 'Baixa'] as $a) {
            $row = new IncidentsCritics([
                'description' => $a,
            ]);
            $row->save();
        }

        Schema::create('incidents_types', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100)->index();
            $table->timestamps();
        });
        foreach (['Alarme', 'Incidente', 'Outros'] as $a) {
            $row = new IncidentsTypes([
                'description' => $a,
            ]);
            $row->save();
        }

        Schema::create('incidents_status', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100)->index();
            $table->timestamps();
        });
        foreach (['Ativo', 'Inativo'] as $a) {
            $row = new IncidentsStatus([
                'description' => $a,
            ]);
            $row->save();
        }
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
