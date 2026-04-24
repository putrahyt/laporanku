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
            <h1 class="my-4">Peserta Yang Diampuh</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/mentor">Data Mentor</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL . '/admin/detailmentor/' . $data['mentor']['id'] ?>">Detail Mentor</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peserta</li>
            </ol>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-primary mb-3">Mentor : <?= $data['mentor']['full_name'] ?></h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form action="<?= BASEURL . '/admin/datapesertamentor/' .$data['mentor']['username']. '/' .$data['mentor']['id'] ?>" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari Nama Peserta..." name="caripesertabymentor" id="caripesertabymentor" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolCariPesertar">Cari</button>
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
                                            <th scope="col" width="60px">Image</th>
                                            <th scope="col">Nama Peserta</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Instansi</th>
                                            <th scope="col">Jurusan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$data['dataPesertaMentor']) : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data peserta</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach($data['dataPesertaMentor'] as $peserta) : ?>
                                                <?php if($peserta['mentor'] === $data['mentor']['username'] && $peserta['is_actived'] === '1') : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$data['awalData'] ?></th>
                                                    <td><img src="<?= BASEURL . '/asset/img/' . $peserta['image'] ?>" width="100%" height="50px" style="object-fit: cover;" class="rounded-circle" alt="profil"></td>
                                                    <td><?= $peserta['fullname'] ?></td>
                                                    <td><?= $peserta['username'] ?></td>
                                                    <td><?= $peserta['instansi'] ?></td>
                                                    <td><?= $peserta['jurusan'] ?></td>
                                                </tr>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm justify-content-center">
                                <?php if($data['hlmAktif'] > 1) : ?>
                                    <?php $prev = $data['hlmAktif'] - 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapesertamentor/'.$data['mentor']['username']. '/' .$data['mentor']['id']  .'/'. $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/admin/datapesertamentor/' . $data['mentor']['username'] . '/' .$data['mentor']['id'] .'/'. $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapesertamentor/' . $data['mentor']['username'] . '/' .$data['mentor']['id'] .'/'. $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapesertamentor/' . $data['mentor']['username'] . '/' .$data['mentor']['id'] .'/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                            <a href="<?= BASEURL . '/admin/detailmentor/' . $data['mentor']['id'] ?>" class="btn btn-danger mt-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            
                
        </div>
    </main>