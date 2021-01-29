<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trucks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('truck_id');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('user_trucks')->insert(
            [
                [
                    'user_id' => 3,
                    'truck_id' => 1,
                    'created_at' => now()
                ],
                [
                    'user_id' => 4,
                    'truck_id' => 2,
                    'created_at' => now()
                ],
                [
                    'user_id' => 5,
                    'truck_id' => 3,
                    'created_at' => now()
                ],
                [
                    'user_id' => 6,
                    'truck_id' => 4,
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
        Schema::dropIfExists('user_trucks');
    }
}
