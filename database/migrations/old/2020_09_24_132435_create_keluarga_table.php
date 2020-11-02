<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kel',30)->nullable();
            $table->unsignedBigInteger('kartu_keluarga_id');
            $table->string('noktp', 30);
            $table->string('name');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->text('alamat');
            $table->string('rt',3);
            $table->string('rw',3);
            $table->char('province_id')->nullable();
            $table->char('city_id')->nullable();
            $table->char('district_id')->nullable();
            $table->char('village_id')->nullable();
            $table->string('kodepos',5)->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('kartu_keluarga_id')->references('id')->on('kartu_keluargas')->cascadeOnDelete();
            $table->foreign('update_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnDelete();
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->foreign('district_id')->references('id')->on('districts')->cascadeOnDelete();
            $table->foreign('village_id')->references('id')->on('villages')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluargas');
    }
}
