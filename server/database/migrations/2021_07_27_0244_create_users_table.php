<?php

use App\Libraries\Strings;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\String_;

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
            $table->string('name', 250)->index();
            $table->string('username', 50)->index();
            $table->string('pass', 64);
            $table->timestamps();
        });

        $user = new User([
            'name' => 'Administrador',
            'username' => 'admin',
            'pass' => Strings::password('admin')
        ]);
        $user->save();
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
