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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->default(1);
            $table->rememberToken();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'role_id' => 2,
                    'password' => \Illuminate\Support\Facades\Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Logistic Employee',
                    'email' => 'logistic@employee.com',
                    'role_id' => 3,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Trucker1',
                    'email' => 'trucker1@trucker.com',
                    'role_id' => 1,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Trucker2',
                    'email' => 'trucker2@trucker.com',
                    'role_id' => 1,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Trucker3',
                    'email' => 'trucker3@trucker.com',
                    'role_id' => 1,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Trucker4',
                    'email' => 'trucker4@trucker.com',
                    'role_id' => 1,
                    'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
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
        Schema::dropIfExists('users');
    }
}
