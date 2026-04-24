<?php
date_default_timezone_set('Asia/Jakarta');

class Auth extends Controller
{
    public function __construct()
    {
        // cek jika ada session
        if (isset($_SESSION['session'])) {

            $user = $this->model('Laporanku_model')->getUser($_SESSION['session']);

            // cek role
            if ($user['role'] == "admin") {
                header("Location: " . BASEURL . '/admin');
            } else if ($user['role'] == "mentor") {
                header("Location: " . BASEURL . '/mentor');
            } else if ($user['role'] == "peserta") {
                header("Location: " . BASEURL . '/peserta');
            }
        }

        // cek jika laporan harian sudah lebih dari 6 bulan maka hapus laporan tersebut
        $laporanharian = $this->model('Laporanku_model')->getAllLaporanHarian();
        foreach($laporanharian as $harian) {
            $tanggal = date('Y-m-d', $harian['tanggal']);
            $tanggalObj = new DateTime($tanggal);
            $today = new DateTime();
            $selisih = $today->diff($tanggalObj)->days;
            $laporanbytanggal = $this->model('Laporanku_model')->getAktivitasPesertaByTanggal($harian['tanggal']);

            if($selisih >= 184) {
                $this->model('Laporanku_model')->deleteaktivitasbytanggal($harian['tanggal']);
                unlink('asset/fileLaporanHarian/' . $laporanbytanggal['dokumentasi']);
            }
            
        }
    }

    public function index()
    {
        unset($_SESSION['user']);

        $data['title'] = 'Laporanku';
        $this->view('templates/landingpage_header', $data);
        $this->view('auth/index');
        $this->view('templates/landingpage_footer');
    }

    public function login()
    {
        unset($_SESSION['user']);

        $data['title'] = 'Login - Laporanku';
        $this->view('templates/auth_header', $data);
        $this->view('auth/login');
        $this->view('templates/auth_footer');
    }

    public function registrasi()
    {
        $data['title'] = 'Registrasi - Laporanku';
        $data['mentor'] = $this->model('Laporanku_model')->getAllMentor();
        $this->view('templates/auth_header', $data);
        $this->view('auth/registrasi', $data);
        $this->view('templates/auth_footer');
    }

