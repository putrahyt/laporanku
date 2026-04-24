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
            <h1 class="my-4">Detail Aktivitas</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/peserta">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/peserta/laporanharian">Laporan Harian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Aktivitas</li>
            </ol>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-primary mb-3">Detail Aktivitas</h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="table-primary" width="30%">Nama</td>
                                            <td><?= $data['peserta']['fullname'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Instansi</td>
                                            <td><?= $data['peserta']['instansi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Tanggal Upload</td>
                                            <td><?= date('d F Y, h:i:s A', $data['laporanharian']['tanggal']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Aktivitas</td>
                                            <td><?= $data['laporanharian']['aktivitas'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Catatan</td>
                                            <td><?= $data['laporanharian']['catatan'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="text-primary mb-3">Status</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="table-primary" width="30%">Mentor</td>
                                            <td><?= $data['mentor']['full_name'] ?></td>
                                        </tr>
                                        <?php if($data['laporanharian']['status'] === '1') : ?>
                                        <tr>
                                            <td class="table-primary">Status</td>
                                            <td>Disetujui mentor</td>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td class="table-primary">Status</td>
                                            <td>Tidak disetujui mentor</td>
                                        </tr>
                                        <tr>
                                            <td class="table-primary">Catatan</td>
                                            <td><?= $data['laporanharian']['catatan_mentor'] ?></td>
                                        </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <a href="<?= BASEURL; ?>/peserta/laporanharian" class="btn btn-danger mt-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>