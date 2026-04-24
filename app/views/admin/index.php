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
            <h1 class="my-4">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
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
                                        TOTAL PESERTA</div>
                                    <div class="h5 mb-0 font-weight text-gray-800"><?= $data['jmlPeserta'][0]['COUNT(*)'] ?></div>
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
                                        TOTAL MENTOR</div>
                                    <div class="h5 mb-0 font-weight text-gray-800"><?= $data['jmlMentor'][0]['COUNT(*)'] ?></div>
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