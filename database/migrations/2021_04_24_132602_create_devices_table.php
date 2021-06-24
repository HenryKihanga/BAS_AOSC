<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->string('device_token')->unique();
            $table->string('device_name');
            $table->string('device_type');
            $table->boolean('device_mode')->default(0);
            $table->string('room_id');
            $table->string('organization_id');
            $table->string('branch_id');
            $table->string('department_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->foreign('branch_id')->references('branch_id')->on('branches');
            $table->foreign('department_id')->references('department_id')->on('departments');
            // $table->foreign('room_id')->references('room_id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
