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
            <h1 class="my-4">Data Laporan Akhir</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/admin"> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Laporan Akhir</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <form action="<?= BASEURL . '/admin/laporan' ?>" method="post">
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" placeholder="Cari..." name="carijudul" id="carijudul" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolcari" name="tombolcarijudul">Cari</button>
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
                                            <th scope="col" width="5%" class="text-center">Profil</th>
                                            <th scope="col" width="20%" class="text-center">Tanggal</th>
                                            <th scope="col" width="20%" class="text-center">Nama</th>
                                            <th scope="col" class="text-center">Judul</th>
                                            <th scope="col" width="13%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$data['laporan']) : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada Laporan</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach($data['laporan'] as $laporan) : ?>
                                                <?php if($laporan['status'] === '1') : ?>
                                                    <tr>
                                                        <th scope="row"><?= ++$data['awalData'] ?></th>
                                                        <td class="text-center"><img src="<?= BASEURL . '/asset/img/' . $laporan['gambar'] ?>" width="100%" height="44px" class="rounded-circle" style="object-fit: cover;" alt="profil"></td>
                                                        <td class="text-center"><?= date('d F Y, h:i:s A', $laporan['tanggal']) ?></td>
                                                        <td><?= $laporan['fullname'] ?></td>
                                                        <td><?= $laporan['aktivitas'] ?></td>
                                                        <td class="text-center">
                                                            <?php if($laporan['dokumen'] !== null) : ?>
                                                                <a href="<?= BASEURL . '/asset/filelaporanakhir/' . $laporan['dokumen'] ?>" target="_blank"><i class="fa-solid fa-eye fa-sm" title="Lihat"></i></a>
                                                                <a href="<?= BASEURL . '/asset/filelaporanakhir/' . $laporan['dokumen'] ?>" download><i class="fa-solid fa-download fa-sm" title="Download"></i></a>
                                                            <?php endif ?>
                                                            <?php if($laporan['url'] !== null) : ?>
                                                                <a href="<?= $laporan['url'] ?>" target="_blank"><i class="fa-solid fa-link fa-sm" title="URL"></i></a>
                                                            <?php endif ?>
                                                            <a href="<?= BASEURL . '/admin/detaillaporan/' . $laporan['id'] ?>"><i class="fa-solid fa-circle-info fa-sm" title="Detail"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>                                            
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm justify-content-center">
                                <?php if($data['hlmAktif'] > 1) : ?>
                                    <?php $prev = $data['hlmAktif'] - 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/laporan/' . $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/admin/laporan/' . $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/laporan/' . $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/laporan/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>