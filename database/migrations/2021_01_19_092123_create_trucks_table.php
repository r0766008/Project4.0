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
            $table->string('license_plate');
            $table->string('rfid');
            $table->string('company')->nullable();
            $table->timestamps();
        });

        DB::table('trucks')->insert(
            [
                [
                    'license_plate' => '1TXB732',
                    'rfid' => 'fds8y-ghvb6-45ghf',
                    'company' => 'IT',
                    'created_at' => now()
                ],
                [
                    'license_plate' => '1OAF735',
                    'rfid' => 'we123-ghjk8-aafsd',
                    'company' => '3-IT',
                    'created_at' => now()
                ],
                [
                    'license_plate' => '1KHU915',
                    'rfid' => '541651320',
                    'company' => 'Renard SNC',
                    'created_at' => now()
                ],
                [
                    'license_plate' => '1BGK912',
                    'rfid' => '8416351320',
                    'company' => 'Dubois',
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
