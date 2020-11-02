<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddressHomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address_homes', function (Blueprint $table) {
            $table->string('rt',3)->nullable();
            $table->string('rw',3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_homes', function (Blueprint $table) {
            $table->dropColumn('rt',3);
            $table->dropColumn('rw',3);
        });
    }
}
