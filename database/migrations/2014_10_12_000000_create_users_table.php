<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('topics_created')->default('0');
            $table->integer('likes_received')->default('0');
            $table->unsignedInteger('user_type')->default('1');
            $table->foreign('user_type')->references('id')->on('userTypes')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'name'=> 'admin',
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('admin'),
            'user_type'=> '3'
        ]);
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
