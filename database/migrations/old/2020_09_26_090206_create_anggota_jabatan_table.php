<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_jabatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_anggota',20);
            $table->unsignedBigInteger('anggota_id')->nullable();
            $table->unsignedBigInteger('jabatan_unit_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('create_by');
            $table->unsignedBigInteger('update_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('anggota_id')->references('id')->on('anggotas')->cascadeOnDelete();
            $table->foreign('jabatan_unit_id')->references('id')->on('jabatan_units')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_jabatans');
    }
}
