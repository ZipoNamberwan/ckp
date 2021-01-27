<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Version1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
            $table->integer('position')->nullable();
        });

        Schema::create('months', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
            $table->integer('position')->nullable();
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
            $table->integer('position')->nullable();
            $table->string('color')->nullable();
        });

        Schema::create('ckp', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('year_id')->constrained('years');
            $table->foreignId('month_id')->constrained('months');
            $table->foreignId('status_id')->constrained('statuses')->default('1');
            $table->timestamps();
        });

        Schema::create('activity_ckp', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('ckp_id')->constrained('ckp');
            $table->enum('type', ['utama', 'tambahan']);
            $table->string('name');
            $table->string('unit');
            $table->decimal('target');
            $table->decimal('real');
            $table->decimal('quality')->nullable();
            $table->string('note');
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
        Schema::dropIfExists('activity_ckp');
        Schema::dropIfExists('ckp');
        Schema::dropIfExists('years');
        Schema::dropIfExists('months');
        Schema::dropIfExists('statuses');
    }
}
