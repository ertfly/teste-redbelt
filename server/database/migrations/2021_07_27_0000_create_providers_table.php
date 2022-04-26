<?php

use App\Models\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 150);
            $table->boolean('trash')->default(false);
        });

        $new = new Provider([
            'id' => Provider::GOOGLE,
            'name' => 'Google'
        ]);
        $new->save();

        $new = new Provider([
            'id' => Provider::FACEBOOK,
            'name' => 'Facebook',
        ]);
        $new->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
