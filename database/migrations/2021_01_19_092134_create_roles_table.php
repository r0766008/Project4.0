<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('roles')->insert(
            [
                [
                    'name' => 'Trucker',
                    'created_at' => now()
                ],
                [
                    'name' => 'Admin',
                    'created_at' => now()
                ],
                [
                    'name' => 'Logistic Employee',
                    'created_at' => now()
                ],
                [
                    'name' => 'Loading Employee',
                    'created_at' => now()
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
