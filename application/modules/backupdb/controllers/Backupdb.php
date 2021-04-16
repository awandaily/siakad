<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backupdb extends CI_Controller
{



  function __construct()
  {
    parent::__construct();
    //	$this->m_konfig->validasi_session();
    $this->load->model("model", "mdl");
    date_default_timezone_set('Asia/Jakarta');
  }

  function _template($data)
  {
    $this->load->view('template/main', $data);
  }

  public function index()
  {

    $ajax = $this->input->get_post("ajax");
    if ($ajax == "yes") {
      echo  $this->load->view("index");
    } else {
      $data['konten'] = "index";
      $data['tabel'] = $this->mdl->tampiltabel(); //AMBIL DATA TABEL-TABEL
      $this->_template($data);
    }
  }


  public function menubackuprestore()
  {
    $this->load->model('nama_model');
    $data['tabel'] = $this->nama_model->tampiltabel(); //AMBIL DATA TABEL-TABEL
    $this->load->view('nama_view', $data);
  }

  public function backup()
  {

    $tabel = $this->input->post('tabel');
    $this->load->dbutil();
    $prefs = array(
      'tables'      => array($tabel),
      'format'      => 'zip',
      'filename'    => 'my_db_backup.sql'
    );
    $backup = &$this->dbutil->backup($prefs);
    $db_name = 'backup-on-' . $tabel . '-' . date("d-m-Y") . '.zip'; //NAMAFILENYA
    $save = 'pathtobkfolder/' . $db_name;
    $this->load->helper('file');
    write_file($save, $backup);
    $this->load->helper('download');
    force_download($db_name, $backup);
  }
  public function restore()
  {

    $this->load->helper('file');
    $this->load->model('sismas_m');
    $config['upload_path'] = "./assets/database/";
    $config['allowed_types'] = "jpg|png|gif|jpeg|bmp|sql|x-sql";
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload("datafile")) {
      $error = array('error' => $this->upload->display_errors());
      echo "GAGAL UPLOAD";
      var_dump($error);
      exit();
    }

    $file = $this->upload->data();  //DIUPLOAD DULU KE DIREKTORI assets/database/
    $fotoupload = $file['file_name'];

    $isi_file = file_get_contents('./assets/database/' . $fotoupload); //PANGGIL FILE YANG TERUPLOAD
    $string_query = rtrim($isi_file, "\n;");
    $array_query = explode(";", $string_query);   //JALANKAN QUERY MERESTORE KEDATABASE
    foreach ($array_query as $query) {
      $this->db->query($query);
    }

    $path_to_file = './assets/database/' . $fotoupload;
    if (unlink($path_to_file)) {   // HAPUS FILE YANG TERUPLOAD
      redirect('home/setting');
    } else {
      echo 'errors occured';
    }
  }
}
