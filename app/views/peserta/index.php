<?php if($data['peserta']['is_actived'] === 1) : ?>
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
            <h1 class="my-4">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h4>LAPORAN-KU</h4>
                        <p class="text-justify">Selamat datang di website LAPORAN-KU, platform yang dirancang khusus untuk para peserta magang di Dinas Komunikasi dan Informatika (Diskominfo) Kota Medan!
                            LAPORAN-KU merupakan website yang dirancang untuk memudahkan peserta magang dalam melaporkan tugas harian serta tugas akhir selama magang di Dinas Komunikasi dan Informatika Kota Medan.</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        LAPORAN HARIAN</div>
                                    <div class="h5 mb-0 font-weight text-gray-800"><?= $data['laporanharian'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        LAPORAN AKHIR</div>
                                    <div class="h5 mb-0 font-weight text-gray-800"><?= $data['laporanakhir'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
<?php else : ?>
</div>
</div>
</nav>
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="my-4">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
            <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4>LAPORAN-KU</h4>
                        <p class="text-justify">Akun anda belum disetujui oleh mentor. Silahkan hubungi mentor anda untuk menyetujui akun</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endif ?>