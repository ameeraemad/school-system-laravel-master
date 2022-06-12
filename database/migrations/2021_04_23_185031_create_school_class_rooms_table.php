<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_class_rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id');
            $table->foreign('school_id')->on('schools')->references('id');

            $table->foreignId('class_room_id');
            $table->foreign('class_room_id')->on('class_rooms')->references('id');

            $table->integer('section');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_class_rooms');
    }
}
