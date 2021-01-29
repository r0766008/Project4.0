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
            $table->date('date')->nullable();
            $table->time('eta')->nullable();
            $table->time('ata')->nullable();
            $table->time('atd')->nullable();
            $table->foreignId('user_truck_id');
            $table->foreignId('bay_id');
            $table->foreignId('schedule_status_id')->default(1);
            $table->timestamps();

            // Foreign key relation
            $table->foreign('user_truck_id')->references('id')->on('user_trucks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bay_id')->references('id')->on('bays')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('schedule_status_id')->references('id')->on('schedule_statuses')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('schedules')->insert(
            [
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '08:00',
                    'ata' => '08:03',
                    'atd' => '08:47',
                    'user_truck_id' => 1,
                    'bay_id' => 1,
                    'schedule_status_id' => 3,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '08:00',
                    'ata' => '08:01',
                    'atd' => '08:42',
                    'user_truck_id' => 2,
                    'bay_id' => 2,
                    'schedule_status_id' => 3,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '08:00',
                    'ata' => '07:58',
                    'atd' => '08:53',
                    'user_truck_id' => 3,
                    'bay_id' => 3,
                    'schedule_status_id' => 3,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '08:00',
                    'ata' => '08:08',
                    'atd' => '08:58',
                    'user_truck_id' => 4,
                    'bay_id' => 4,
                    'schedule_status_id' => 3,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '09:00',
                    'ata' => null,
                    'atd' => null,
                    'user_truck_id' => 1,
                    'bay_id' => 1,
                    'schedule_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '09:00',
                    'ata' => null,
                    'atd' => null,
                    'user_truck_id' => 2,
                    'bay_id' => 2,
                    'schedule_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '09:00',
                    'ata' => null,
                    'atd' => null,
                    'user_truck_id' => 3,
                    'bay_id' => 3,
                    'schedule_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'date' => \Carbon\Carbon::now(),
                    'eta' => '09:00',
                    'ata' => null,
                    'atd' => null,
                    'user_truck_id' => 4,
                    'bay_id' => 4,
                    'schedule_status_id' => 1,
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
