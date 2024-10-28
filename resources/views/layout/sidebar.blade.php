<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="/" class="sidebar-logo">
            {{-- <img src="/assets/images/logo.png" alt="site logo" class="light-logo">
            <img src="/assets/images/logo-light.png" alt="site logo" class="dark-logo">
            <img src="/assets/images/logo-icon.png" alt="site logo" class="logo-icon"> --}}
            <strong>Kandang Panjang</strong>    
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="/">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('admin')
                
            <li>
                <a href="/pengguna">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Pengguna</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Riwayat</li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Data Pengajuan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="/pengajuan_kelahiran"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Data Kelahiran</a>
                    </li>
                    <li>
                        <a href="/pengajuan_kematian"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Kematian</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                    <span>Riwayat Pengajuan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="/riwayat_kelahiran"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Kelahiran</a>
                    </li>
                    <li>
                        <a href="/riwayat_kematian"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Kematian</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Laporan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="laporan_lhr"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Data Kelahiran</a>
                    </li>
                    <li>
                        <a href="laporan_mt"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Kematian</a>
                    </li>
                </ul>
            </li>

            @endcan

            @can('user')
            <li class="sidebar-menu-group-title">Menu</li>

            <li>
                <a href="/form-pengajuan">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Form Pengajuan</span>
                </a>
            </li>

            <li>
                <a href="/data-pengajuan">
                    <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                    <span>Master Pengajuan</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>