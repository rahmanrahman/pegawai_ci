<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HRD extends CI_Controller {
	
	function __construct(){ 
		parent::__construct(); 
		if($this->session->userdata('status') != "login_hrd"){
			redirect('Login/log_cek');
		}
	}

	public function index(){
		$data['total_pegawai'] = $this->M_pegawai->total_pegawai();
		$data['total_kota'] = $this->M_pegawai->total_kota();
		$data['total_posisi'] = $this->M_pegawai->total_posisi();
		$data['total_posisi_pegawai'] = $this->M_pegawai->total_posisi_pegawai();
		$data['total_kota_pegawai'] = $this->M_pegawai->total_kota_pegawai();
		// var_dump($data['total_posisi_pegawai']);
		$this->load->view('hrd/dashboard', $data);
		$this->load->view('hrd/templates/footerD', $data);

	}

	public function Pegawai(){
		//method yang nanti akan digunakan di model 
		//untuk menampilkan data yang ada pada database
		$data['posisi'] = $this->M_pegawai->tampil_posisi();
		$data['kota'] = $this->M_pegawai->tampil_kota();
		$data['pegawai'] = $this->M_pegawai->tampil_pegawai();
		$data['total_pegawai'] = $this->M_pegawai->total_pegawai();
		$this->load->view('hrd/pegawai',$data);
	}

	public function Absen(){
		//method yang nanti akan digunakan di model 
		$data['absen'] = $this->M_pegawai->tampil_laporan_absen();
		$this->load->view('hrd/absen',$data);
	}

	public function Posisi(){
		//method yang nanti akan digunakan di model 
		$data['total_posisi'] = $this->M_pegawai->total_posisi();
		$data['posisi'] = $this->M_pegawai->tampil_posisi();
		$this->load->view('hrd/posisi',$data);
	}

	public function Kota(){
		//method yang nanti akan digunakan di model 
		$data['total_kota'] = $this->M_pegawai->total_kota();
		$data['kota'] = $this->M_pegawai->tampil_kota();
		$this->load->view('hrd/kota',$data);
	}

	public function Cetak_Laporan_Pegawai(){
		$data['pegawai'] = $this->M_pegawai->tampil_pegawai();
		$this->load->view('hrd/cetak_laporan_pegawai',$data);
	}

	public function Cetak_Laporan_Absen(){
		$data['absen'] = $this->M_pegawai->tampil_laporan_absen();
		$this->load->view('hrd/cetak_laporan_absen',$data);
	}


	public function Tambah_Pegawai(){
		$nama_pegawai		= $this->input->post('nama_pegawai');
		$kode_pegawai		= $this->input->post('kode_pegawai');
		$nomor_telepon	= $this->input->post('nomor_telepon');
		$kode_posisi	= $this->input->post('kode_posisi');
		$kode_kota 	= $this->input->post('kode_kota'); 
		$foto 		= $this->input->post('foto'); 
		
		//upload foto ke folder
		$config['upload_path'] = './assets/foto/';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size'] = 5000; // max 5 MB
		$this->load->library('upload',$config);
		if($this->upload->do_upload('foto')){ 
			//jika upload berhasil maka isi variabel $foto = file_name
			$foto=$this->upload->data('file_name'); 
		}else{
			//jika gagal upload maka isi variabel $foto = 'no_image.jpg'
			echo "Upload Gagal";
			$foto='no_image.jpg';
		}
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_pegawai'=>$nama_pegawai,
		'kode_pegawai'=>$kode_pegawai,
		'nomor_telepon'=>$nomor_telepon,
		'kode_posisi'=>$kode_posisi,
		'kode_kota'=>$kode_kota,
		'foto'=> $foto,
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('pegawai', $data);
		redirect('HRD/Pegawai');
	}

	//fungsi untuk memperbaharui/mengupdate data dari database
//fungsi untuk memperbaharui/mengupdate data dari database
	public function Update_Pegawai(){
		$id 		= $this->input->post('id');
		$nama_pegawai 		= $this->input->post('nama_pegawai');
		$kode_pegawai 		= $this->input->post('kode_pegawai');
		$nomor_telepon 	= $this->input->post('nomor_telepon');
		$kode_posisi 	= $this->input->post('kode_posisi');
		$kode_kota 	= $this->input->post('kode_kota'); 
		$old_foto	= $this->input->post('old_foto');
		// $foto	= $this->input->post('foto');
		$foto 		= $_FILES['foto']['tmp_name'];
	
		if ($foto == ''){ //jika $foto kosong
			$foto=$old_foto;
		}else{
			//upload foto ke folder
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_size'] = 5000; // max 5 MB
			$this->load->library('upload',$config);
			if($this->upload->do_upload('foto')){ //jika upload berhasil maka isi variabel $foto = file_name
				$foto=$this->upload->data('file_name'); 
			}else{ //Jika gagal upload maka isi variabel $foto = 'no_image.jpg'
					echo "Upload Gagal";
					$foto='no_image.jpg';
				}
			//hapus foto
			if ($old_foto!='no_image.jpg') { //jika foto bukan 'no_image.jpg' maka hapus
				//lokasi gambar
				$path='./assets/foto/';
				//hapus data di folder
				@unlink($path.$old_foto);		
			}
		}
						
		$data = array(
		'nama_pegawai'=>$nama_pegawai,
		'kode_pegawai'=>$kode_pegawai,
		'nomor_telepon'=>$nomor_telepon,
		'kode_posisi'=>$kode_posisi,
		'kode_kota'=>$kode_kota,
		'foto'=>$foto
		);
	
		//method yang nanti akan digunakan di model
		//untuk merubah mengapdate data dari database
		$this->M_pegawai->update_data($id,$data,'pegawai');
		// var_dump($data);
		redirect('HRD/Pegawai');
	}

	public function Tambah_Posisi(){
		$nama_posisi		= $this->input->post('nama_posisi'); 
		$kode_posisi 		= $this->input->post('kode_posisi');
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_posisi'=>$nama_posisi,
		'kode_posisi'=>$kode_posisi
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('posisi', $data);
		redirect('HRD/Posisi');
	}

	public function Update_Posisi(){
		$id 		= $this->input->post('id');
		$nama_posisi		= $this->input->post('nama_posisi'); 
		$kode_posisi 		= $this->input->post('kode_posisi');
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_posisi'=>$nama_posisi,
		'kode_posisi'=>$kode_posisi
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->update_data($id, $data, 'posisi');
		redirect('HRD/Posisi');
	}


	public function Tambah_Kota(){
		$nama_kota		= $this->input->post('nama_kota'); 
		$kode_kota 		= $this->input->post('kode_kota');
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_kota'=>$nama_kota,
		'kode_kota'=>$kode_kota
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('kota', $data);
		redirect('HRD/Kota');
	}

	public function Update_Kota(){
		$id 		= $this->input->post('id');
		$nama_kota		= $this->input->post('nama_kota'); 
		$kode_kota 		= $this->input->post('kode_kota');
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_kota'=>$nama_kota,
		'kode_kota'=>$kode_kota
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->update_data($id, $data, 'kota');
		redirect('HRD/Kota');
	}


	//fungsi untuk menghapus data
	public function Hapus_Pegawai($id){

		$this->M_pegawai->hapus_data($id, 'pegawai');
		redirect('HRD/Pegawai');
	}

	public function Hapus_Posisi($id){

		$this->M_pegawai->hapus_data($id, 'posisi');
		redirect('HRD/Posisi');
	}

	public function Hapus_Kota($id){

		$this->M_pegawai->hapus_data($id, 'kota');
		redirect('HRD/Kota');
	}

}