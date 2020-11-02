<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterWorkplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_plans', function (Blueprint $table) {
            $table->text('worktodo')->nullable()->change();
            $table->text('comments')->nullable()->change();
            $table->unsignedBigInteger('supervisor_id')->nullable()->change();
            $table->dateTime('from')->change();
            $table->dateTime('to')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_plans', function (Blueprint $table) {
            $table->text('worktodo')->change();
            $table->text('comments')->change();
            $table->unsignedBigInteger('supervisor_id')->change();
            $table->date('from')->change();
            $table->date('to')->change();
        });
    }
}
