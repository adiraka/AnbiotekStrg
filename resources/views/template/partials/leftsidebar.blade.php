<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li class="header">Main Menu</li>
                <li>
                    <a href="{{url('/')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label</i>
                        <span>Kategori</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('tambahKategori')}}">
                                <span>Tambah Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('lihatKategori')}}">
                                <span>Lihat Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label_outline</i>
                        <span>Satuan</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('tambahSatuan')}}">
                                <span>Tambah Satuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatSatuan') }}">
                                <span>Lihat Satuan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Data Stock Barang</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahBarang') }}">
                                <span>Tambah Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatBarang') }}">
                                <span>Lihat Data Stock Barang</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Data Barang Masuk</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahMasuk') }}">
                                <span>Tambah Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatMasuk') }}">
                                <span>Lihat Data Barang Masuk</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Data Barang Keluar</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('tambahKeluar') }}">
                                <span>Tambah Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lihatKeluar') }}">
                                <span>Lihat Data Barang Keluar</span>
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
                &copy; 2016 <a href="javascript:void(0);">AMI Stockpile All Right Reserved</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
    </aside>
</section>
