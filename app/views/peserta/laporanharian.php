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
            <h1 class="my-4">Laporan Harian</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/peserta"> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Harian</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary mb-4 addLaporanHarian" data-toggle="modal" data-target="#LaporanHarian" data-url="<?= BASEURL ?>"><i class="fas fa-plus"></i>
                                Tambah Laporan Harian
                            </button>
                            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <form action="<?= BASEURL . '/peserta/laporanharian' ?>" method="post">
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" placeholder="Cari aktivitas..." name="cariaktivitas" id="cariaktivitas" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolcari" name="tombolcariaktivitas">Cari</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Pilih Rentang Tanggal" name="tanggalaktivitas" id="tanggalaktivitas" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolcari" name="tombolcaritanggal">Cari</button>
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
                                            <th scope="col" width="1%" class="text-center">Status</th>
                                            <th scope="col" width="15%"class="text-center">Tanggal</th>
                                            <th scope="col" class="text-center">Aktivitas</th>
                                            <th scope="col" class="text-center">Catatan</th>
                                            <th scope="col" width="2%" class="text-center">Dokumentasi</th>
                                            <th scope="col" width="10%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$data['laporanharian']) : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada aktivitas</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach($data['laporanharian'] as $laporanharian) : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$data['awalData'] ?></th>
                                                    <?php if($laporanharian['status'] === '1') {
                                                        echo '<td class="text-center" title="diterima"><i class="fa-solid fa-check fa-xl" style="color: #0bef4f"></i></td>';
                                                    } else if($laporanharian['status'] === '2') {
                                                        echo '<td class="text-center" title="ditolak"><i class="fa-solid fa-xmark fa-xl" style="color: #ef0b0b"></i></td>';
                                                    } else {
                                                        echo '<td class="text-center" title="proses"><i class="fa-solid fa-rotate fa-xl"></i></td>';
                                                    } ?>
                                                    <td class="text-center"><?= date('d F Y, h:i:s A', $laporanharian['tanggal']) ?></td>
                                                    <td><?= $laporanharian['aktivitas'] ?></td>
                                                    <td><?= $laporanharian['catatan'] ?></td>
                                                    <td class="text-center">
                                                        <?php if($laporanharian['dokumentasi'] !== null) : ?>
                                                            <?php $ekstensi = explode('.', $laporanharian['dokumentasi']) ?>
                                                            <?php $ekstensi = end($ekstensi) ?>
                                                            <?php if($ekstensi === 'png' || $ekstensi === 'jpeg' || $ekstensi === 'jpg') : ?>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $laporanharian['dokumentasi'] ?>" target="_blank"><i class="fa-solid fa-eye fa-lg" title="Lihat"></i></a>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $laporanharian['dokumentasi'] ?>" download><i class="fa-solid fa-download fa-lg" title="Download"></i></a>
                                                            <?php else : ?>
                                                                <a href="<?= BASEURL . '/asset/fileLaporanHarian/' . $laporanharian['dokumentasi'] ?>" download><i class="fa-solid fa-download fa-lg" title="Download"></i></a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if($laporanharian['url'] !== null) : ?>
                                                            <a href="<?= $laporanharian['url'] ?>" target="_blank"><i class="fa-solid fa-link fa-lg" title="URL"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php switch($laporanharian['status']) {
                                                            case 1:
                                                                echo '<a href="'.BASEURL.'/peserta/detailaktivitas/'.$laporanharian['id'].'" class="btn btn-primary" title="Detail"><i class="fa-solid fa-info fa-xs"></i></a>';
                                                                break;
                                                            case 2:
                                                                echo '<a href="'.BASEURL.'/peserta/detailaktivitas/'.$laporanharian['id'].'" class="btn btn-primary" title="Detail"><i class="fa-solid fa-info fa-xs"></i></a>';
                                                                break;
                                                            default:
                                                                echo '<a href="#" class="btn btn-success ubahLaporanHarian" title="Ubah" data-toggle="modal" data-target="#LaporanHarian" data-url="'.BASEURL.'" data-id="'.$laporanharian['id'].'"><i class="fa-solid fa-edit fa-xs"></i></a>
                                                                <a href="'.BASEURL.'/peserta/deleteaktivitas/'.$laporanharian['id'].'" class="btn btn-danger deleteAktivitas" title="Hapus"><i class="fa-solid fa-trash fa-xs"></i></a>';
                                                                break;
                                                        } ?>
                                                    </td>
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
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/laporanharian/' . $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/peserta/laporanharian/' . $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/laporanharian/' . $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/laporanharian/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                            <small><i>Catatan: Peserta wajib mengirim laporan harian selama magang</i></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="LaporanHarian" tabindex="-1" aria-labelledby="Data" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Laporan Harian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/peserta/addLaporanHarian" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">    
                    <div class="form-group">
                            <label for="aktivitas">Aktivitas</label>
                            <input type="text" class="form-control" id="aktivitas" name="aktivitas" required>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="5" required></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h5>Dokumentasi</h5>
                            <label>Upload file <small>(Maks 2 Mb dengan ekstensi PDF, Word, Excel atau JPEG)</small></label>
                            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
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