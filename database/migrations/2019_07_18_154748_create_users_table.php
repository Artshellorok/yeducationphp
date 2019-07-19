<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('password')->nullable();
            $table->integer('status')->default(0); // 0 - guest(или нет УК) 1 - жилец, 2 - собственник, ? 3 - староста? 
            $table->rememberToken();
            $table->string('mail')->nullable();
            $table->string('avatar')->default('https://yeducation.ru/misc/noavatar.png');
        });
        Schema::create('address_user', function(Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->primary(['user_id', 'address_id']);
            $table->integer('flat');
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
        Schema::dropIfExists('users');
    }
}
