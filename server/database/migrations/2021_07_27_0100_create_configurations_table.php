<?php

use App\Models\Configuration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->longText('value')->nullable();
            $table->string('description', 150);
        });
        

        $config = new Configuration([
            'id' => 'TERMS_OF_USE',
            'value' => '<p>Texto dos <b>termos</b> de uso</p>',
            'description' => 'Texto institucional dos termos de uso',
        ]);
        $config->save();

        $config = new Configuration([
            'id' => 'PRIVACY_POLICY',
            'value' => '<p>Texto da política de privacidade</p>',
            'description' => 'Texto institucional da política de PRIVACIDADE',
        ]);
        $config->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
