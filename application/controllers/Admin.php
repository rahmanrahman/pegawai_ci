<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct(){ 
		parent::__construct(); 
		if($this->session->userdata('status') != "login_admin"){
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
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/templates/footerD', $data);

	}

	public function Pegawai(){
		//method yang nanti akan digunakan di model 
		//untuk menampilkan data yang ada pada database
		$data['posisi'] = $this->M_pegawai->tampil_posisi();
		$data['kota'] = $this->M_pegawai->tampil_kota();
		$data['pegawai'] = $this->M_pegawai->tampil_pegawai();
		$data['total_pegawai'] = $this->M_pegawai->total_pegawai();
		$this->load->view('admin/pegawai',$data);
	}

	public function Absen(){
		//method yang nanti akan digunakan di model 
		$data['absen'] = $this->M_pegawai->tampil_laporan_absen();
		$this->load->view('admin/absen',$data);
	}

	public function Posisi(){
		//method yang nanti akan digunakan di model 
		$data['total_posisi'] = $this->M_pegawai->total_posisi();
		$data['posisi'] = $this->M_pegawai->tampil_posisi();
		$this->load->view('admin/posisi',$data);
	}

	public function Kota(){
		//method yang nanti akan digunakan di model 
		$data['total_kota'] = $this->M_pegawai->total_kota();
		$data['kota'] = $this->M_pegawai->tampil_kota();
		$this->load->view('admin/kota',$data);
	}

	public function HRD(){
		//method yang nanti akan digunakan di model 
		$data['hrd'] = $this->M_pegawai->tampil_hrd();
		$this->load->view('admin/hrd',$data);
	}

	public function Admin(){
		//method yang nanti akan digunakan di model 
		$data['admin'] = $this->M_pegawai->tampil_admin();
		$this->load->view('admin/admin',$data);
	}

	public function Cetak_Laporan_Pegawai(){
		$data['pegawai'] = $this->M_pegawai->tampil_pegawai();
		$this->load->view('admin/cetak_laporan_pegawai',$data);
	}

	public function Cetak_Laporan_Absen(){
		$data['absen'] = $this->M_pegawai->tampil_laporan_absen();
		$this->load->view('admin/cetak_laporan_absen',$data);
	}


	public function Tambah_Pegawai(){
		$nama_pegawai		= $this->input->post('nama_pegawai');
		$kode_pegawai		= $this->input->post('kode_pegawai');
		$nomor_telepon	= $this->input->post('nomor_telepon');
		$kode_posisi	= $this->input->post('kode_posisi');
		$kode_kota 	= $this->input->post('kode_kota'); 
		
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama_pegawai'=>$nama_pegawai,
		'kode_pegawai'=>$kode_pegawai,
		'nomor_telepon'=>$nomor_telepon,
		'kode_posisi'=>$kode_posisi,
		'kode_kota'=>$kode_kota
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('pegawai', $data);
		redirect('Admin/Pegawai');
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
		
						
		$data = array(
		'nama_pegawai'=>$nama_pegawai,
		'kode_pegawai'=>$kode_pegawai,
		'nomor_telepon'=>$nomor_telepon,
		'kode_posisi'=>$kode_posisi,
		'kode_kota'=>$kode_kota
		);
	
		//method yang nanti akan digunakan di model
		//untuk merubah mengapdate data dari database
		$this->M_pegawai->update_data($id,$data,'pegawai');
		// var_dump($data);
		redirect('Admin/Pegawai');
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
		redirect('Admin/Posisi');
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
		redirect('Admin/Posisi');
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
		redirect('Admin/Kota');
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
		redirect('Admin/Kota');
	}

	public function Tambah_HRD(){
		$nama		= $this->input->post('nama'); 
		$password 		= md5($this->input->post('password'));
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama'=>$nama,
		'password'=>$password
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('hrd', $data);
		redirect('Admin/HRD');
	}

	public function Update_HRD(){
		$id		= $this->input->post('id'); 
		$nama		= $this->input->post('nama'); 
		$password 		= md5($this->input->post('password'));
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama'=>$nama,
		'password'=>$password
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->update_data('hrd', $data);
		redirect('Admin/HRD');
	}

	public function Tambah_Admin(){
		$nama		= $this->input->post('nama'); 
		$password 		= md5($this->input->post('password'));
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama'=>$nama,
		'password'=>$password
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->input_data('admin', $data);
		redirect('Admin/Admin');
	}

	public function Update_Admin(){
		$id		= $this->input->post('id'); 
		$nama		= $this->input->post('nama'); 
		$password 		= md5($this->input->post('password'));
		
		//data yang dikirim harus bertipe array
		$data = array(
		'nama'=>$nama,
		'password'=>$password
		);

		//method yang nanti akan digunakan di model 
		//untuk memasukan data ke database
		$this->M_pegawai->update_data('admin', $data);
		redirect('Admin/Admin');
	}


	//fungsi untuk menghapus data
	public function Hapus_Pegawai($id){

		$this->M_pegawai->hapus_data($id, 'pegawai');
		redirect('Admin/Pegawai');
	}

	public function Hapus_Posisi($id){

		$this->M_pegawai->hapus_data($id, 'posisi');
		redirect('Admin/Posisi');
	}

	public function Hapus_Kota($id){

		$this->M_pegawai->hapus_data($id, 'kota');
		redirect('Admin/Kota');
	}

	public function Hapus_HRD($id){

		$this->M_pegawai->hapus_data($id, 'hrd');
		redirect('Admin/HRD');
	}

	public function Hapus_Admin($id){

		$this->M_pegawai->hapus_data($id, 'admin');
		redirect('Admin/Admin');
	}

}