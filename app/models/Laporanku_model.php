<?php

class Laporanku_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Registrasi
    public function addPeserta($data)
    {
        $image = "default.jpg";
        $time = time();
        $npm = 0;
        $noHP = 0;
        $is_actived = 0;
        $role = "peserta";
        $reset_token_hash = null;
        $reset_token_expires_at = null;

        $query = "INSERT INTO login VALUES (NULL, :username, :password, :email, :reset_token_hash, :reset_token_expires_at, :role, :date_created)";
        $this->db->query($query);
        $this->db->bind('username', strtolower($data['username']));
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('email', strtolower($data['email']));
        $this->db->bind('reset_token_hash', $reset_token_hash);
        $this->db->bind('reset_token_expires_at', $reset_token_expires_at);
        $this->db->bind('role', $role);
        $this->db->bind('date_created', $time);
        $this->db->execute();

        $query = "INSERT INTO peserta VALUES (NULL, :fullname, :username, :password, :instansi, :jurusan, :email, :mentor, :divisi, :npm, :noHP, :image, :is_actived, :date_created, :role)";
        $this->db->query($query);
        $this->db->bind('fullname', $data['fullname']);
        $this->db->bind('username', strtolower($data['username']));
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('instansi', $data['instansi']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('email', strtolower($data['email']));
        $this->db->bind('mentor', $data['mentor']);
        $this->db->bind('divisi', $data['divisi']);
        $this->db->bind('npm', $npm);
        $this->db->bind('noHP', $noHP);
        $this->db->bind('image', $image);
        $this->db->bind('is_actived', $is_actived);
        $this->db->bind('date_created', $time);
        $this->db->bind('role', $role);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Mentor
    public function addMentor($data) {
        $password = '12345678';
        $image = "default.jpg";
        $time = time();
        $role = "mentor";
        $reset_token_hash = null;
        $reset_token_expires_at = null;

        $query = "INSERT INTO login VALUES (NULL, :username, :password, :email, :reset_token_hash, :reset_token_expires_at, :role, :date_created)";
        $this->db->query($query);
        $this->db->bind('username', strtolower($data['username']));
        $this->db->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind('email', null);
        $this->db->bind('reset_token_hash', $reset_token_hash);
        $this->db->bind('reset_token_expires_at', $reset_token_expires_at);
        $this->db->bind('role', $role);
        $this->db->bind('date_created', $time);
        $this->db->execute();

        $query = "INSERT INTO mentor VALUES (NULL, :full_name, :username, :password, :email, :jabatan, :divisi, :noHP, :image, :date_created, :role)";
        $this->db->query($query);
        $this->db->bind('full_name', $data['fullname']);
        $this->db->bind('username', strtolower($data['username']));
        $this->db->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind('email', null);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('divisi', null);
        $this->db->bind('noHP', null);
        $this->db->bind('image', $image);
        $this->db->bind('date_created', $time);
        $this->db->bind('role', $role);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function paginationMentor($awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT * FROM mentor ORDER BY full_name ASC LIMIT $awalData, $jmlDataPerHlm");
        return $this->db->resultSet();
    }

    public function getAllMentor() {
        $this->db->query("SELECT * FROM mentor ORDER BY full_name ASC");
        return $this->db->resultSet();
    }

    public function getMentorById($id) {
        $this->db->query("SELECT * FROM mentor Where id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getMentorByUsn($data) {
        $this->db->query("SELECT * FROM mentor Where username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getMentorByEmail($data) {
        $this->db->query("SELECT * FROM mentor Where email=:email");
        $this->db->bind('email', $data['email']);
        return $this->db->single();
    }

    public function jumlahMentor() {
        $this->db->query("SELECT COUNT(*) FROM mentor");
        return $this->db->resultSet();
    }

    public function getPesertaDisetujui($data) {
        $this->db->query("SELECT COUNT(*) FROM peserta Where is_actived=1 AND mentor=:mentor ORDER BY fullname ASC");
        $this->db->bind('mentor', $data);
        return $this->db->resultSet();    
    }

    public function getPesertaBelumDisetujui($data) {
        $this->db->query("SELECT COUNT(*) FROM peserta Where is_actived=0 AND mentor=:mentor ORDER BY fullname ASC");
        $this->db->bind('mentor', $data);
        return $this->db->resultSet();
    }

    public function getJumlahPesertaByMentor($data) {
        $this->db->query("SELECT COUNT(*) FROM peserta Where mentor=:mentor AND is_actived=1");
        $this->db->bind('mentor', $data);
        return $this->db->resultSet();
    }

    public function getTotalAktifPesertaByMentor($user) {
        $this->db->query("SELECT * FROM peserta Where mentor=:mentor AND is_actived=1");

        $this->db->bind('mentor', $user);
        return $this->db->resultSet();
    }

    public function getTotalNonAktifPesertaByMentor($user) {
        $this->db->query("SELECT * FROM peserta Where mentor=:mentor AND is_actived=0");

        $this->db->bind('mentor', $user);
        return $this->db->resultSet();
    }

    public function getPesertaByMentor($user, $awalData, $jmlDataPerHlm) {
        $keyowrd = $_POST['caripesertabymentor'];
        $this->db->query("SELECT * FROM peserta Where fullname LIKE :keyword OR username LIKE :keyword OR instansi LIKE :keyword OR jurusan LIKE :keyword AND mentor=:mentor AND is_actived=1 ORDER BY date_created DESC LIMIT $awalData, $jmlDataPerHlm");
        
        $this->db->bind('keyword', '%'.$keyowrd.'%');
        $this->db->bind('mentor', $user);
        return $this->db->resultSet();
    }

    public function paginationDataPesertaMentor($user, $awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT * FROM peserta Where mentor=:mentor AND is_actived=1 ORDER BY date_created DESC LIMIT $awalData, $jmlDataPerHlm");
        
        $this->db->bind('mentor', $user);
        return $this->db->resultSet();
    }

    public function paginationDataNonPesertaMentor($user, $awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT * FROM peserta WHERE mentor=:mentor AND is_actived = 0 ORDER BY date_created DESC LIMIT $awalData, $jmlDataPerHlm");
        
        $this->db->bind('mentor', $user);
        return $this->db->resultSet();
    }

    public function ubahDataMentor($data, $gambar, $mentor) {
        $this->db->query("UPDATE login SET username=:username, email=:email Where username=:usernamementor");
        $this->db->bind('username', $data['username']);
        $this->db->bind('usernamementor', $mentor['username']);
        $this->db->bind('email', strtolower($data['email']));
        $this->db->execute();
        $return1 = $this->db->rowCount();

        $this->db->query("UPDATE mentor SET full_name=:full_name, username=:username, divisi=:divisi, email=:email, jabatan=:jabatan, noHP=:noHP, image=:image Where id=:id");
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', strtolower($data['email']));
        $this->db->bind('full_name', $data['fullname']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('divisi', $data['divisi']);
        $this->db->bind('noHP', $data['noHP']);
        $this->db->bind('image', $gambar);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        $return2 = $this->db->rowCount();

        $this->db->query("UPDATE peserta SET mentor=:mentor Where mentor=:username");
        $this->db->bind('mentor', $data['username']);
        $this->db->bind('username', $mentor['username']);
        $this->db->execute();
        $return3 = $this->db->rowCount();
        
        return $return1+$return2+$return3;
        
    }

    public function deletementor($id, $usn) {
        $this->db->query("DELETE FROM mentor Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        
        $this->db->query("DELETE FROM login Where username=:username");
        $this->db->bind('username', $usn);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariMentor($awalData, $jmlDataPerHlm) {
        $keyowrd = $_POST['carimentor'];
        $query = "SELECT * FROM mentor Where full_name LIKE :keyword OR username LIKE :keyword OR jabatan LIKE :keyword ORDER BY full_name ASC LIMIT $awalData, $jmlDataPerHlm";

        $this->db->query($query);
        $this->db->bind('keyword', '%'.$keyowrd.'%');
        return $this->db->resultSet();
    }

    // Peserta
    public function getPeserta($mentor, $awalData, $jmlDataPerHlm) {
        $keyowrd = $_POST['caripeserta'];
        $this->db->query("SELECT * FROM peserta Where fullname LIKE :keyword OR instansi LIKE :keyword OR jurusan LIKE :keyword AND mentor=:mentor ORDER BY date_created DESC LIMIT $awalData, $jmlDataPerHlm");
        
        $this->db->bind('keyword', '%'.$keyowrd.'%');
        $this->db->bind('mentor', $mentor);
        return $this->db->resultSet();
    }

    public function getPesertaById($id) {
        $this->db->query("SELECT peserta.id, peserta.fullname, peserta.username, peserta.divisi, peserta.instansi, peserta.jurusan, peserta.email, peserta.npm, peserta.noHP, peserta.date_created, peserta.image, peserta.mentor, peserta.is_actived, mentor.full_name FROM peserta INNER JOIN mentor ON peserta.mentor=mentor.username Where peserta.id=:id");
        
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPesertaDisetujuiById($id) {
        $this->db->query("SELECT peserta.id, peserta.fullname, peserta.username, peserta.divisi, peserta.instansi, peserta.jurusan, peserta.email, peserta.npm, peserta.noHP, peserta.date_created, peserta.image, peserta.mentor, peserta.is_actived, mentor.full_name FROM peserta INNER JOIN mentor ON peserta.mentor=mentor.username Where peserta.id=:id AND peserta.is_actived=1");
        
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPesertaNonDisetujuiById($id) {
        $this->db->query("SELECT peserta.id, peserta.fullname, peserta.username, peserta.divisi, peserta.instansi, peserta.jurusan, peserta.email, peserta.npm, peserta.noHP, peserta.date_created, peserta.image, peserta.mentor, peserta.is_actived, mentor.full_name FROM peserta INNER JOIN mentor ON peserta.mentor=mentor.username Where peserta.id=:id AND peserta.is_actived=0");
        
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPesertaByUsn($data) {
        $this->db->query("SELECT * FROM peserta Where username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getPesertaByEmail($data) {
        $this->db->query("SELECT * FROM peserta Where email=:email");
        $this->db->bind('email', $data['email']);
        return $this->db->single();
    }

    public function getAllPeserta() {
        $this->db->query("SELECT * FROM peserta ORDER BY fullname ASC");
        return $this->db->resultSet();
    }

    public function jumlahPeserta() {
        $this->db->query("SELECT COUNT(*) FROM peserta");
        return $this->db->resultSet();
    }

    public function paginationPeserta($awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT peserta.id, peserta.fullname, peserta.username, peserta.instansi, peserta.jurusan, peserta.image, peserta.is_actived, mentor.full_name FROM peserta INNER JOIN mentor ON peserta.mentor=mentor.username ORDER BY peserta.date_created DESC LIMIT $awalData, $jmlDataPerHlm");
        return $this->db->resultSet();
    }

    public function deletepeserta($id, $usn) {
        $this->db->query("DELETE FROM peserta Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();

        $this->db->query("DELETE FROM login Where username=:username");
        $this->db->bind('username', $usn);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function accpeserta($id) {
        $this->db->query("UPDATE peserta SET is_actived=1 Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function acclaporanpeserta($id) {
        $this->db->query("UPDATE laporanharian SET status=1 Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function accsemualaporanharian($user) {
        $this->db->query("UPDATE laporanharian SET status=1 Where username=:username");
        $this->db->bind('username', $user);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function acclaporanakhirpeserta($id) {
        $this->db->query("UPDATE laporanakhir SET status=1 Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tolaklaporanpeserta($data) {
        $this->db->query("UPDATE laporanharian SET status=2, catatan_mentor=:catatan_mentor Where id=:id");
        $this->db->bind('catatan_mentor', $data['catatan']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tolaklaporanakhir($data) {
        $this->db->query("UPDATE laporanakhir SET status=2, catatan_mentor=:catatan_mentor Where id=:id");
        $this->db->bind('catatan_mentor', $data['catatan']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariPeserta($awalData, $jmlDataPerHlm) {
        $keyword = $_POST['caripeserta'];
        $query = "SELECT peserta.id, peserta.fullname, peserta.username, peserta.instansi, peserta.jurusan, peserta.image, peserta.is_actived, mentor.full_name FROM peserta INNER JOIN mentor ON peserta.mentor=mentor.username Where peserta.fullname LIKE :keyword OR peserta.username LIKE :keyword OR peserta.instansi LIKE :keyword OR peserta.jurusan LIKE :keyword OR mentor.full_name LIKE :keyword ORDER BY peserta.date_created DESC LIMIT $awalData, $jmlDataPerHlm";

        $this->db->query($query);
        $this->db->bind('keyword', '%'.$keyword.'%');
        return $this->db->resultSet();
    }

    public function ubahDataPeserta($data, $gambar, $user) {
        $this->db->query("UPDATE login SET username=:username, email=:email Where username=:usernamepeserta");
        $this->db->bind('username', $data['username']);
        $this->db->bind('usernamepeserta', $user['username']);
        $this->db->bind('email', strtolower($data['email']));
        $this->db->execute();
        $return1 = $this->db->rowCount();

        $this->db->query("UPDATE peserta SET fullname=:fullname, username=:username, divisi=:divisi, instansi=:instansi, jurusan=:jurusan, email=:email, npm=:npm, noHP=:noHP, image=:image Where id=:id");
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', strtolower($data['email']));
        $this->db->bind('fullname', $data['fullname']);
        $this->db->bind('divisi', $data['divisi']);
        $this->db->bind('instansi', $data['instansi']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('noHP', $data['noHP']);
        $this->db->bind('image', $gambar);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        $return2 = $this->db->rowCount();
        
        return $return1+$return2;
        
    }

    // Upload Mentor & Peserta
    public function upload($data, $ekstensi) {
        $tmpNama = $data["tmp_name"];

        $gambar = uniqid() . '.' . $ekstensi;
        move_uploaded_file($tmpNama, 'asset/img/' . $gambar);
        return $gambar;
    }

    // Laporan

    // Laporan - Upload Laporan Harian
    public function uploadLaporanHarian($data, $peserta) {
        $nama = $data["name"];
        $tmpNama = $data["tmp_name"];
        $size = $data["size"];

        $ekstensiValid = ["pdf","docx","doc","xlsx","xls","jpeg","png"];
        $explode = explode('.', $nama);
        $ekstensi = strtolower(end($explode));
        if( !in_array($ekstensi, $ekstensiValid) ) {
            Flasher::setFlash('Masukkan file dengan ekstensi PDF, Word, Excel atau JPEG', 'error');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            return false;
        }

        if( $size > 2000000 ) {
            Flasher::setFlash('Size terlalu besar. Maksimal size 2 Mb', 'error');
            header("Location: " . BASEURL . '/peserta/laporanharian');
            return false;
        }


        $file = $peserta['fullname'] . '_' . uniqid() . '.' . $ekstensi;
        move_uploaded_file($tmpNama, 'asset/fileLaporanHarian/' . $file);
        return $file;
    }

    // Laporan - Upload Laporan Akhir
    public function uploadLaporanAkhir($data, $peserta) {
        $nama = $data["name"];
        $tmpNama = $data["tmp_name"];
        $size = $data["size"];

        if( $size > 20000000 ) {
            Flasher::setFlash('Size terlalu besar. Maksimal size 20 Mb', 'error');
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            return false;
        }

        $ekstensiValid = ["pdf"];
        $explode = explode('.', $nama);
        $ekstensi = strtolower(end($explode));
        if( !in_array($ekstensi, $ekstensiValid) ) {
            Flasher::setFlash('Masukkan file dengan ekstensi PDF', 'error');
            header("Location: " . BASEURL . '/peserta/laporanakhir');
            return false;
        }
        
        $file = $peserta['fullname'] . '_' . uniqid() . '.' . $ekstensi;
        move_uploaded_file($tmpNama, 'asset/fileLaporanAkhir/' . $file);
        return $file;
    }

    public function addLaporanHarian($data, $file, $peserta) {
        $status = 0;
        $date = time();

        if(!empty($data['url'])) {
            $url = $data['url'];
        } else {
            $url = null;
        }
 
        $this->db->query("INSERT INTO laporanharian VALUES(NULL, :username, :fullname, :status, :tanggal, :aktivitas, :catatan, :dokumentasi, :url, :catatan_mentor, :mentor)");
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->bind('fullname', $peserta['fullname']);
        $this->db->bind('status', $status);
        $this->db->bind('tanggal', $date);
        $this->db->bind('aktivitas', $data['aktivitas']);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('dokumentasi', $file);
        $this->db->bind('url', $url);
        $this->db->bind('catatan_mentor', null);
        $this->db->bind('mentor', $peserta['mentor']);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function addLaporanAkhir($data, $file, $peserta) {
        $status = 0;
        $date = time();

        if(!empty($data['url'])) {
            $url = $data['url'];
        } else {
            $url = null;
        }

        $this->db->query("INSERT INTO laporanakhir VALUES(NULL, :tanggal, :gambar, :username, :fullname, :status, :aktivitas, :dokumen, :url, :catatan_mentor, :mentor)");
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->bind('gambar', $peserta['image']);
        $this->db->bind('fullname', $peserta['fullname']);
        $this->db->bind('tanggal', $date);
        $this->db->bind('status', $status);
        $this->db->bind('aktivitas', $data['aktivitas']);
        $this->db->bind('dokumen', $file);
        $this->db->bind('url', $url);
        $this->db->bind('catatan_mentor', null);
        $this->db->bind('mentor', $peserta['mentor']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllLaporanHarian() {
        $this->db->query("SELECT * FROM laporanharian ORDER BY tanggal ASC");
        return $this->db->resultSet();
    }

    public function getAllLaporanAKhir() {
        $this->db->query("SELECT * FROM laporanakhir ORDER BY tanggal DESC");
        return $this->db->resultSet();
    }

    public function getLaporanHarianByPeserta($peserta) {
        $this->db->query("SELECT * FROM laporanharian Where username=:username ORDER BY tanggal DESC");
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function getLaporanAkhir($peserta) {
        $this->db->query("SELECT * FROM laporanakhir Where username=:username ORDER BY tanggal DESC");
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function getLaporanHarianByKeyword($awalData, $jmlDataPerHlm, $mentor, $peserta) {
        $keyword = $_POST['cariaktivitas'];
        $this->db->query("SELECT * FROM laporanharian Where mentor=:mentor AND username=:username AND aktivitas LIKE :keyword ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('keyword', '%'.$keyword.'%');
        $this->db->bind('username', $peserta);
        $this->db->bind('mentor', $mentor['username']);
        return $this->db->resultSet();
    }

    public function getLaporanAkhirByKeyword($awalData, $jmlDataPerHlm, $mentor, $peserta) {
        $keyword = $_POST['carilaporan'];
        $this->db->query("SELECT * FROM laporanakhir Where mentor=:mentor AND username=:username AND aktivitas LIKE :keyword ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('keyword', '%'.$keyword.'%');
        $this->db->bind('username', $peserta);
        $this->db->bind('mentor', $mentor['username']);
        return $this->db->resultSet();
    }

    public function getLaporanAkhirByUsn($data) {
        $this->db->query("SELECT * FROM laporanakhir Where username=:username ORDER BY tanggal DESC");
        $this->db->bind('username', $data['username']);
        return $this->db->resultSet();
    }

    public function getLaporanAkhirById($data) {
        $this->db->query("SELECT * FROM laporanakhir Where id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getLaporanAkhirByStatus($data) {
        $this->db->query("SELECT laporanakhir.fullname, laporanakhir.aktivitas, laporanakhir.tanggal, laporanakhir.mentor, peserta.instansi, peserta.jurusan FROM laporanakhir INNER JOIN peserta ON laporanakhir.username=peserta.username Where laporanakhir.id=:id AND status=1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function paginationLaporan($awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT * FROM laporanakhir Where status=1 ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        return $this->db->resultSet();
    }

    public function getLaporan($awalData, $jmlDataPerHlm) {
        $keyowrd = $_POST['carijudul'];

        $this->db->query("SELECT * FROM laporanakhir Where fullname LIKE :keyword OR aktivitas LIKE :keyword AND status=1 ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('keyword', '%'.$keyowrd.'%');
        return $this->db->resultSet();
    }

    public function getLaporanAkhirByTanggal($awalData, $jmlDataPerHlm, $awal, $akhir) {
        $tglAwal = strtotime($awal, time());
        $tglAkhir = strtotime($akhir, time());
        $this->db->query("SELECT * FROM laporanakhir Where status=1 AND tanggal BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        return $this->db->resultSet();
    }

    public function paginationLaporanHarian($awalData, $jmlDataPerHlm, $mentor, $peserta) {
        $this->db->query("SELECT * FROM laporanharian Where mentor=:mentor AND username=:username ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('mentor', $mentor['username']);
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function paginationLaporanAkhir($awalData, $jmlDataPerHlm, $mentor, $peserta) {
        $this->db->query("SELECT * FROM laporanakhir Where mentor=:mentor AND username=:username ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('mentor', $mentor['username']);
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function paginationLaporanHarianByUsn($user, $awalData, $jmlDataPerHlm) {
        $this->db->query("SELECT * FROM laporanharian Where username=:username ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('username', $user['username']);
        return $this->db->resultSet();
    }

    public function getLaporanHarianByUsn($data, $awalData, $jmlDataPerHlm) {
        $keyowrd = $_POST['cariaktivitas'];
        $this->db->query("SELECT * FROM laporanharian Where username=:username AND aktivitas LIKE :keyword ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('username', $data['username']);
        $this->db->bind('keyword', '%'.$keyowrd.'%');
        return $this->db->resultSet();
    }

    public function getLaporanHarianBytanggal($data, $awalData, $jmlDataPerHlm, $awal, $akhir) {
        $tglAwal = strtotime($awal, time());
        $tglAkhir = strtotime($akhir, time());
        $this->db->query("SELECT * FROM laporanharian Where username=:username AND tanggal BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('username', $data['username']);
        return $this->db->resultSet();
    }

    public function getAktivitasByTanggal($awalData, $jmlDataPerHlm, $awal, $akhir, $mentor, $peserta) {
        $tglAwal = strtotime($awal, time());
        $tglAkhir = strtotime($akhir, time());
        $this->db->query("SELECT * FROM laporanharian Where mentor=:mentor AND username=:username AND tanggal BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('mentor', $mentor['username']);
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function getLaporanByTanggal($awalData, $jmlDataPerHlm, $awal, $akhir, $mentor, $peserta) {
        $tglAwal = strtotime($awal, time());
        $tglAkhir = strtotime($akhir, time());
        $this->db->query("SELECT * FROM laporanakhir Where mentor=:mentor AND username=:username AND tanggal BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY tanggal DESC LIMIT $awalData, $jmlDataPerHlm");
        $this->db->bind('mentor', $mentor['username']);
        $this->db->bind('username', $peserta);
        return $this->db->resultSet();
    }

    public function getTotalLaporanHarianByUsn($data) {
        $this->db->query("SELECT * FROM laporanharian Where username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->resultSet();
    }

    public function getTotalLaporanAKhirByUsn($data) {
        $this->db->query("SELECT * FROM laporanakhir Where username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->resultSet();
    }

    public function getLaporanHarianById($id) {
        $this->db->query("SELECT * FROM laporanharian Where id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function ubahLaporanHarian($data, $file) {
        if(!empty($data['url'])) {
            $url = $data['url'];
        } else {
            $url = null;
        }

        $this->db->query("UPDATE laporanharian SET aktivitas=:aktivitas, catatan=:catatan, dokumentasi=:dokumentasi, url=:url Where id=:id");
        $this->db->bind('aktivitas', $data['aktivitas']);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('dokumentasi', $file);
        $this->db->bind('url', $url);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahLaporanAKhir($data, $file) {
        if(!empty($data['url'])) {
            $url = $data['url'];
        } else {
            $url = null;
        }

        $this->db->query("UPDATE laporanakhir SET status=0, aktivitas=:aktivitas, dokumen=:dokumen, url=:url Where id=:id");
        $this->db->bind('aktivitas', $data['aktivitas']);
        $this->db->bind('dokumen', $file);
        $this->db->bind('url', $url);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAktivitas($id, $laporanharian) {
        unlink('asset/fileLaporanHarian/' . $laporanharian['dokumentasi']);
        $this->db->query("DELETE FROM laporanharian Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletelaporan($id, $laporanakhir) {
        unlink('asset/fileLaporanAkhir/' . $laporanakhir['dokumen']);
        $this->db->query("DELETE FROM laporanakhir Where id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletelaporanakhir($data) {
        $this->db->query("DELETE FROM laporanakhir Where username=:username");
        $this->db->bind('username', $data);
        $this->db->execute();
    }

    public function deletelaporanharian($data) {
        $this->db->query("DELETE FROM laporanharian Where username=:username");
        $this->db->bind('username', $data);
        $this->db->execute();
    }

    public function deleteaktivitasbytanggal($tanggal) {
        $this->db->query("DELETE FROM laporanharian Where tanggal=:tanggal");
        $this->db->bind('tanggal', $tanggal);
        $this->db->execute();
    }

    public function getAktivitasPesertaByTanggal($tanggal) {
        $this->db->query("SELECT * FROM laporanharian Where tanggal=:tanggal");
        $this->db->bind('tanggal', $tanggal);
        return $this->db->single();
    }

    // User Login
    public function getUserByUsn($data) {
        $this->db->query("SELECT * FROM login Where username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function getUser($data) {
        $this->db->query("SELECT * FROM login Where username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function getUserByEmail($data) {
        $this->db->query("SELECT * FROM login Where email=:email");
        $this->db->bind('email', $data['email']);
        return $this->db->single();
    }

    public function updateUser($email, $token_hash, $expiry) {
        $query = "UPDATE login SET reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at Where email=:email";

        $this->db->query($query);
        $this->db->bind('reset_token_hash', $token_hash);
        $this->db->bind('reset_token_expires_at', $expiry);
        $this->db->bind('email', $email);
        
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getUserByToken($token) {
        $query = "SELECT * FROM login Where reset_token_hash=:reset_token_hash";

        $this->db->query($query);
        $this->db->bind('reset_token_hash', $token);
        return $this->db->single();
    }


    // Menu ubah password di halaman login
    public function changePassword($data, $cekToken) {
        $user = $cekToken['username'];
        $role = $cekToken['role'];
        $reset_token_hash = null;
        $reset_token_expires_at = null;

        $query = "UPDATE login, $role SET login.password = :password, login.reset_token_hash = :reset_token_hash, login.reset_token_expires_at = :reset_token_expires_at, $role.password = :password WHERE login.username = :username AND $role.username = :username";

        $this->db->query($query);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('reset_token_hash', $reset_token_hash);
        $this->db->bind('reset_token_expires_at', $reset_token_expires_at);
        $this->db->bind('username', $user);
        $this->db->execute();

        return $this->db->rowCount();

    }

    // Menu ubah password di halaman admin
    public function changePasswordAdmin($pass, $user) {
        $pass = $pass['passwordBaru'];
        $user = $user['username'];

        $query = "UPDATE login SET password=:password Where username=:username";

        $this->db->query($query);
        $this->db->bind('password', password_hash($pass, PASSWORD_DEFAULT));
        $this->db->bind('username', $user);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Menu ubah password di halaman mentor
    public function changePasswordMentor($pass, $user) {
        $pass = $pass['passwordBaru'];
        $user = $user['username'];

        $query = "UPDATE login, mentor SET login.password=:password, mentor.password=:password Where login.username=:username AND mentor.username=:username";

        $this->db->query($query);
        $this->db->bind('password', password_hash($pass, PASSWORD_DEFAULT));
        $this->db->bind('username', $user);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Menu ubah password di halaman peserta
    public function changePasswordPeserta($pass, $user) {
        $pass = $pass['passwordBaru'];
        $user = $user['username'];

        $query = "UPDATE login, peserta SET login.password=:password, peserta.password=:password Where login.username=:username AND peserta.username=:username";

        $this->db->query($query);
        $this->db->bind('password', password_hash($pass, PASSWORD_DEFAULT));
        $this->db->bind('username', $user);
        $this->db->execute();

        return $this->db->rowCount();
    }
}