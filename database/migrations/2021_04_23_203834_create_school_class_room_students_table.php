<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolClassRoomStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_class_room_students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id');
            $table->foreign('student_id')->on('students')->references('id');

            $table->foreignId('school_class_room_id');
            $table->foreign('school_class_room_id')->on('school_class_rooms')->references('id');

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
        Schema::dropIfExists('school_class_room_students');
    }
}
