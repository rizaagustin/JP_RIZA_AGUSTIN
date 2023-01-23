<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rs_jakarta', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rumah_sakit');
            $table->string('jenis_rumah_sakit');
            $table->string('alamat_rumah_sakit');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota_kab_administrasi');
            $table->string('kode_pos');            
            $table->string('nomor_telepon');            
            $table->string('nomor_fax');            
            $table->string('no_hp_direktur'); 
            $table->string('website'); 
            $table->string('email');                                    
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
        Schema::dropIfExists('rs_jakarta');
    }
};
