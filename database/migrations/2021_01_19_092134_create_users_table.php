<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('truck_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'admin' => true,
                    'truck_id' => null,
                    'password' => \Illuminate\Support\Facades\Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()

                ],
                [
                    'name' => 'Tester',
                    'email' => 'test.test@test.com',
                    'admin' => false,
                    'truck_id' => 2,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()

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
        Schema::dropIfExists('users');
    }
}
