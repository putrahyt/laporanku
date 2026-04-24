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
            <h1 class="my-4">Laporan Akhir</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/peserta"> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Akhir</li>
            </ol>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                    <?php if(empty($data['laporanakhir'])) : ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary addLaporanAkhir" data-toggle="modal" data-target="#LaporanAkhir" data-url="<?= BASEURL ?>"><i class="fas fa-plus"></i>
                                    Kirim Laporan Akhir
                                </button>
                            </div>
                        </div>
                    <?php else : ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-primary mb-2">Laporan Akhir</h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php foreach($data['laporanakhir'] as $laporanakhir) : ?>
                                            <tr>
                                                <td class="table-primary" width="30%">Nama</td>
                                                <td><?= $laporanakhir['fullname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Instansi</td>
                                                <td><?= $data['peserta']['instansi'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary">Mentor</td>
                                                <td><?= $data['mentor']['full_name'] ?></td>
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
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="text-primary mb-3">Status</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php if($laporanakhir['status'] === '0') {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-rotate fa-xl"></i> Menunggu persetujuan mentor</td><tr>';
                                        } else if($laporanakhir['status'] === '1') {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-check fa-xl" style="color: #0bef4f"></i> Laporan akhir telah disetujui</td><tr>';
                                        } else {
                                            echo '<tr><td class="table-primary" width="30%">Status</td>
                                            <td><i class="fa-solid fa-xmark fa-xl" style="color: #ef0b0b"></i> Laporan akhir ditolak mentor</td><tr>
                                            <tr><td class="table-primary">Catatan</td>
                                            <td>'.$laporanakhir['catatan_mentor'].'</td></tr>';
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php foreach($data['laporanakhir'] as $laporan) : ?>
                        <?php if($laporan['status'] === '2') : ?>
                            <a href="#" class="btn btn-danger mt-3 ubahLaporanAkhir" title="Ubah" data-toggle="modal" data-target="#LaporanAkhir" data-url="<?= BASEURL ?>" data-id="<?= $laporan['id'] ?>">Ubah Laporan</a>
                            <div class="mt-1">
                                <small><i>Catatan : Pastikan semua sudah benar sebelum mengubah laporan</i></small>    
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="LaporanAkhir" tabindex="-1" aria-labelledby="Data" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Kirim Laporan Akhir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/peserta/addLaporanAkhir" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">    
                        <div class="form-group">
                            <label for="aktivitas">Judul</label>
                            <input type="text" class="form-control" id="aktivitas" name="aktivitas" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h5>Dokumen</h5>
                            <label for="dokumen">Upload fie <small>(Maks 20 Mb dengan ekstensi PDF)</small></label>
                            <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                        </div>
                        <div class="form-group">
                            <label for="url">Atau masukkan URL <small>(Cth. https://google.com)</small></label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>