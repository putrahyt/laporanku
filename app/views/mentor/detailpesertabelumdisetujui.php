<div class="mt-2">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePeserta" aria-expanded="false" aria-controls="collapsePeserta">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user"></i></div>
        Data Peserta
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsePeserta" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/peserta"><i class="fas fa-fw fa-user mr-2"></i> Peserta</a>
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/belumdisetujui"><i class="fas fa-fw fa-user mr-2"></i> Belum Disetujui</a>
        </nav>
    </div>
</div>
<div class="mt-2">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-book"></i></div>
        Laporan Peserta
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/laporanharian"><i class="fas fa-fw fa-book mr-2"></i> Laporan Harian</a>
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/laporanakhir"><i class="fas fa-fw fa-book mr-2"></i> Laporan Akhir</a>
        </nav>
    </div>
</div>
<div class="mt-2">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil">
        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user-tie"></i></div>
        Profil Saya
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseProfil" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/datadiri"><i class="fas fa-fw fa-user mr-2"></i> Data Diri</a>
            <a class="nav-link" href="<?= BASEURL; ?>/mentor/changePassword"><i class="fas fa-fw fa-key mr-2"></i> Ubah Password</a>
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
                    <h1 class="my-4">Detail Peserta</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/mentor">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/mentor/belumdisetujui">Peserta Belum Disetujui</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Peserta Belum Disetujui</li>
                    </ol>
                    <div class="card shadow-sm mb-4 p-1" style="max-width: 100%;">
                        <div class="row no-gutters ml-1">
                            <div class="col-md-4">
                                <img src="<?= BASEURL . '/asset/img/' . $data['peserta']['image'] ?>" alt="profil" width="100%" height="85%" style="object-fit: cover;" class="mt-4">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title text-primary ml-1">Peserta</h4>
                                    <div class="table-responsive">
                                        <table class="table table-sm ml-0 table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td width="45%"><b>Nama Lengkap</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['fullname'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Username</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['username'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Divisi</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['divisi'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Instansi</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['instansi'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jurusan</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['jurusan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td class="text-muted"><?= $data['peserta']['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>NPM</b></td>
                                                    <?php if($data['peserta']['npm'] == 0) : ?>
                                                        <td class="text-muted">-</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><?= $data['peserta']['npm'] ?></td>
                                                    <?php endif ?> 
                                                </tr>
                                                <tr>
                                                    <td><b>No Handphone</b></td>
                                                    <?php if($data['peserta']['noHP'] == 0) : ?>
                                                        <td class="text-muted">-</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><?= $data['peserta']['noHP'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Mentor</b></td>
                                                    <td class="text-muted"><a href="<?= BASEURL . '/mentor/datadiri/' ?>"><?= $data['peserta']['full_name'] ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Status</b></td>
                                                    <?php if($data['peserta']['is_actived'] == 0) : ?>
                                                        <td class="text-muted">Belum disetujui mentor</td>
                                                    <?php else : ?>
                                                        <td class="text-muted">Sudah disetujui mentor</td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Date Created</b></td>
                                                    <td class="text-muted"><?= date('d F Y',$data['peserta']['date_created']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="<?= BASEURL ?>/mentor/belumdisetujui" class="btn btn-danger ml-1">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>