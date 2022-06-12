<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 45)->unique();
            $table->string('mobile', 15)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');
            $table->boolean('active')->default(true);

            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id');

            $table->foreignId('school_id');
            $table->foreign('school_id')->on('schools')->references('id');

            $table->rememberToken();
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
        Schema::dropIfExists('teachers');
    }
}
