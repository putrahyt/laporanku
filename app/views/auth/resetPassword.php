<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            
            <div class="col-lg-5">
                <div><br><br><br><br></div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-3">
                                    <div class="text-center mb-3">
                                        <img src="<?= BASEURL; ?>/asset/img/logo.png" class="rounded" alt="logo" width="30%">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-3 mt-1">Lupa Password</h1>
                                    </div>
                                    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::type(); ?>"></div>
                                    <form class="user" method="post" action="<?= BASEURL; ?>/auth/sendPasswordReset">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email"
                                                placeholder="Masukkan Email Anda..." required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Kirim
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="<?= BASEURL; ?>/auth/login">Kembali ke login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>