    public function addPeserta()
    {
        $usn = $this->model('Laporanku_model')->getUserByUsn($_POST);
        $cekEmail = $this->model('Laporanku_model')->getUserByEmail($_POST);
        if ($usn) {
            Flasher::setFlash('Anda gagal registrasi karena Username tersebut sudah ada', 'error');
            header("Location: " . BASEURL . '/auth/registrasi');
            exit;
        } else if(strlen($_POST['password']) <= 7) {
            Flasher::setFlash('Password setidaknya minimal 8 karakter', 'error');
            header("Location: " . BASEURL . '/auth/registrasi');
            exit;
        } else if($cekEmail) {
            Flasher::setFlash('Email tersebut sudah digunakan', 'error');
            header("Location: " . BASEURL . '/auth/registrasi');
            exit;
        } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Invalid email format', 'error');
            header("Location: " . BASEURL . '/auth/registrasi');
            exit;
        } else {
            if ($this->model('Laporanku_model')->addPeserta($_POST) > 0) {
                Flasher::setFlash('Anda berhasil registrasi. Silahkan kembali ke halaman login', 'success');
                header("Location: " . BASEURL . '/auth/registrasi');
                exit;
            } else {
                Flasher::setFlash('Anda gagal registrasi', 'error');
                header("Location: " . BASEURL . '/auth/registrasi');
                exit;
            }
        }
    }

    public function do_login()
    {
        $usn = $this->model('Laporanku_model')->getUser($_POST);

        // cek user
        if ($usn) {
            
            // cek password
            if (password_verify($_POST['password'], $usn['password'])) {
                
                // buat session
                $_SESSION['session'] = [
                    'username' => $usn['username'],
                    'role' => $usn['role']
                ];

                // cek role
                if ($usn['role'] == "admin") {
                    header("Location: " . BASEURL . '/admin');
                } else if ($usn['role'] == "mentor") {
                    header("Location: " . BASEURL . '/mentor');
                } else if ($usn['role'] == "peserta") {
                    header("Location: " . BASEURL . '/peserta');
                }

            // Jika password salah
            } else {
                Flasher::setFlash('Password anda salah!', 'error');
                header("Location: " . BASEURL . '/auth/login');
                exit;
            }

        // jika tidak ada user
        } else {
            Flasher::setFlash('Username tidak ada!', 'error');
            header("Location: " . BASEURL . '/auth/login');
            exit;
        }
    }

    // Forget Password
    public function resetPassword() 
    {
        $data['title'] = 'Forget Password - Laporanku';
        $this->view('templates/auth_header', $data);
        $this->view('auth/resetPassword');
        $this->view('templates/auth_footer');
    }

    public function sendPasswordReset() 
    {
        $emailCek = $this->model('Laporanku_model')->getUserByEmail($_POST);
        
        if($emailCek) {
            $email = $_POST['email'];
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = time() + (60*5);
            $url = BASEURL;
            

            if($this->model('Laporanku_model')->updateUser($email, $token_hash, $expiry) > 0) {
                $mail = Mailer::sendEmail();
                
                $mail->setFrom("mylaporanku@gmail.com", "LaporanKu");
                $mail->addAddress($email, $emailCek['username']);
                $mail->Subject = "Password Reset";
                $mail->Body = 'Click <a href="'.$url.'/auth/changePassword/'.$token.'">here</a> to reset your password. Link expires after 5 minute';

                try {
                    $mail->send();
                } catch(Exception $e) {
                    echo "Message could not be sent. Mailer error: '. {$mail->ErrorInfo}.'";
                }

                Flasher::setFlash('Pesan terkirim, cek inbox email kamu', 'success');
                header("Location: " . BASEURL . '/auth/resetPassword');
                exit;
            }
        } else {
            Flasher::setFlash('Email tidak ditemukan!', 'error');
            header("Location: " . BASEURL . '/auth/resetPassword');
            exit;
        }
        


    }

    public function changePassword($token = null)
    {
        $token_hash = hash("sha256", $token);
        $cekToken = $this->model('Laporanku_model')->getUserByToken($token_hash);
        if(!$cekToken) {
            header("Location: " . BASEURL . '/auth/resetPassword');
            exit;
        } else if($cekToken['reset_token_expires_at'] <= time()) {
            Flasher::setFlash('Token has expired', 'error');
            header("Location: " . BASEURL . '/auth/resetPassword');
            exit;
        }  else {
            $data['token'] = $token;
            $data['title'] = 'Change Password - Laporanku';
            $this->view('templates/auth_header', $data);
            $this->view('auth/changePassword', $data);
            $this->view('templates/auth_footer');
        }
    }

    public function newPassword()
    {
        $cekToken = $this->model('Laporanku_model')->getUserByToken(hash("sha256", $_POST['token']));
        if($cekToken) {
            if(strlen($_POST['password']) <= 7) {
                Flasher::setFlash('Password setidaknya minimal 8 karakter', 'error');
                header("Location: " . BASEURL . '/auth/changePassword/' . $_POST['token']);
                exit;
            } 

            if ($this->model('Laporanku_model')->changePassword($_POST, $cekToken) > 0) {
                Flasher::setFlash('Password berhasil diubah!', 'success');
                header("Location: " . BASEURL . '/auth/login');
                unset($_SESSION['user']);
                exit;
            } else {
                Flasher::setFlash('Password gagal diubah!', 'error');
                header("Location: " . BASEURL . '/auth/login');
                unset($_SESSION['user']);
                exit;
            }
        } else {
            header("Location: " . BASEURL . '/auth/login');
        }
    }


    // Logout
    public function logout()
    {
        unset($_SESSION['session']);
        Flasher::setFlash('Anda telah logout!', 'success');
        header("Location: " . BASEURL . '/auth/login');
    }
}