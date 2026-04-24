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
            <h1 class="my-4">Laporan Akhir <?= $data['peserta']['fullname'] ?></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/mentor"> Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/mentor/laporanakhir"> Laporan Akhir</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Akhir Peserta</li>
            </ol>
            <?php if(empty($data['laporanpeserta'])) : ?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        Peserta belum mengirim laporan akhir!
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-primary mb-2">Laporan Akhir</h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php foreach($data['laporanpeserta'] as $laporanakhir) : ?>
                                            <tr>
                                                <td class="table-primary" width="30%">Nama</td>
                                                <td><?= $laporanakhir['fullname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Instansi</td>
                                                <td><?= $data['peserta']['instansi'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Jurusan</td>
                                                <td><?= $data['peserta']['jurusan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Tanggal Upload</td>
                                                <td><?= date('d F Y, h:i:s A', $laporanakhir['tanggal']) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Judul</td>
                                                <td><?= $laporanakhir['aktivitas'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Dokumen</td>
                                                <td>
                                                    <?php if($laporanakhir['dokumen'] !== null) : ?>
                                                        <a href="<?= BASEURL . '/asset/fileLaporanAkhir/' . $laporanakhir['dokumen'] ?>" download><i class="fa-solid fa-download fa-lg" title="Download"></i></a>
                                                    <?php endif ?>
                                                    <?php if($laporanakhir['url'] !== null) : ?>
                                                        <a href="<?= $laporanakhir['url'] ?>" target="_blank"><i class="fa-solid fa-link fa-lg" title="URL"></i></a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php if($laporanakhir['status'] === '0') : ?>
                                                <tr>
                                                    <td class="table-primary">Aksi</td>
                                                    <td>
                                                        <a href="<?= BASEURL . '/mentor/acclaporanakhir/' . $laporanakhir['id'] ?>" class="badge badge-success acclaporanakhir"><i class="fa-solid fa-check"></i> Setujui</a>
                                                        <a href="#" class="badge badge-danger tolaklaporanakhir" data-toggle="modal" data-target="#tolaklaporanakhir" data-id="<?= $laporanakhir['id'] ?>"><i class="fa-solid fa-xmark"></i> Tolak</a>
                                                    </td>
                                                </tr>
                                            <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="text-primary mb-3">Status</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php if($laporanakhir['status'] === '0') {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-rotate fa-xl"></i> Anda belum menyetujui laporan</td><tr>';
                                        } else if($laporanakhir['status'] === '1') {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-check fa-xl" style="color: #0bef4f"></i> Anda menyetujui laporan akhir</td><tr>';
                                        } else {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-xmark fa-xl" style="color: #ef0b0b"></i> Anda menolak laporan akhir</td><tr>';
                                        }?>

                                        <?php if($laporanakhir['status'] !== '1') : ?>
                                            <?php if($laporanakhir['catatan_mentor'] !== null) : ?>
                                                <tr>
                                                    <td class="table-primary">Catatan</td>
                                                    <td><?= $laporanakhir['catatan_mentor'] ?></td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php if($laporanakhir['dokumen'] !== null) : ?>
                                <h5 class="text-primary mb-2">Preview</h5>
                                <iframe src="<?= BASEURL . '/asset/fileLaporanAkhir/' . $laporanakhir['dokumen'] ?>" frameborder="0" width="100%" height="90%"></iframe>
                            <?php endif ?>
                        </div>
                        <div class="col-lg-1">
                            <a href="<?= BASEURL . '/mentor/laporanakhir' ?>" class="btn btn-danger mt-3" >Kembali</a>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </main>

    <div class="modal fade" id="tolaklaporanakhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Laporan AKhir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL . '/mentor/tolaklaporanakhir/' . $laporanakhir['id'] ?>" method="post">
                    <input type="hidden" name="id" id="idlaporanpeserta"> 
                    <div class="form-group">
                        <label for="catatan">Beri Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>