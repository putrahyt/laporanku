<?php 
date_default_timezone_set('Asia/Jakarta');

class Admin extends Controller
{
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Admin - Laporanku';
        $data['jmlMentor'] = $this->model('Laporanku_model')->jumlahMentor();
        $data['jmlPeserta'] = $this->model('Laporanku_model')->jumlahPeserta();
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    // Mentor
    public function mentor($id=1) 
    {
        $jmlDataPerHalaman = 15;
        $data['jmlMentor'] = count($this->model('Laporanku_model')->getAllMentor());
        $data['jmlHalaman'] = ceil($data['jmlMentor'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;
        
        if(isset($_POST['carimentor'])) {
            $data['mentor'] = $this->model('Laporanku_model')->cariMentor($data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['mentor'] = $this->model('Laporanku_model')->paginationMentor($data['awalData'], $jmlDataPerHalaman);
        }
        $data['title'] = 'Admin - Laporanku';
        $this->view('templates/header', $data);
        $this->view('admin/mentor', $data);
        $this->view('templates/footer');
    }

    public function detailMentor($id) 
    {
        $data['title'] = 'Admin - Laporanku';
        $data['mentor'] = $this->model('Laporanku_model')->getMentorById($id);
        $data['dataPeserta'] = $this->model('Laporanku_model')->getJumlahPesertaByMentor($data['mentor']['username']);
        $this->view('templates/header', $data);
        $this->view('admin/detailMentor', $data);
        $this->view('templates/footer');
    }

    public function datapesertamentor($user, $idMentor, $id=1) 
    {
        $jmlDataPerHalaman = 15;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getTotalAktifPesertaByMentor($user));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(empty($_POST['caripesertabymentor'])) {
            $data['dataPesertaMentor'] = $this->model('Laporanku_model')->paginationDataPesertaMentor($user, $data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['dataPesertaMentor'] = $this->model('Laporanku_model')->getPesertaByMentor($user, $data['awalData'], $jmlDataPerHalaman);
        }

        $data['title'] = 'Admin - Laporanku';
        $data['mentor'] = $this->model('Laporanku_model')->getMentorById($idMentor);
        $this->view('templates/header', $data);
        $this->view('admin/datapesertamentor', $data);
        $this->view('templates/footer');
    }

    public function deletementor($id, $usn) {
        $mentor = $this->model('Laporanku_model')->getMentorById($id);
        if ($this->model('Laporanku_model')->deletementor($id, $usn) > 0) {
            if($mentor['image'] !== 'default.jpg') {
                unlink('asset/img/' . $mentor['image']);
            }
            Flasher::setFlash('Data Mentor Berhasil Dihapus', 'success');
            header("Location: " . BASEURL . '/admin/mentor');
            exit;
        }
    }

    public function addMentor() {
        $usn = $this->model('laporanku_model')->getMentorByUsn($_POST['username']);
        // $cekEmail = $this->model('Laporanku_model')->getMentorByEmail($_POST);
        if ($usn) {
            Flasher::setFlash('Gagal tambah data karena Username tersebut sudah ada', 'error');
            header("Location: " . BASEURL . '/admin/mentor');
            exit;
        } else {
            if ($this->model('Laporanku_model')->addMentor($_POST) > 0) {
                Flasher::setFlash('Data mentor berhasil ditambah', 'success');
                header("Location: " . BASEURL . '/admin/mentor');
                exit;
            } else {
                Flasher::setFlash('Gagal menambahkan data', 'error');
                header("Location: " . BASEURL . '/admin/mentor');
                exit;
            }
        }
    }

    // Peserta
    public function peserta($id=1) 
    {
        $jmlDataPerHalaman = 25;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getAllPeserta());
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;

        if(!empty($_POST['caripeserta'])) {
            $data['peserta'] = $this->model('Laporanku_model')->cariPeserta($data['awalData'], $jmlDataPerHalaman);
        } else {
            $data['peserta'] = $this->model('Laporanku_model')->paginationPeserta($data['awalData'], $jmlDataPerHalaman);
        }
        $data['title'] = 'Admin - Laporanku';
        $this->view('templates/header', $data);
        $this->view('admin/peserta', $data);
        $this->view('templates/footer');
    }

    public function detailPeserta($id) 
    {
        $data['title'] = 'Admin - Laporanku';
        $data['peserta'] = $this->model('Laporanku_model')->getPesertaById($id);
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($data['peserta']['mentor']);
        $this->view('templates/header', $data);
        $this->view('admin/detailPeserta', $data);
        $this->view('templates/footer');
    }

    public function deletepeserta($id, $usn) {
        $peserta = $this->model('Laporanku_model')->getPesertaById($id);
        $laporanharian = $this->model('Laporanku_model')->getLaporanHarianByPeserta($peserta['username']);
        $laporanakhir = $this->model('Laporanku_model')->getLaporanAkhirByUsn($peserta);
        if ($this->model('Laporanku_model')->deletepeserta($id, $usn) > 0) {
            foreach($laporanharian as $harian) {
                $this->model('Laporanku_model')->deletelaporanharian($peserta['username']);
                unlink('asset/fileLaporanHarian/' . $harian['dokumentasi']);
            }

            foreach($laporanakhir as $akhir) {
                $this->model('Laporanku_model')->deletelaporanakhir($peserta['username']);
                unlink('asset/fileLaporanAkhir/' . $akhir['dokumen']);
            }

            if($peserta['image'] !== 'default.jpg') {
                unlink('asset/img/' . $peserta['image']);
            }

            Flasher::setFlash('Data Peserta Berhasil Dihapus', 'success');
            header("Location: " . BASEURL . '/admin/peserta');
            exit;
        }
    }

    public function laporan($id=1)
    {
        $jmlDataPerHalaman = 15;
        $data['jmlPeserta'] = count($this->model('Laporanku_model')->getAllLaporanAkhir());
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $jmlDataPerHalaman);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($jmlDataPerHalaman * $data['hlmAktif']) - $jmlDataPerHalaman;   

        $data['laporan'] = $this->model('Laporanku_model')->paginationLaporan($data['awalData'], $jmlDataPerHalaman);

        if(isset($_POST['tombolcarijudul'])) {
            if(empty($_POST['carijudul'])) {
                $data['laporan'] = $this->model('Laporanku_model')->paginationLaporan($data['awalData'], $jmlDataPerHalaman);
            } else {
                $data['laporan'] = $this->model('Laporanku_model')->getLaporan($data['awalData'], $jmlDataPerHalaman);
            }
        } 

        if(isset($_POST['tombolcaritanggal'])) {
            if(empty($_POST['tanggalaktivitas'])) {
                $data['laporan'] = $this->model('Laporanku_model')->paginationLaporan($data['awalData'], $jmlDataPerHalaman);
            } else {
                $tanggalArray = explode(" - ", $_POST['tanggalaktivitas']);
                $tanggalAwal = $tanggalArray[0];
                $tanggalAkhir = $tanggalArray[1];
                $data['laporan'] = $this->model('Laporanku_model')->getLaporanAkhirByTanggal($data['awalData'], $jmlDataPerHalaman, $tanggalAwal, $tanggalAkhir);
            }
        }    

        $data['title'] = 'Admin - Laporanku';
        $this->view('templates/header', $data);
        $this->view('admin/laporan', $data);
        $this->view('templates/footer');
    }

    public function detaillaporan($id)
    {
        $data['laporanakhir'] = $this->model('Laporanku_model')->getLaporanAkhirByStatus($id);
        $data['mentor'] = $this->model('Laporanku_model')->getMentorByUsn($data['laporanakhir']['mentor']);

        if(!$data['laporanakhir']) {
            header("Location: " . BASEURL . '/admin/laporan');
            exit;
        }

        $data['title'] = 'Admin - Laporanku';
        $this->view('templates/header', $data);
        $this->view('admin/detaillaporan', $data);
        $this->view('templates/footer');
    }

    public function changePassword() 
    {
        if (isset($_POST['passwordLama'])) {
            $passwordLama = $this->model('Laporanku_model')->getUser($_SESSION['session']);
            
            if (password_verify($_POST['passwordLama'], $passwordLama['password'])) {

                if(strlen($_POST['passwordBaru']) >= 8) {

                    if ($_POST['passwordBaru'] === $_POST['confirmPassBaru']) {
                        
                        if ($this->model('Laporanku_model')->changePasswordAdmin($_POST, $_SESSION['session']) > 0) {
                            Flasher::setFlash('Password berhasil diubah!', 'success');
                            header("Location: " . BASEURL . '/admin/changePassword');
                            exit;
                        } else {
                            Flasher::setFlash('Password gagal diubah!', 'error');
                            header("Location: " . BASEURL . '/admin/changePassword');
                            exit;
                        }
                    
                    } else {
                        Flasher::setFlash('Konfirmasi password baru tidak sama!', 'error');
                        header("Location: " . BASEURL . '/admin/changePassword');
                        exit;
                    }

                } else {
                    Flasher::setFlash('Password setidaknya minimal 8 karakter!', 'error');
                    header("Location: " . BASEURL . '/admin/changePassword');
                    exit;
                }
            
            } else {
                Flasher::setFlash('Password lama anda salah!', 'error');
                header("Location: " . BASEURL . '/admin/changePassword');
                exit;
            }
        
        } else {
            $data['title'] = 'Admin - Laporanku';
            $this->view('templates/header', $data);
            $this->view('admin/changePassword', $data);
            $this->view('templates/footer');
        }
    }
}