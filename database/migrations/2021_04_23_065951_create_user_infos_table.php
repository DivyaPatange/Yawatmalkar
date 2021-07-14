<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->string('contact_no')->nullable();
            $table->string('alt_contact_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('experience')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->text('office_address')->nullable();
            $table->text('residential_address')->nullable();
            $table->string('working_hour');
            $table->string('other_profession')->nullable();
            $table->date('dob')->nullable();
            $table->string('expectation')->nullable();
            $table->text('achievements')->nullable();
            $table->text('about_urself')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('license')->nullable();
            $table->string('bank_passbook')->nullable();
            $table->string('agreement')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('declaration_signed')->nullable();
            $table->string('mou_signed')->nullable();
            $table->string('youtube_link')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
