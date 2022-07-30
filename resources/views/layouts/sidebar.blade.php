<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if (Auth::user()->status == 'admin')
            <li class="nav-item has-treeview">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kelola_barang') }}" class="nav-link">
                    <i class="fab fa-buffer mr-1 ml-1"></i>
                    <p>
                        Kelola Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kelola_stok') }}" class="nav-link">
                    <i class="fab fa-buffer mr-1 ml-1"></i>
                    <p>
                        Kelola Stok
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-tasks ml-1 mr-1"></i>
                    <p>
                        Laporan Akhir
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('laporan') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>
                                Laporan Akhir
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('laporan_masuk') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>
                                Laporan Barang Masuk
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('laporan_expired') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>Laporan Barang Expired</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->status == 'pimpinan')
            <li class="nav-item has-treeview">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="{{ route('kelola_akun') }}" class="nav-link mr-1">
                    &nbsp;<i class="fas fa-users mr-2"></i>
                    <p>
                        Kelola Akun
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kelola_barang') }}" class="nav-link">
                    <i class="fab fa-buffer mr-1 ml-1"></i>
                    <p>
                        Kelola Barang
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kelola_stok') }}" class="nav-link">
                    <i class="fab fa-buffer mr-1 ml-1"></i>
                    <p>
                        Kelola Stok
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-tasks ml-1 mr-1"></i>
                    <p>
                        Laporan Akhir
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('laporan') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>
                                Laporan Akhir
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('laporan_masuk') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>
                                Laporan Barang Masuk
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('laporan_expired') }}" class="nav-link">
                            <i class="far fa-circle nav-icon ml-1 mr-1"></i>
                            <p>Laporan Barang Expired</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->status == 'orang gudang')
            <li class="nav-item has-treeview">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kelola_stok') }}" class="nav-link">
                    <i class="fas fa-boxes ml-1 mr-1"></i>
                    <p>
                        Kelola Stok
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('histori') }}" class="nav-link">
                    <i class="fas fa-history ml-1 mr-1"></i>
                    <p>
                        Histori Stok
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kelola_barang_keluar') }}" class="nav-link">
                    <i class="fas fa-balance-scale ml-1 mr-1"></i>
                    <p>
                        Pengeluaran Stok
                    </p>
                </a>
            </li>
        @endif
    </ul>
</nav>
