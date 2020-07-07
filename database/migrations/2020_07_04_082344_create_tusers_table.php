<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users', function (Blueprint $table) {
            $table->string('user_id');
            $table->integer('valid_flag');
            $table->string('login_password');
            $table->string('confirmation_word');
            $table->integer('allow_login_counts');
            $table->integer('authority_flag');
            $table->string('assigned_staff_code');
            $table->timestamp('created_datetime');
            $table->timestamp('updated_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_users');
    }
}
