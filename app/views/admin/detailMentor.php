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
                    <h1 class="my-4">Detail Mentor</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/mentor">Data Mentor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Mentor</li>
                    </ol>
                    <div class="card shadow-sm mb-4 p-1" style="max-width: 100%;">
                        <div class="row no-gutters ml-1">
                            <div class="col-md-4">
                                <img src="<?= BASEURL . '/asset/img/' . $data['mentor']['image'] ?>" alt="profil" width="100%" height="85%" style="object-fit: cover;" class="mt-4 mb-3">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title text-primary ml-1">Mentor</h4>
                                    <div class="table-responsive">
                                        <table class="table table-sm ml-0 table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td width="45%"><b>Nama Lengkap</b></td>
                                                    <td class="text-muted"><?= $data['mentor']['full_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Username</b></td>
                                                    <td class="text-muted"><?= $data['mentor']['username'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Peserta yang Disetujui</b></td>
                                                    <?php if($data['dataPeserta'][0]['COUNT(*)'] == 0) : ?>
                                                        <td class="text-muted"><?= $data['dataPeserta'][0]['COUNT(*)'] ?> Orang</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><a href="<?= BASEURL . '/admin/datapesertamentor/' . $data['mentor']['username'] . '/' . $data['mentor']['id'] ?>"><?= $data['dataPeserta'][0]['COUNT(*)'] ?> Orang</a></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Jabatan</b></td>
                                                    <td class="text-muted"><?= $data['mentor']['jabatan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Divisi</b></td>
                                                    <?php if($data['mentor']['divisi'] === null) : ?>
                                                        <td class="text-muted">-</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><?= $data['mentor']['divisi'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <?php if($data['mentor']['email'] === null) : ?>
                                                        <td class="text-muted">-</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><?= $data['mentor']['email'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <td><b>No HP</b></td>
                                                    <?php if($data['mentor']['noHP'] === null) : ?>
                                                        <td class="text-muted">-</td>
                                                    <?php else : ?>
                                                        <td class="text-muted"><?= $data['mentor']['noHP'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Date Created</b></td>
                                                    <td class="text-muted"><?= date('d F Y',$data['mentor']['date_created']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="<?= BASEURL ?>/admin/mentor" class="btn btn-danger ml-1">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>