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
            <h1 class="my-4">Data Mentor</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>/admin"> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mentor</li>
            </ol>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary mb-4 addMentor" data-toggle="modal" data-target="#addMentor"><i class="fas fa-plus"></i>
                                Tambah Mentor
                            </button>
                            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form action="<?= BASEURL . '/admin/mentor' ?>" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari mentor..." name="carimentor" id="carimentor" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" id="tombolCariMentor">Cari</button>
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
                                            <th scope="col" class="text-center">Nama Lengkap</th>
                                            <th scope="col" class="text-center">Username</th>
                                            <th scope="col" class="text-center">Jabatan</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php if(!$data['mentor']) : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data mentor</td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach($data['mentor'] as $mentor) : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$data['awalData'] ?></th>
                                                    <td><img src="<?= BASEURL . '/asset/img/' . $mentor['image'] ?>" width="100%" height="50px" class="rounded-circle" style="object-fit: cover;" alt="profil"></td>
                                                    <td><?= $mentor['full_name'] ?></td>
                                                    <td><?= $mentor['username'] ?></td>
                                                    <td><?= $mentor['jabatan'] ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= BASEURL . '/admin/detailMentor/' . $mentor['id'] ?>" class="btn btn-primary" title="Detail"><i class="fa-solid fa-circle-info fa-xs"></i></a>
                                                        <a href="<?= BASEURL . '/admin/deleteMentor/' . $mentor['id'] . '/' . $mentor['username'] ?>" class="btn btn-danger deleteMentor" title="Hapus"><i class="fas fa-trash fa-xs"></i></a>
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
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/mentor/' . $prev ?>">Previous</a></li>
                                <?php endif ?>

                                <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                    <?php if($i == $data['hlmAktif']) : ?>
                                        <li class="page-item active"><a class="page-link" href="<?= BASEURL . '/admin/mentor/' . $i ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/mentor/' . $i ?>"><?= $i ?></a></li>
                                    <?php endif ?>
                                <?php endfor ?>

                                <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                    <?php $next = $data['hlmAktif'] + 1; ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/mentor/' . $next ?>">Next</a></li>
                                <?php endif ?>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addMentor" tabindex="-1" aria-labelledby="Data" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Data">Tambah Mentor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/admin/addMentor" method="POST">
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" disabled placeholder="12345678" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <select name="divisi" id="divisi" class="form-control" required>
                                <option disabled selected value>--Divisi--</option>
                                <option value="Aplikasi Informatika">Aplikasi Informatika</option>
                                <option value="Teknologi Informatika">Teknologi Informatika</option>
                                <option value="Komunikasi Publik">Komunikasi Publik</option>
                                <option value="Persandian">Persandian</option>
                                <option value="Statistika dan Informasi Publik">Statistika dan Informasi Publik</option>
                                <option value="Sekretariat">Sekretariat</option>
                            </select>
                        </div> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" name="submitmentor" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>