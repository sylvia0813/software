<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('姓名');
            $table->enum('sex', ['male', 'female'])->nullable()->comment('性別[男, 女, 未知]');
            $table->integer('age')->nullable()->comment('年齡');
            $table->string('account')->comment('帳號或員編');
            $table->string('password')->comment('密碼');
            $table->enum('role', ['server', 'waiter', 'chef', 'handyman', 'manager'])->comment('職位[領檯人員,服務生,廚師,雜工,經理]');
            $table->string('remember_token')->nullable();
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
};