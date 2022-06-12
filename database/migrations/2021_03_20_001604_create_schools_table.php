<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('email', 45)->unique();
            $table->string('telephone', 45)->unique();
            $table->string('mobile', 45)->unique();
            $table->string('address', 100);
            $table->enum('gender', ['M', 'F', 'MF']);
            $table->boolean('active')->default(true);

            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('schools');
    }
}
