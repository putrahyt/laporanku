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
            <h1 class="my-4">Laporan Harian Peserta</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/mentor"> Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/mentor/laporanharian"> Laporan Harian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Harian Peserta</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-primary mb-3">Laporan <?= $data['peserta']['fullname'] ?></h3>
                            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <form action="<?= BASEURL . '/mentor/laporanharianpeserta/' . $data['peserta']['username'] ?>" method="post">
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" placeholder="Cari aktivitas..." name="cariaktivitas" id="cariaktivitas" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolcarilaporan" name="tombolcarilaporan">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form action="<?= BASEURL . '/mentor/laporanharianpeserta/' .$data['peserta']['username'] ?>" method="post">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Pilih Rentang Tanggal" name="tanggalaktivitas" id="tanggalaktivitas" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolcaritanggal" name="tombolcaritanggal">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table-sm">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" width="1%">No</th>
                                            <th scope="col" width="11%" class="text-center">Status</th>
                                            <th scope="col" width="15%" class="text-center">Tanggal</th>
                                            <th scope="col" class="text-center">Aktivitas</th>
                                            <th scope="col" class="text-center">Catatan</th>
                                            <th scope="col" width="9%" class="text-center">Dokumentasi</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$data['laporanpeserta']) : ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada laporan</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php $i = 1 ?>
                                            <?php foreach($data['laporanpeserta'] as $peserta) : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$data['awalData'] ?></th>
                                                    <td class="text-center">
                                                        <?php if($peserta['status'] === '0') : ?>
                                                            <a href="<?= BASEURL . '/mentor/acclaporanharian/' . $peserta['id'] ?>" class="badge badge-success acclaporanharian"><i class="fa-solid fa-check"></i> Setujui</a>
                                                            <a href="#" class="badge badge-danger tolaklaporanharian" data-toggle="modal" data-target="#tolaklaporan" data-id="<?= $peserta['id'] ?>"><i class="fa-solid fa-xmark"></i> Tolak</a>
                                                        <?php endif ?>

                                                        <?php if($peserta['status'] === '1') : ?>
                                                            <small class="badge badge-success">Disetujui</small>
                                                        <?php endif ?>

                                                        <?php if($peserta['status'] === '2') : ?>
                                                            <small class="badge badge-danger">Ditolak</small>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center"><?= date('d F Y, h:i:s A', $peserta['tanggal']) ?></td>
                                                    <td><?= $peserta['aktivitas'] ?></td>
                                                    <td><?= $peserta['catatan'] ?></td>
                                                    <td class="text-center">
                                                        <?php if($peserta['dokumentasi'] !== null) : ?>
                                                            <?php $ekstensi = explode('.', $peserta['dokumentasi']) ?>
                                                            <?php $ekstensi = end($ekstensi) ?>
                                                            <?php if($ekstensi === 'png' || $ekstensi === 'jpeg' || $ekstensi === 'jpg') : ?>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $peserta['dokumentasi'] ?>" target="_blank"><i class="fa-solid fa-eye fa-lg" title="Lihat"></i></a>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $peserta['dokumentasi'] ?>" download><i class="fa-solid fa-download fa-lg" title="Download"></i></a>
                                                            <?php else : ?>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $peserta['dokumentasi'] ?>" download><i class="fa-solid fa-download fa-lg" title="Download"></i></a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if($peserta['url'] !== null) : ?>
                                                            <a href="<?= $peserta['url'] ?>" target="_blank"><i class="fa-solid fa-link fa-lg" title="URL"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center"><a href="<?= BASEURL . '/mentor/detailaktivitas/' . $peserta['id'] ?>" class="btn btn-primary" title="Detail"><i class="fa-solid fa-info fa-xs"></i></a></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>                                            
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm justify-content-center">
                                <?php if($data['hlmAktif'] > 1) : ?>
                                    <?php $prev = $data['hlmAktif'] - 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/laporanharianpeserta/' .  $data['peserta']['username'] . '/' . $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/mentor/laporanharianpeserta/' . $data['peserta']['username'] . '/' . $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/laporanharianpeserta/' . $data['peserta']['username'] . '/' . $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/laporanharianpeserta/' . $data['peserta']['username'] . '/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                            <?php 
                                $status = []; $username = []; 
                            ?>
                            <?php foreach($data['laporanpeserta'] as $laporan) : ?>
                                <?php if($laporan['status'] === '0') : ?>
                                    <?php $status[] = $laporan['status'] ?>
                                    <?php $username[] = $laporan['username'] ?>
                                <?php endif ?>
                            <?php endforeach ?>
                            <?php if(in_array(0, $status) ) : ?>
                                <?php $user= base64_encode($username[0]); ?>
                                <a href="<?= BASEURL . '/mentor/accsemualaporanharian/' . $user ?>" class="btn btn-success mt-1 accsemualaporanharian"><i class="fa-solid fa-check-double"></i> Setujui Semua</a>    
                            <?php endif ?>
                            <a href="<?= BASEURL . '/mentor/laporanharian/' ?>" class="btn btn-danger mt-1">Kembali</a>
                            <div class="mt-2">
                                <small><i>Catatan: Laporan harian akan terhapus jika sudah lebih dari 6 bulan</i></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="tolaklaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL . '/mentor/tolaklaporanharian/' . $peserta['id'] ?>" method="post">
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