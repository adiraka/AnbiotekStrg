<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAnbiotekStockpile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode');
            $table->string('nmbarang');
            $table->integer('kategori_id')->unsigned();
            $table->string('merk')->nullable();
            $table->integer('satuan_id')->unsigned();
            $table->integer('stock');
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary('kode');
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmkategori');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('satuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmsatuan');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('harga', function (Blueprint $table) {
            $table->string('barang_kode');
            $table->integer('hrgbeli');
            $table->integer('nettoppn');
            $table->float('kenaikan', 8, 1);
            $table->integer('hrgjual1');
            $table->integer('hrg101');
            $table->float('1disc', 8, 1);
            $table->integer('hrgjual2');
            $table->integer('hrg102');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary('barang_kode');
        });

        Schema::create('masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nobon');
            $table->string('supplier');
            $table->date('tglmasuk');
            $table->integer('totbay');
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('nobon');
        });

        Schema::create('det_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masuk_id')->unsigned();
            $table->string('barang_kode');
            $table->integer('stokawal');
            $table->integer('stokmasuk');
            $table->integer('stokakhir');
            $table->integer('harga');
            $table->integer('subtot');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nobon');
            $table->string('pemesan');
            $table->date('tglkeluar');
            $table->integer('totbay');
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('nobon');
        });

        Schema::create('det_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keluar_id')->unsigned();
            $table->string('barang_kode');
            $table->integer('stokawal');
            $table->integer('stokeluar');
            $table->integer('stokakhir');
            $table->integer('harga');
            $table->integer('subtot');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('barang');
        Schema::drop('kategori');
        Schema::drop('satuan');
        Schema::drop('harga');
        Schema::drop('masuk');
        Schema::drop('det_masuk');
        Schema::drop('keluar');
        Schema::drop('det_keluar');
    }
}
