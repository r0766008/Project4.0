<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->foreignId('truck_id');
            $table->foreignId('bay_id');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bay_id')->references('id')->on('bays')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('schedules')->insert(
            [
                [
                    'date' => \Carbon\Carbon::now(),
                    'time' => '12:30',
                    'truck_id' => 1,
                    'bay_id' => 1,
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
        Schema::dropIfExists('schedules');
    }
}
