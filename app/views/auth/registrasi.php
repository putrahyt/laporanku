<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-3 col-lg-6 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-4">
                            <div class="col-lg-12">
                                <div class="text-center mb-3">
                                    <img src="<?= BASEURL; ?>/asset/img/logo.png" class="rounded" alt="logo" width="20%">
                                </div>
                                <div class="text-center">
                                    <h1 class="h3 text-gray-900 mb-4">Registrasi Akun Peserta</h1>
                                </div>
                                <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                                <form class="user" method="post" action="<?= BASEURL ?>/auth/addPeserta">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="fullname" name="fullname"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username"
                                            placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password"
                                            placeholder="Password (Minimal 8 karakter)" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="instansi" name="instansi"
                                            placeholder="Instansi" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="jurusan" name="jurusan"
                                            placeholder="Jurusan" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email"
                                            placeholder="Email" required>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                            <label for="mentor">Pilih Mentor Anda</label>
                                            <select class="form-control" id="mentor" name="mentor" required>
                                            <option disabled selected value>--Mentor--</option>
                                            <?php foreach($data['mentor'] as $mentor) : ?>
                                                <option value="<?= $mentor['username']; ?>"><?= $mentor['full_name']; ?></option>
                                            <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="divisi">Pilih Bidang Magang</label>
                                            <select class="form-control" id="divisi" name="divisi" required>
                                            <option disabled selected value>--Divisi--</option>
                                            <option value="Aplikasi Informatika">Aplikasi Informatika</option>
                                            <option value="Teknologi Informatika">Teknologi Informatika</option>
                                            <option value="Komunikasi Publik">Komunikasi Publik</option>
                                            <option value="Persandian">Persandian</option>
                                            <option value="Statistika dan Informasi Publik">Statistika dan Informasi Publik</option>
                                            <option value="Sekretariat">Sekretariat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Registrasi Akun
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="<?= BASEURL ?>/auth/login">Sudah Punya Akun? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>