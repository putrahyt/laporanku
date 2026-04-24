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
            <h1 class="my-4">Detail Laporan Akhir</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/admin"> Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/admin/laporan"> Data Laporan Akhir</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Laporan Akhir</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-primary mb-3">Laporan Akhir</h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="table-primary" width="30%">Nama Lengkap</td>
                                            <td><?= $data['laporanakhir']['fullname'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Instansi</td>
                                            <td><?= $data['laporanakhir']['instansi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Jurusan</td>
                                            <td><?= $data['laporanakhir']['jurusan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Tanggal Upload</td>
                                            <td><?= date('d F Y, h:i:s A', $data['laporanakhir']['tanggal']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Judul</td>
                                            <td><?= $data['laporanakhir']['aktivitas'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Mentor</td>
                                            <td><?= $data['mentor']['full_name'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="<?= BASEURL; ?>/admin/laporan" class="btn btn-danger mt-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>