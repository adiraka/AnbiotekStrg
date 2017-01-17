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
            $table->integer('merk_id')->unsigned();
            $table->integer('satuan_id')->unsigned();
            $table->integer('stock');
            $table->date('expire');
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

        Schema::create('merk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmmerk');
            $table->timestamps();

            $table->engine = 'InnoDB';
        }); 

        Schema::create('distributor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmdistributor');
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        }); 

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmpelanggan');
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        }); 

        Schema::create('masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nobon')->unique();
            $table->string('distributor_id');
            $table->date('tglmasuk');
            $table->integer('totbay');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->date('tgllunas')->default(null)->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
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
            $table->integer('pelanggan_id')->unsigned();
            $table->string('nobon')->unique();
            $table->date('tglkeluar');
            $table->integer('totbay');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->date('tgllunas')->default(null)->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('barang');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('merk');
        Schema::dropIfExists('distributor');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('masuk');
        Schema::dropIfExists('det_masuk');
        Schema::dropIfExists('keluar');
        Schema::dropIfExists('det_keluar');
    }
}
