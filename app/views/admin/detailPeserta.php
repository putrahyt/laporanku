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
                    <h1 class="my-4">Detail Peserta</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/peserta">Data Peserta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Peserta</li>
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
                                                    <td class="text-muted"><a href="<?= BASEURL . '/admin/detailMentor/' . $data['mentor']['id'] ?>"><?= $data['peserta']['full_name'] ?></a></td>
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
                                    <a href="<?= BASEURL ?>/admin/peserta" class="btn btn-danger ml-1">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>