<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bays', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->foreignId('bay_status_id');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('bay_status_id')->references('id')->on('bay_statuses')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('bays')->insert(
            [
                [
                    'number' => 1,
                    'bay_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'number' => 2,
                    'bay_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'number' => 3,
                    'bay_status_id' => 1,
                    'created_at' => now()
                ],
                [
                    'number' => 4,
                    'bay_status_id' => 1,
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
        Schema::dropIfExists('bays');
    }
}
