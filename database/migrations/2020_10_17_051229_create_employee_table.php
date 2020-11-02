<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 30);
            $table->string('noktp', 30);
            $table->string('name');
            $table->date('birthday');
            $table->string('place_birth');
            $table->date('join_date');
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->unsignedBigInteger('job_level_id')->nullable();
            $table->string('ptkp_id',30)->nullable();
            $table->unsignedBigInteger('jurnal_id')->nullable();
            $table->string('back_account')->nullable();
            $table->string('bpjs_tenagakerja')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('grade',20);
            $table->string('salary_role',20);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('status', ['probetion', 'contract','permanent']);
            $table->enum('gender', ['M', 'F']);
            $table->enum('religion',['islam','kristen','hindu','budha','kepercayaan'])->default('islam');
            $table->enum('marital', ['Marriage','Single', 'Widow', 'Widower'])->default('Single');
            $table->enum('education', ['TAK SEKOLAH', 'SD', 'SMP', 'SMU', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->unsignedBigInteger('address_home_id')->nullable();
            $table->string('mobile_phone', 20)->nullable();
            $table->string('work_phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('no_npwp',30)->nullable();;
            $table->string('foto_npwp')->nullable();
            $table->boolean('is_wafat')->default(false);
            $table->unsignedBigInteger('update_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_id')->references('id')->on('jobs')->cascadeOnDelete();
            $table->foreign('job_level_id')->references('id')->on('job_levels')->cascadeOnDelete();
            $table->foreign('departement_id')->references('id')->on('departements')->cascadeOnDelete();
            $table->foreign('address_home_id')->references('id')->on('address_homes')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('update_by')->references('id')->on('users')->cascadeOnDelete();
            //$table->foreign('keluarga_id')->references('id')->on('keluargas')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
