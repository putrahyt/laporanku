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
            <h1 class="my-4">Data Peserta</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/admin"> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Peserta</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-primary mb-3">Peserta Magang</h3>
                            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form action="<?= BASEURL . '/admin/peserta' ?>" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari peserta..." name="caripeserta" id="caripeserta" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolCariPeserta">Cari</button>
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
                                            <th scope="col" width="60px" class="text-center">Image</th>
                                            <th scope="col" width="15%" class="text-center">Fullname</th>
                                            <th scope="col" class="text-center">Instansi</th>
                                            <th scope="col" class="text-center">Jurusan</th>
                                            <th scope="col" class="text-center">Mentor</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php if(!$data['peserta']) : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data peserta</td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach($data['peserta'] as $peserta) : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$data['awalData'] ?></th>
                                                    <td><img src="<?= BASEURL . '/asset/img/' . $peserta['image'] ?>" width="100%" height="50px" class="rounded-circle" style="object-fit: cover;" alt="profil"></td>
                                                    <td><?= $peserta['fullname'] ?></td>
                                                    <td><?= $peserta['instansi'] ?></td>
                                                    <td><?= $peserta['jurusan'] ?></td>
                                                    <td><?= $peserta['full_name'] ?></td>
                                                    <?php if($peserta['is_actived'] == 0) : ?>
                                                        <td class="text-center"><span class="badge badge-pill badge-danger">Belum Disetujui Mentor</span></td>
                                                    <?php else : ?>
                                                        <td class="text-center"><span class="badge badge-pill badge-success">Sudah Disetujui Mentor</span></td>
                                                    <?php endif ?>
                                                    <td class="text-center">
                                                        <a href="<?= BASEURL . '/admin/detailPeserta/' . $peserta['id'] ?>" class="btn btn-primary" title="Detail"><i class="fa-solid fa-circle-info fa-xs"></i></a>
                                                        <a href="<?= BASEURL . '/admin/deletePeserta/' . $peserta['id'] . '/' . $peserta['username'] ?>" class="btn btn-danger deletePeserta" title="Hapus"><i class="fas fa-trash fa-xs"></i></a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php endif ?>
                                        </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm justify-content-center">
                                <?php if($data['hlmAktif'] > 1) : ?>
                                    <?php $prev = $data['hlmAktif'] - 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/peserta/' . $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/admin/peserta/' . $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/peserta/' . $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/peserta/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>