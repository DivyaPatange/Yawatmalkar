<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->string('contact_no')->nullable();
            $table->string('alt_contact_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('email');
            $table->string('experience');
            $table->string('qualification')->nullable();
            $table->string('specialization');
            $table->text('office_address')->nullable();
            $table->text('residential_address')->nullable();
            $table->string('working_hour');
            $table->string('other_profession')->nullable();
            $table->date('dob')->nullable();
            $table->string('expectation')->nullable();
            $table->text('achievements')->nullable();
            $table->text('about_urself')->nullable();
            $table->string('doctor_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('password_1');
            $table->enum('is_register', ['Yes', 'No']);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('doctors');
    }
}
