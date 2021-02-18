<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
            $table->integer('position')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('departments');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments');
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_department_id_foreign');
            $table->dropColumn('department_id');
            $table->dropColumn('avatar');
        });

        Schema::dropIfExists('departments');
    }
}
