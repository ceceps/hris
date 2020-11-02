<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('name')->nullable();
            $table->string('departement')->nullable();
            $table->date('date')->nullable();
            $table->string('shift')->nullable();
            $table->string('timetable')->nullable();
            $table->string('start_work')->nullable();
            $table->string('end_work')->nullable();
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->string('late')->nullable();
            $table->string('early_leave')->nullable();
            $table->string('attended')->nullable();
            $table->string('absent')->nullable();
            $table->string('worked')->nullable();
            $table->string('break')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('leave')->nullable();
            $table->string('OT1')->nullable();
            $table->string('OT2')->nullable();
            $table->string('OT3')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->string('sumber')->nullable();

            $table->foreign('update_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('person_id');
            $table->dropColumn('name');
            $table->dropColumn('departement');
            $table->dropColumn('date');
            $table->dropColumn('shift');
            $table->dropColumn('timetable');
            $table->dropColumn('start_work');
            $table->dropColumn('end_work');
            $table->dropColumn('checkin');
            $table->dropColumn('checkout');
            $table->dropColumn('late');
            $table->dropColumn('early_leave');
            $table->dropColumn('attended');
            $table->dropColumn('absent');
            $table->dropColumn('worked');
            $table->dropColumn('break');
            $table->dropColumn('leave_type');
            $table->dropColumn('leave');
            $table->dropColumn('OT1');
            $table->dropColumn('OT2');
            $table->dropColumn('OT3');
            $table->dropColumn('update_by');
            $table->dropColumn('sumber');
        });
    }
}
