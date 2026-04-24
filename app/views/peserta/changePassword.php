<div class="mt-2">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-book"></i></div>
        Laporan
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= BASEURL; ?>/peserta/laporanharian"><i class="fas fa-fw fa-book mr-2"></i> Laporan Harian</a>
            <a class="nav-link" href="<?= BASEURL; ?>/peserta/laporanakhir"><i class="fas fa-fw fa-book mr-2"></i> Laporan Akhir</a>
        </nav>
    </div>
</div>
<div class="mt-2">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user-tie"></i></div>
        Profil
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseProfil" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= BASEURL; ?>/peserta/datadiri"><i class="fas fa-fw fa-user mr-2"></i> Data Diri</a>
            <a class="nav-link" href="<?= BASEURL; ?>/peserta/changePassword"><i class="fas fa-fw fa-key mr-2"></i> Ubah Password</a>
        </nav>
    </div>
</div>
</div>
</div>
</nav>
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
                    <h1 class="my-4">Ubah Password Peserta</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/mentor">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Password</li>
                    </ol>
                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form class="user" method="post" action="<?= BASEURL; ?>/peserta/changePassword">
                                <div class="form-group col-md-4">
                                    <label for="passwordLama">Password Lama</label>
                                    <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Masukkan Password Lama Anda" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passwordBaru">Password Baru <small>(Masukkan minimal 8 karakter)</small></label>
                                    <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Masukkan Password Baru Anda" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="confirmPassBaru">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirmPassBaru" name="confirmPassBaru" placeholder="Masukkan Kembali Password Baru Anda" required>
                                </div>
                                <div class="form-group col">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </main>