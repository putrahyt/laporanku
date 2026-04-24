<?php 
date_default_timezone_set('Asia/Jakarta');

class Peserta extends Controller
{
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Peserta - Laporanku';
        $data['laporanakhir'] = count($this->model('Laporanku_model')->getTotalLaporanAKhirByUsn($_SESSION['session']));
        $data['laporanharian'] = count($this->model('Laporanku_model')->getTotalLaporanHarianByUsn($_SESSION['session']));
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        $this->view('templates/header', $data);
        $this->view('peserta/index', $data);
        $this->view('templates/footer');
    }

    public function datadiri()
    {
        $data['title'] = 'Peserta - Laporanku';
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($data['peserta']['mentor']);
        
        // cek actived
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('peserta/datadiri', $data);
        $this->view('templates/footer');
    }

    public function getUbahPeserta()
    {
        echo json_encode($this->model('Laporanku_model')->getPesertaById($_POST['id']));
    }

    public function ubahDataPeserta()
    {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }
        
        // ubah data peserta
        $cekPesertaById = $this->model('Laporanku_model')->getPesertaById($_POST['id']);
        $cekUserByUsn = $this->model('Laporanku_model')->getUserByUsn($_POST);
        $cekPesertaByEmail = $this->model('Laporanku_model')->getUserByEmail($_POST);
        
        

        if ($cekUserByUsn) {
            if($cekPesertaById['username'] !== $cekUserByUsn['username']) {
                Flasher::setFlash('Username tersebut sudah digunakan', 'error');
                header("Location: " . BASEURL . '/peserta/datadiri');
                exit;
            }
        }

        if ($cekPesertaByEmail) {
            if($cekPesertaById['email'] !== $cekPesertaByEmail['email']) {
                Flasher::setFlash('Email tersebut sudah digunakan', 'error');
                header("Location: " . BASEURL . '/peserta/datadiri');
                exit;
            }
        } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Invalid email format', 'error');
            header("Location: " . BASEURL . '/peserta/datadiri');
            exit;
        }

        // Upload gambar
        $inputGambar = $_FILES["gambar"]["error"];
        if ($inputGambar === 4) {
            $gambar=$cekPesertaById['image'];
        } else {
            // cek size
            if ($_FILES["gambar"]["size"] > 2000000) {
                Flasher::setFlash('Size dokumentasi terlalu besar. Maksimal size gambar 2 Mb', 'error');
                header("Location: " . BASEURL . '/peserta/datadiri');
                return false;
            }

            // cek ekstensi
            $ekstensiValid = ["jpg","jpeg","png"];
            $explode = explode('.', $_FILES['gambar']['name']);
            $ekstensi = strtolower(end($explode));
            if( !in_array($ekstensi, $ekstensiValid) ) {
                Flasher::setFlash('Masukkan file dengan ekstensi JPG, JPEG dan PNG', 'error');
                header("Location: " . BASEURL . '/peserta/datadiri');
                return false;
            }

            if ($cekPesertaById['image'] !== 'default.jpg') {
                unlink('asset/img/' . $cekPesertaById['image']);
            }

            $gambar = $this->model('Laporanku_model')->upload($_FILES['gambar'], $ekstensi);
        }
        
        if (!$gambar) {
            return false;
        }

        if ($this->model('Laporanku_model')->ubahDataPeserta($_POST, $gambar, $cekPesertaById) > 0) {
            $_SESSION['session']['username'] = $_POST['username'];
            Flasher::setFlash('Data peserta berhasil diubah', 'success');
            header("Location: " . BASEURL . '/peserta/datadiri');
            exit;
        } else {
            header("Location: " . BASEURL . '/peserta/datadiri');
            exit;
        }


    }

    public function changePassword()
    {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        if (isset($_POST['passwordLama'])) {
            $user = $this->model('Laporanku_model')->getUser($_SESSION['session']);

            if (password_verify($_POST['passwordLama'], $user['password'])) {
                
                if(strlen($_POST['passwordBaru']) >= 8) {

                    if ($_POST['passwordBaru'] === $_POST['confirmPassBaru']) {
                        if ($this->model('Laporanku_model')->changePasswordPeserta($_POST, $_SESSION['session']) > 0) {
                            Flasher::setFlash('Password berhasil diubah!', 'success');
                            header("Location: " . BASEURL . '/peserta/changePassword');
                            exit;
                        } else {
                            Flasher::setFlash('Password gagal diubah!', 'error');
                            header("Location: " . BASEURL . '/peserta/changePassword');
                            exit;
                        }
                    } else {
                        Flasher::setFlash('Konfirmasi Password baru tidak sama!', 'error');
                        header("Location: " . BASEURL . '/peserta/changePassword');
                        exit;
                    }
                    
                } else {
                    Flasher::setFlash('Password setidaknya minimal 8 karakter!', 'error');
                    header("Location: " . BASEURL . '/peserta/changePassword');
                    exit;
                }
                
            } else {
                Flasher::setFlash('Password lama anda salah!', 'error');
                header("Location: " . BASEURL . '/peserta/changePassword');
                exit;
            }
        } else {
            $data['title'] = 'Mentor - Laporanku';
            $this->view('templates/header', $data);
            $this->view('peserta/changePassword', $data);
            $this->view('templates/footer');
        }

    }

    public function laporanharian($id=1)
    {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        } 

        $jmlDataPerHalaman = 15;
        $data['jmlLaporanHarianByUsn'] = count($this->model('Laporanku_model')->getTotalLaporanHarianByUsn($_SESSION['session']));
        $data['jmlHalaman'] = ceil($data['jmlLaporanHarianByUsn'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;
        
        $data['laporanharian'] = $this->model('Laporanku_model')->paginationLaporanHarianByUsn($_SESSION['session'], $data['awalData'], $jmlDataPerHalaman);
        
        if(isset($_POST['tombolcariaktivitas'])) {
            if(empty($_POST['cariaktivitas'])) {
                $data['laporanharian'] = $this->model('Laporanku_model')->paginationLaporanHarianByUsn($_SESSION['session'], $data['awalData'], $jmlDataPerHalaman);
            } else {
                $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianByUsn($_SESSION['session'], $data['awalData'], $jmlDataPerHalaman);
            }
        } 

        if(isset($_POST['tombolcaritanggal'])) {
            if(empty($_POST['tanggalaktivitas'])) {
                $data['laporanharian'] = $this->model('Laporanku_model')->paginationLaporanHarianByUsn($_SESSION['session'], $data['awalData'], $jmlDataPerHalaman);
            } else {
                $tanggalArray = explode(" - ", $_POST['tanggalaktivitas']);
                $tanggalAwal = $tanggalArray[0];
                $tanggalAkhir = $tanggalArray[1];
                $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianByTanggal($_SESSION['session'], $data['awalData'], $jmlDataPerHalaman, $tanggalAwal, $tanggalAkhir);
            }
        }    

        $data['title'] = 'Peserta - Laporanku';
        $this->view('templates/header', $data);
        $this->view('peserta/laporanharian', $data);
        $this->view('templates/footer');
    }

    public function laporanakhir()
    {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        $data['laporanakhir'] = $this->model('Laporanku_model')->getLaporanAkhirByUsn($_SESSION['session']);
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($data['peserta']['mentor']);

        $data['title'] = 'Peserta - Laporanku';
        $this->view('templates/header', $data);
        $this->view('peserta/laporanakhir', $data);
        $this->view('templates/footer');
    }

    public function addLaporanHarian()
    {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        // Cek apakah sudah mengupload dokumentasi melalui file atau url
        if ($_FILES['dokumentasi']['error'] === 4 && empty($_POST['url'])) {
            Flasher::setFlash('Upload bukti dokumentasi!', 'error');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            return false;
        } else {
            if(!empty($_POST['url'])) {
                if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                    Flasher::setFlash('Invalid URL format!', 'error');
                    header("Location: " . BASEURL . '/peserta/laporanharian');
                    return false;
                }
            }

            if($_FILES['dokumentasi']['error'] !== 4) {
                $file = $this->model('Laporanku_model')->uploadLaporanHarian($_FILES['dokumentasi'], $data['peserta']);

                if(!$file) {
                    return false;
                }
            } else {
                $file = null;
            }
        }


        
        if ($this->model('Laporanku_model')->addLaporanHarian($_POST, $file, $data['peserta']) > 0) {
            Flasher::setFlash('Laporan harian berhasil ditambah', 'success');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        } else {
            Flasher::setFlash('Gagal menambah laporan', 'error');
            header("Location : " . BASEURL . '/peserta/laporanharian');
            exit;
        }
        
    }

    public function addLaporanAkhir()
    {
         // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        // Cek apakah sudah mengupload dokumentasi melalui file atau url
        if ($_FILES['dokumen']['error'] === 4 && empty($_POST['url'])) {
            Flasher::setFlash('Upload laporan akhir!', 'error');
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            return false;
        } else {
            if(!empty($_POST['url'])) {
                if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                    Flasher::setFlash('Invalid URL format!', 'error');
                    header("Location: " . BASEURL . '/peserta/laporanakhir');
                    return false;
                }
            }

            if($_FILES['dokumen']['error'] !== 4) {
                $file = $this->model('Laporanku_model')->uploadLaporanAkhir($_FILES['dokumen'], $data['peserta']);

                if(!$file) {
                    return false;
                }
            } else {
                $file = null;
            }
        }       
        
        if ($this->model('Laporanku_model')->addLaporanAkhir($_POST, $file, $data['peserta']) > 0) {
            Flasher::setFlash('Laporan akhir berhasil ditambah', 'success');
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            exit;
        } else {
            Flasher::setFlash('Gagal menambah laporan', 'error');
            header("Location : " . BASEURL . '/peserta/laporanakhir');
            exit;
        }
    }

    public function getUbahAktivitas() {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        echo json_encode($this->model('Laporanku_model')->getLaporanHarianById($_POST['id']));
    }

    public function ubahAKtivitas() {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1     ) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        // cek url
        if(!empty($_POST['url'])) {
            if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                Flasher::setFlash('Invalid URL format!', 'error');
                header("Location: " . BASEURL . '/peserta/laporanharian');
                return false;
            }
        }

        // cek file
        $laporanharian = $this->model('Laporanku_model')->getLaporanHarianById($_POST['id']);
        $files = $_FILES['dokumentasi']['error'];
        if ($files === 4) {
            if ($laporanharian['dokumentasi'] === null) {
                $file = null;
            } else {
                $file = $laporanharian['dokumentasi'];
            }
        } else {
            $file = $this->model('Laporanku_model')->uploadLaporanHarian($_FILES['dokumentasi'], $data['peserta']);

            if(!$file) {
                return false;
            }
        }

        if($laporanharian['dokumentasi'] !== $file) {
            unlink('asset/fileLaporanHarian/' . $laporanharian['dokumentasi']);
        }

        if($this->model('Laporanku_model')->ubahLaporanHarian($_POST, $file) > 0) {
            Flasher::setFlash('Aktivitas berhasil diubah', 'success');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        } else {
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        }
    }

    public function getUbahLaporanAkhir() {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        echo json_encode($this->model('Laporanku_model')->getLaporanAKhirById($_POST['id']));
    }

    public function ubahLaporanAkhir() {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        // cek url
        if(!empty($_POST['url'])) {
            if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                Flasher::setFlash('Invalid URL format!', 'error');
                header("Location: " . BASEURL . '/peserta/laporanakhir');
                return false;
            }
        }

        // cek file
        $laporanakhir = $this->model('Laporanku_model')->getLaporanAkhirById($_POST['id']);
        $files = $_FILES['dokumen']['error'];
        if ($files === 4) {
            if ($laporanakhir['dokumen'] === null) {
                $file = null;
            } else {
                $file = $laporanakhir['dokumen'];
            }
        } else {
            $file = $this->model('Laporanku_model')->uploadLaporanAkhir($_FILES['dokumen'], $data['peserta']);

            if(!$file) {
                return false;
            }
        }

        if($laporanakhir['dokumen'] !== $file) {
            unlink('asset/fileLaporanAkhir/' . $laporanakhir['dokumen']);
        }

        if($this->model('Laporanku_model')->ubahLaporanAkhir($_POST, $file) > 0) {
            Flasher::setFlash('Laporan akhir berhasil diubah', 'success');
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            exit;
        } else {
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            exit;
        }
    }

    public function deleteaktivitas($id) {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        $laporanharian = $this->model('Laporanku_model')->getLaporanHarianById($id);
        if($laporanharian['username'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        }

        if($this->model('Laporanku_model')->deleteAktivitas($id, $laporanharian) > 0) {
            Flasher::setFlash('Aktivitas berhasil dihapus', 'success');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        }
    }

    public function detailaktivitas($id) {
        // cek actived
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaByUsn($_SESSION['session']['username']);
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($data['peserta']['mentor']);
        if ($data['peserta']['is_actived'] !== 1) {
            header("Location: ". BASEURL . '/peserta');
            exit;
        }

        $data['laporanharian'] = $this->model('Laporanku_model')->getLaporanHarianById($id);
        if($data['laporanharian']['username'] !== $_SESSION['session']['username']) {
            header("Location: " . BASEURL . '/peserta/laporanharian');
            exit;
        }

        $data['title'] = 'Peserta - Laporanku';
        $this->view('templates/header', $data);
        $this->view('peserta/detailaktivitas', $data);
        $this->view('templates/footer');
    }

}