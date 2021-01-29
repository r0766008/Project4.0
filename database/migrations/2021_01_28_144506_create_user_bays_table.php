<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('bay_id');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bay_id')->references('id')->on('bays')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('user_bays')->insert(
            [
                [
                    'user_id' => 2,
                    'bay_id' => 1,
                    'created_at' => now()
                ],
                [
                    'user_id' => 2,
                    'bay_id' => 2,
                    'created_at' => now()
                ],
                [
                    'user_id' => 2,
                    'bay_id' => 3,
                    'created_at' => now()
                ]
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
        Schema::dropIfExists('user_bays');
    }
}
