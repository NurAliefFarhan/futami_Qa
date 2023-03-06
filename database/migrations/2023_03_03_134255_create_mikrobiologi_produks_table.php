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
        Schema::create('mikrobiologi_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nodokumen');
            $table->string('nama_produk');
            $table->string('jumlah');
            $table->date('tgl_produk');
            $table->date('tgl_inokulasi');
            $table->date('tgl_pengamatan');
            $table->string('statusOP');
            $table->string('statusST');
            $table->string('statusSP');
            $table->string('user_id_OP')->nullable();
            $table->string('name_id_OP')->nullable();
            $table->string('user_id_ST')->nullable();
            $table->string('name_id_ST')->nullable();
            $table->string('user_id_SP')->nullable();
            $table->string('name_id_SP')->nullable();
            $table->string('created_at_OP')->nullable();
            $table->string('created_at_ST')->nullable();
            $table->string('created_at_SP')->nullable();
            $table->string('delete')->nullable();
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
        Schema::dropIfExists('mikrobiologi_produks');
    }
};
