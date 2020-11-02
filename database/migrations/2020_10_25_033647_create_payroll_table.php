<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('periode_from');
            $table->date('periode_to');
            $table->date('tgl_cetak');
            $table->double('uang_pokok',50)->default(0);
            $table->double('uang_lembur',50)->default(0);
            $table->double('uang_makan',50)->default(0);
            $table->double('tunj_keluarga',50)->default(0);
            $table->double('tunj_haritua',50)->default(0);
            $table->double('tunj_kesehatan',50)->default(0);
            $table->double('tunj_keselamatan',50)->default(0);
            $table->double('tunj_kecelakaan',50)->default(0);
            $table->double('tunj_hari_raya',50)->default(0);
            $table->double('bonus',50)->default(0);
            $table->double('potongan_listrik',50)->default(0);
            $table->double('potongan_belanja',50)->default(0);
            $table->double('potongan_koperasi',50)->default(0);
            $table->double('potongan_lain',50)->default(0);
            $table->double('gaji_kotor',50)->default(0);
            $table->double('total_upah',50)->default(0);
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
        Schema::dropIfExists('payrolls');
    }
}
