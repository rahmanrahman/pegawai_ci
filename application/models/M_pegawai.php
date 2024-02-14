<?php 
/**
 * 
 */
class M_pegawai extends CI_Model{
	//method yang dibuat di controller (Admin.php)
	public function tampil_laporan_absen(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
		$this->db->select('absen.*, pegawai.nama_pegawai');
		$this->db->from('absen');
        $this->db->join('pegawai', 'absen.kode_pegawai = pegawai.kode_pegawai');
	$query = $this->db->get();
        return $query->result();
	}

	public function tampil_posisi(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
	return $this->db->get('posisi')->result();
	}

	public function tampil_kota(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
	return $this->db->get('kota')->result();
	}

	public function tampil_hrd(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
	return $this->db->get('hrd')->result();
	}

	public function tampil_admin(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
	return $this->db->get('admin')->result();
	}

	public function tampil_pegawai(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
		$this->db->select('pegawai.*, kota.nama_kota, posisi.nama_posisi');
		$this->db->from('pegawai');
		$this->db->join('kota', 'pegawai.kode_kota = kota.kode_kota');
		$this->db->join('posisi', 'pegawai.kode_posisi = posisi.kode_posisi');
	$query = $this->db->get();
        return $query->result();
	}

	public function total_absen(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
	return $this->db->get('absen')->num_rows();
	}

	public function total_pegawai(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
		$this->db->select('kode_pegawai, COUNT(kode_pegawai) as total');
	return $this->db->get('pegawai')->result();
	}

	public function total_posisi(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
		$this->db->select('kode_posisi, COUNT(kode_posisi) as total');
	return $this->db->get('posisi')->result();
	}

	public function total_kota(){
	//pemanggilan data yang berada di tabel tb_mahasiswa
		$this->db->select('kode_kota, COUNT(kode_kota) as total');
	return $this->db->get('kota')->result();
	}

	public function total_absen_pegawai(){
		$this->db->select('absen.*, pegawai.nama_pegawai');
		$this->db->select('absen.kode_pegawai, COUNT(absen.kode_pegawai) as total');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->group_by('absen.kode_pegawai');
	//pemanggilan data yang berada di tabel tb_mahasiswa
	$query = $this->db->get();
        return $query->result();
	}

	public function total_posisi_pegawai(){
		$this->db->select('pegawai.*, posisi.nama_posisi');
		$this->db->select('pegawai.kode_posisi, COUNT(pegawai.kode_posisi) as total');
		$this->db->from('pegawai');
		$this->db->join('posisi', 'pegawai.kode_posisi = posisi.kode_posisi');
		$this->db->group_by('posisi.nama_posisi');
	//pemanggilan data yang berada di tabel tb_mahasiswa
	$query = $this->db->get();
        return $query->result();
	}

	public function total_kota_pegawai(){
		$this->db->select('pegawai.*, kota.nama_kota');
		$this->db->select('pegawai.kode_kota, COUNT(pegawai.kode_kota) as total');
		$this->db->from('pegawai');
		$this->db->join('kota', 'pegawai.kode_kota = kota.kode_kota');
		$this->db->group_by('kota.nama_kota');
	//pemanggilan data yang berada di tabel tb_mahasiswa
	$query = $this->db->get();
        return $query->result();
	}

	//method yang dibuat di controller (Admin.php)
	public function input_data($tabel,$data){
		//memasukan data inputan ke tabel tb_mahasiswa
		$this->db->insert($tabel, $data);
	}

	//method yang dibuat di controller (Admin.php) untuk menghapus data
	public function hapus_data($id, $tabel){
		$this->db->where('id',$id);
		//menghapus data dari tabel tb_mahasiswa
		$this->db->delete($tabel);
	}

	//method yang dibuat di controller (Admin.php) untuk merubah data 
	public function get_data($id, $table){
		//merubah data dari tabel tb_mahasiswa
		//$this->db->from();
		$this->db->where('id',$id);
	return $this->db->get($table)->row();
	}
	
	//method yang dibuat di controller (Admin.php) untuk mengupdate data 
	public function update_data($id,$data,$table){
		$this->db->where('id',$id);
		//mengupdate data dari tabel tb_mahasiswa
		$this->db->update($table,$data);
	}

	//method yang dibuat di controller (Admin.php dan C_Mahasiswa) untuk menampilkan detail data 
	public function detail_data($where, $table){
		$this->db->where($where);
	return $this->db->get($table)->row(); 
	}

	

}

//end of file M_mahasiswa.php
//location application\model