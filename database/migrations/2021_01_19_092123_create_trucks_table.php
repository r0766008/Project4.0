<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate');
            $table->string('rfid');
            $table->string('company')->nullable();
            $table->timestamps();
        });

        DB::table('trucks')->insert(
            [
                [
                    'number_plate' => '1TXB732',
                    'rfid' => 'fds8y-ghvb6-45ghf',
                    'company' => 'IT',
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
        Schema::dropIfExists('trucks');
    }
}
