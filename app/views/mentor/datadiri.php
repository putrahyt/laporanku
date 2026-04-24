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
                    <h1 class="my-4">Data Diri</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/mentor">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                        <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
                    </ol>
                    <div class="card shadow-sm mb-4 p-1" style="max-width: 100%;">
                        <div class="row no-gutters ml-1">
                            <div class="col-md-4">
                                <img src="<?= BASEURL . '/asset/img/' . $data['mentor']['image'] ?>" alt="profil" width="100%" height="80%" class="mt-4 mb-3" style="object-fit: cover;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title text-primary ml-1">Info</h4>
                                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
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
                                                        <td class="text-muted"><a href="<?= BASEURL . '/mentor/peserta/' ?>"><?= $data['dataPeserta'][0]['COUNT(*)'] ?> Orang</a></td>
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
                                    <button type="button" class="btn btn-success mb-4 ubahDataMentor" data-toggle="modal" data-target="#ubahDataMentor" data-id="<?= $data['mentor']['id']?>" data-url=<?= BASEURL ?>></i>
                                        Ubah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>

    <div class="modal fade" id="ubahDataMentor" tabindex="-1" aria-labelledby="Data" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Data">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/mentor/ubahDataMentor" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
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
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="noHP">No.HP</label>
                            <input type="number" class="form-control" id="noHP" name="noHP" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Upload gambar <small>(Maks 2 Mb dengan ekstensi JPG, JPEG dan PNG)</small></label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>