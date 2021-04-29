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
            $table->string('user_id')->unique();
            $table->string('department_id');
            $table->string('device_token')->nullable();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('birth_date');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->foreign('device_token')->references('device_token')->on('devices');
        });
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
