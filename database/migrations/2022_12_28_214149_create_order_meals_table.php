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
        Schema::create('order_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('meal_id')->constrained();
            $table->integer('count')->comment('數量');
            $table->string('remark')->nullable()->comment('備註');
            $table->enum('status', ['pending', 'processing', 'finish', 'arrived', 'canceled'])->default('pending')->comment('狀態[待處理,處理中,已完成,已送達,已廢棄]');
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
        Schema::dropIfExists('order_meals');
    }
};