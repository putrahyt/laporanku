<?php 
date_default_timezone_set('Asia/Jakarta');

class Mentor extends Controller
{
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Mentor - Laporanku';
        $data['pesertaDisetujui'] = $this->model('Laporanku_model')->getPesertaDisetujui($_SESSION['session']['username']);
        $data['pesertaBelumDisetujui'] = $this->model('Laporanku_model')->getPesertaBelumDisetujui($_SESSION['session']['username']);
        $this->view('templates/header', $data);
        $this->view('mentor/index', $data);
        $this->view('templates/footer');
    }

    public function datadiri() 
    {
        $data['title'] = 'Mentor - Laporanku';
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($_SESSION['session']['username']);
        $data['dataPeserta'] = $this->model('Laporanku_model')->getJumlahPesertaByMentor($data['mentor']['username']);
        $this->view('templates/header', $data);
        $this->view('mentor/datadiri', $data);
        $this->view('templates/footer');
    }

    public function getUbahMentor()
    {
        echo json_encode($this->model('Laporanku_model')->getMentorById($_POST['id']));
    }

    public function ubahDataMentor()
    {
        $cekMentorById = $this->model('Laporanku_model')->getMentorById($_POST['id']);
        $cekUserByUsn = $this->model('Laporanku_model')->getUserByUsn($_POST);
        $cekMentorByEmail = $this->model('Laporanku_model')->getUserByEmail($_POST);
        
        if ($cekUserByUsn) {
            if($cekMentorById['username'] !== $cekUserByUsn['username']) {
                Flasher::setFlash('Username tersebut sudah digunakan', 'error');
                header("Location: " . BASEURL . '/mentor/datadiri');
                exit;
            }
        }

        if ($cekMentorByEmail) {
            if($cekMentorById['email'] !== $cekMentorByEmail['email']) {
                Flasher::setFlash('Email tersebut sudah digunakan', 'error');
                header("Location: " . BASEURL . '/mentor/datadiri');
                exit;
            }
        } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Invalid email format', 'error');
            header("Location: " . BASEURL . '/mentor/datadiri');
            exit;
        }

        // Upload gambar
        $inputGambar = $_FILES["gambar"]["error"];
        if ($inputGambar === 4) {
            $gambar=$cekMentorById['image'];
        } else {
            // cek size
            if ($_FILES["gambar"]["size"] > 2000000) {
                Flasher::setFlash('Size dokumentasi terlalu besar. Maksimal size gambar 2 Mb', 'error');
                header("Location: " . BASEURL . '/mentor/datadiri');
                return false;
            }

            // cek ekstensi
            $ekstensiValid = ["jpg","jpeg","png"];
            $explode = explode('.', $_FILES['gambar']['name']);
            $ekstensi = strtolower(end($explode));
            if( !in_array($ekstensi, $ekstensiValid) ) {
                Flasher::setFlash('Masukkan file dengan ekstensi JPG, JPEG dan PNG', 'error');
                header("Location: " . BASEURL . '/mentor/datadiri');
                return false;
            }

            if ($cekMentorById['image'] !== 'default.jpg') {
                unlink('asset/img/' . $cekMentorById['image']);
            }
            
            $gambar = $this->model('Laporanku_model')->upload($_FILES['gambar'], $ekstensi);
            
        }

        if (!$gambar) {
            return false;
        } 

        if ($this->model('Laporanku_model')->ubahDataMentor($_POST, $gambar, $cekMentorById) > 0) {
            $_SESSION['session']['username'] = $_POST['username'];
            Flasher::setFlash('Data mentor berhasil diubah', 'success');
            header("Location: " . BASEURL . '/mentor/datadiri');
            exit;
        } else {
            header("Location: " . BASEURL . '/mentor/datadiri');
            exit;
        }
    
    }

    public function changePassword()
    {
        if (isset($_POST['passwordLama'])) {
            $user = $this->model('Laporanku_model')->getUser($_SESSION['session']);

            if (password_verify($_POST['passwordLama'], $user['password'])) {

                if(strlen($_POST['passwordBaru']) >= 8) {

                    if ($_POST['passwordBaru'] === $_POST['confirmPassBaru']) {
                        if ($this->model('Laporanku_model')->changePasswordMentor($_POST, $_SESSION['session']) > 0) {
                            Flasher::setFlash('Password berhasil diubah!', 'success');
                            header("Location: " . BASEURL . '/mentor/changePassword');
                            exit;
                        } else {
                            Flasher::setFlash('Password gagal diubah!', 'error');
                            header("Location: " . BASEURL . '/mentor/changePassword');
                            exit;
                        }
                    } else {
                        Flasher::setFlash('Konfirmasi Password baru tidak sama!', 'error');
                        header("Location: " . BASEURL . '/mentor/changePassword');
                        exit;
                    }

                } else {
                    Flasher::setFlash('Password setidaknya minimal 8 karakter!', 'error');
                    header("Location: " . BASEURL . '/mentor/changePassword');
                    exit;
                }

            } else {
                Flasher::setFlash('Password lama anda salah!', 'error');
                header("Location: " . BASEURL . '/mentor/changePassword');
                exit;
            }
        } else {
            $data['title'] = 'Mentor - Laporanku';
            $this->view('templates/header', $data);
            $this->view('mentor/changePassword', $data);
            $this->view('templates/footer');
        }

    }

    public function peserta($id=1)
    {
        $jmlDataPerHalaman = 20;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getTotalAktifPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(empty($_POST['caripeserta'])) {
            $data['peserta'] = $this->model('Laporanku_model')->paginationDataPesertaMentor($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['peserta'] = $this->model('Laporanku_model')->getPeserta($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        }
        
        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/peserta', $data);
        $this->view('templates/footer');
    }

    public function detailPeserta($id)
    {
        $data['title'] = 'Mentor - Laporanku';
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaDisetujuiById($id);
        if ($data['peserta'] === false) {
            header("Location: " . BASEURL . '/mentor/peserta');
            exit;
        }
        $this->view('templates/header', $data);
        $this->view('mentor/detailPeserta', $data);
        $this->view('templates/footer');
    }

    public function belumdisetujui($id=1)
    {
        $jmlDataPerHalaman = 20;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getTotalNonAktifPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(empty($_POST['caripeserta'])) {
            $data['peserta'] = $this->model('Laporanku_model')->paginationDataNonPesertaMentor($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['peserta'] = $this->model('Laporanku_model')->getPeserta($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        }
        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/belumdisetujui', $data);
        $this->view('templates/footer');
    }

    public function detailPesertaBelumDisetujui($id)
    {
        $data['title'] = 'Mentor - Laporanku';
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaNonDisetujuiById($id);
        if ($data['peserta'] === false) {
            header("Location: " . BASEURL . '/mentor/belumdisetujui');
            exit;
        }
        $this->view('templates/header', $data);
        $this->view('mentor/detailPesertaBelumDisetujui', $data);
        $this->view('templates/footer');
    }

    public function accpeserta($id)
    {
        if ($this->model('Laporanku_model')->accpeserta($id) > 0) {
            Flasher::setFlash('Peserta berhasil disetujui', 'success');
            header("Location: " . BASEURL . '/mentor/belumdisetujui');
            exit;
        }
    }

    public function laporanharian($id=1)
    {
        $jmlDataPerHalaman = 15;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getTotalAktifPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(empty($_POST['caripeserta'])) {
            $data['peserta'] = $this->model('Laporanku_model')->paginationDataPesertaMentor($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['peserta'] = $this->model('Laporanku_model')->getPeserta($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        }

        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/laporanharian', $data);
        $this->view('templates/footer');
    }

    public function laporanharianpeserta($peserta, $id=1) 
    {
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($peserta);
        if($data['peserta']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanharian');
            exit;
        }

        $jmlDataPerHalaman = 20;
        $data['jmlLaporanHarian'] = count($this->model('Laporanku_model')->getLaporanHarianByPeserta($peserta));
        $data['jmlHalaman'] = ceil($data['jmlLaporanHarian'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;
        
        $data['laporanpeserta'] = $this->model('Laporanku_model')->paginationLaporanHarian($data['awalData'], $jmlDataPerHalaman, $_SESSION['session'], $peserta);
        
        if(isset($_POST['tombolcarilaporan'])) {
            if(empty($_POST['cariaktivitas'])) {
                $data['laporanpeserta'] = $this->model('Laporanku_model')->paginationLaporanHarian($data['awalData'], $jmlDataPerHalaman, $_SESSION['session'], $peserta);
            } else {
                $data['laporanpeserta'] = $this->model('Laporanku_model')->getLaporanHarianByKeyword($data['awalData'], $jmlDataPerHalaman, $_SESSION['session'], $peserta);
            }
        } 

        if(isset($_POST['tombolcaritanggal'])) {
            if(empty($_POST['tanggalaktivitas'])) {
                $data['laporanpeserta'] = $this->model('Laporanku_model')->paginationLaporanHarian($data['awalData'], $jmlDataPerHalaman, $_SESSION['session'], $peserta);
            } else {
                $tanggalArray = explode(" - ", $_POST['tanggalaktivitas']);
                $tanggalAwal = $tanggalArray[0];
                $tanggalAkhir = $tanggalArray[1];
                $data['laporanpeserta'] = $this->model('Laporanku_model')->getAktivitasByTanggal($data['awalData'], $jmlDataPerHalaman, $tanggalAwal, $tanggalAkhir, $_SESSION['session'], $peserta);
            }
        } 

        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/laporanharianpeserta', $data);
        $this->view('templates/footer');
    }

    public function detailaktivitas($id) {
        $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianById($id);
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($data['laporanharian']['username']);

        if($data['laporanharian']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanharian');
            exit;
        }

        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/detailaktivitas', $data);
        $this->view('templates/footer');
    }

    public function acclaporanharian($id) {
        $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianById($id);

        if($data['laporanharian']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanharian/');
            exit;
        }

        if ($this->model('Laporanku_model')->acclaporanpeserta($id) > 0) {
            Flasher::setFlash('Laporan harian berhasil disetujui', 'success');
            header("Location: " . BASEURL . '/mentor/laporanharianpeserta/' . $data['laporanharian']['username']);
            exit;
        }
    }

    public function accsemualaporanharian($user) {
        $user = base64_decode($user);
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($user);

        if($data['peserta']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanharian/');
            exit;
        }

        if ($this->model('Laporanku_model')->accsemualaporanharian($user) > 0) {
            Flasher::setFlash('Laporan harian berhasil disetujui', 'success');
            header("Location: " . BASEURL . '/mentor/laporanharianpeserta/' . $user);
            exit;
        }
    }

    public function tolaklaporanharian() {
        $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianById($_POST['id']);

        if($data['laporanharian']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanharian');
            exit;
        }

        if ($this->model('Laporanku_model')->tolaklaporanpeserta($_POST) > 0) {
            Flasher::setFlash('Laporan harian ditolak', 'success');
            header("Location: " . BASEURL . '/mentor/laporanharianpeserta/' . $data['laporanharian']['username']);
            exit;
        }
    }

    public function laporanakhir($id=1)
    {
        $jmlDataPerHalaman = 15;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getTotalAktifPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(empty($_POST['caripeserta'])) {
            $data['peserta'] = $this->model('Laporanku_model')->paginationDataPesertaMentor($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['peserta'] = $this->model('Laporanku_model')->getPeserta($_SESSION['session']['username'], $data['awalData'], $jmlDataPerHalaman);
        }

        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/laporanakhir', $data);
        $this->view('templates/footer');
    }

    public function laporanakhirpeserta($peserta) {
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($peserta);
        if($data['peserta']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanakhir');
            exit;
        }


        $data['laporanpeserta'] = $this->model('Laporanku_model')->getLaporanAkhirByUsn($data['peserta']);
        
        $data['title'] = 'Mentor - Laporanku';
        $this->view('templates/header', $data);
        $this->view('mentor/laporanakhirpeserta', $data);
        $this->view('templates/footer');
    }

    public function acclaporanakhir($id) {
        $data['laporanakhir'] = $this->model('Laporanku_model')->getLaporanAkhirById($id);

        if($data['laporanakhir']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanakhir');
            exit;
        }

        if ($this->model('Laporanku_model')->acclaporanakhirpeserta($id) > 0) {
            Flasher::setFlash('Laporan akhir berhasil disetujui', 'success');
            header("Location: " . BASEURL . '/mentor/laporanakhirpeserta/' . $data['laporanakhir']['username']);
            exit;
        }
    }

    public function tolaklaporanakhir() {
        $data['laporanakhir'] = $this->model('Laporanku_model')->getLaporanAkhirById($_POST['id']);

        if($data['laporanakhir']['mentor'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/mentor/laporanakhir');
            exit;
        }

        if ($this->model('Laporanku_model')->tolaklaporanakhir($_POST) > 0) {
            Flasher::setFlash('Laporan akhir ditolak', 'success');
            header("Location: " . BASEURL . '/mentor/laporanakhirpeserta/' . $data['laporanakhir']['username']);
            exit;
        }
    }
}