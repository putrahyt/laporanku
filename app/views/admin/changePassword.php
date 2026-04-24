<div class="mt-2">
    <a class="nav-link" href="<?= BASEURL; ?>/admin/mentor">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user"></i></div>
        Data Mentor
    </a>
</div>
<div class="mt-2">
    <a class="nav-link" href="<?= BASEURL; ?>/admin/peserta">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user"></i></div>
        Data Peserta
    </a>
</div>
<div class="mt-2">
    <a class="nav-link" href="<?= BASEURL; ?>/admin/laporan">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-book"></i></div>
        Data Laporan Akhir
    </a>
</div>
<div class="mt-2">
    <a class="nav-link" href="<?= BASEURL; ?>/admin/changePassword">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-key"></i></div>
        Ubah Password
    </a>
</div>
</div>
</div>
</nav>
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
                    <h1 class="my-4">Ubah Password Admin</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Password Admin</li>
                    </ol>
                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form class="user" method="post" action="<?= BASEURL; ?>/admin/changePassword">
                                <div class="form-group col-md-4">
                                    <label for="passwordLama">Password Lama</label>
                                    <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Masukkan Password Lama Anda" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passwordBaru">Password Baru <small>(Minimal 8 karakter)</small></label>
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