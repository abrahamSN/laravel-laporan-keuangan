<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('jumlah');
            $table->text('keterangan');
            $table->decimal('total', 10, 0);
            $table->string('foto_bukti');
            $table->date('tanggal');
        });

        Schema::table('pemasukan', function (Blueprint $table) {
            $table->integer('jasa_id')
            ->index() // index
            ->unsigned()
            ->after('id');

            $table->foreign('jasa_id') //foreignKey
            ->references('id') // dari kolom id
            ->on('jasa') // di tabel jasa
            ->onUpdate('cascade') // ketika terjadi perubahan di tabel jasa maka akan update
            ->onDelete('cascade'); // ketika data jasa di hapus akan ikut hilang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemasukan', function (Blueprint $table) {
            $table->dropForeign('pemasukan_jasa_id_foreign');
        });

        Schema::dropIfExists('pemasukan');
    }
}
