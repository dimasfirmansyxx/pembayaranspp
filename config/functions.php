<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");

class functions {
	public $conn;
	public $baseurl;
	public $breadcrumbs;
	public $title;
	public $subtitle;

	public function __construct()
	{
		$this->conn = mysqli_connect("localhost","root","","dbspp");
		$this->baseurl = "http://localhost/pembayaranspp/";
	}

	public function set_breadcrumbs($list)
	{
		$this->breadcrumbs = $list;
	}

	public function set_title($title)
	{
		$this->title = $title;
	}

	public function set_subtitle($subtitle)
	{
		$this->subtitle = $subtitle;
	}

	public function siteinfo($show)
	{
		$get = $this->get_data("SELECT * FROM tblsekolah WHERE identitas = '$show'");
		return $get['value'];
	}

	public function get_data($query)
	{
		$query = mysqli_query($this->conn,$query);
		return mysqli_fetch_assoc($query);
	}

	public function query($query)
	{
		$rows = [];
		$get = mysqli_query($this->conn,$query);
		while ( $row = mysqli_fetch_assoc($get) ) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function num_rows($query)
	{
		$get = mysqli_query($this->conn,$query);
		return mysqli_num_rows($get);
	}

	public function exe($query)
	{
		$exe = mysqli_query($this->conn,$query);
		return mysqli_affected_rows($this->conn);
	}

	public function check_availability($query)
	{
		$get = $this->num_rows($query);
		if ( $get > 0 ) {
			return true;
		} else {
			return false;
		}
	}

	public function notif($msg,$status)
	{
		$_SESSION["flash_data"] = ["message" => $msg, "status" => $status];
	}

	public function redirect($link)
	{
		header("Location: $link");
	}


	public function get_major($id_jurusan = null)
	{
		if ( $id_jurusan == null ) {
			$query = "SELECT * FROM tbljurusan";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tbljurusan WHERE id_jurusan = '$id_jurusan'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function add_major($jurusan)
	{
		$jurusan = ucwords($jurusan);
		if ( $this->check_availability("SELECT * FROM tbljurusan WHERE jurusan = '$jurusan'") ) {
			$this->notif("Gagal! Jurusan sudah ada","warning");
			$this->redirect($this->baseurl . "major_add.php");
		} else {
			$insert = $this->exe("INSERT INTO tbljurusan VALUES ('','$jurusan')");
			if ( $insert > 0 ) {
				$this->notif("Sukses menambah jurusan","success");
				$this->redirect($this->baseurl . "major.php");
			} else {
				$this->notif("Gagal! Kesalahan pada query","danger");
				$this->redirect($this->baseurl . "major_add.php");
			}
		}
	}

	public function delete_major($id_jurusan)
	{
		$delete = $this->exe("DELETE FROM tbljurusan WHERE id_jurusan = '$id_jurusan'");
		if ( $delete > 0 ) {
			$this->notif("Sukses menghapus jurusan","success");
			$this->redirect($this->baseurl . "major.php");
		} else {
			$this->notif("Gagal! Kesalahan pada query","danger");
			$this->redirect($this->baseurl . "major.php");
		}
	}
}