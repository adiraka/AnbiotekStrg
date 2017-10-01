<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li class="header">Menu Utama</li>
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">folder_special</i>
                        <span>Front</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahBlog') }}">
                                <span>Tambah Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatBlog') }}">
                                <span>Data Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatKontak') }}">
                                <span>Data Kontak</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">folder_special</i>
                        <span>Extra</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahKategori') }}">
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tambahSatuan') }}">
                                <span>Satuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tambahMerk') }}">
                                <span>Merk</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">people</i>
                        <span>User</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahDistributor') }}">
                                <span>Distributor</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tambahPelanggan') }}">
                                <span>Pelanggan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">shopping_cart</i>
                        <span>Produk</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahBarang') }}">
                                <span>Tambah Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatBarang') }}">
                                <span>Data Produk</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">first_page</i>
                        <span>Stok Masuk</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahMasuk') }}">
                                <span>Tambah Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatMasuk') }}">
                                <span>Data Stok Masuk</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">last_page</i>
                        <span>Stok Keluar</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahKeluar') }}">
                                <span>Tambah Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatKeluar') }}">
                                <span>Data Stok Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Laporan</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('laporanBarang') }}">
                                <span>Laporan Stok Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('laporanStokMasuk') }}">
                                <span>Laporan Stok Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('laporanStokKeluar') }}">
                                <span>Laporan Stok Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Stock</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <span>Cards</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Infobox</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                </li>
                                <li>
                                    <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                </li>
                                <li>
                                    <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                </li>
                                <li>
                                    <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                </li>
                                <li>
                                    <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <div class="legal">
            <div class="copyright">
                2017 &copy; <a href="javascript:void(0);">ANBIOTEK</a> All Right Reserved.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
    </aside>
</section>
