<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_ckp', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('assessor_id')->constrained('users');
            $table->foreignId('ckp_r_id')->constrained('ckp_r');
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
