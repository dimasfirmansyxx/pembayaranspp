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

		$uri = end(explode("/", $_SERVER["PHP_SELF"]));
		if ( !isset($_SESSION["user_logged"]) ) {
			if ( $uri != "login.php" ) {
				$this->redirect($this->baseurl . "login.php");
			}
		}
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

	public function login_check($data)
	{
		$username = $data['username'];
		$password = $data['password'];

		$query = "SELECT * FROM tbluser WHERE username = '$username'";
		if ( $this->check_availability($query) ) {
			$get = $this->get_data($query);
			if ( password_verify($password, $get['password']) ) {
				$_SESSION["user_logged"] = $get;
				$this->redirect($this->baseurl);
				echo "a";
			} else {
				$this->notif("Gagal! Password salah","danger");
				// $this->redirect($this->baseurl . "login.php");
			}
		} else {
			$this->notif("Gagal! Username tidak ada","danger");
			// $this->redirect($this->baseurl . "login.php");
		}
	}

	public function get_siswa($nisn = null)
	{
		if ( $nisn == null ) {
			$query = "SELECT * FROM tblsiswa ORDER BY id_kelas DESC";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tblsiswa WHERE nisn = '$nisn'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
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

	public function edit_major($data)
	{
		$id_jurusan = $data['id_jurusan'];
		$jurusan = $data['jurusan'];

		if ( $this->check_availability("SELECT * FROM tbljurusan WHERE jurusan = '$jurusan'") ) {
			$this->notif("Gagal! Jurusan sudah ada","warning");
			$this->redirect($this->baseurl . "major_edit.php?id=$id_jurusan");
		} else {
			$insert = $this->exe("UPDATE tbljurusan SET jurusan = '$jurusan' WHERE id_jurusan = '$id_jurusan'");
			if ( $insert > 0 ) {
				$this->notif("Sukses mengubah jurusan","success");
				$this->redirect($this->baseurl . "major.php");
			} else {
				$this->notif("Gagal! Kesalahan pada query","danger");
				$this->redirect($this->baseurl . "major_edit.php?id=$id_jurusan");
			}
		}
	}

	public function get_class($id_kelas = null)
	{
		if ( $id_kelas == null ) {
			$query = "SELECT * FROM tblkelas";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tblkelas WHERE id_kelas = '$id_kelas'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function add_class($data)
	{
		$kelas = strtoupper($data['kelas']);
		$jurusan = $data['jurusan'];
		if ( $this->check_availability("SELECT * FROM tblkelas WHERE kelas = '$kelas' AND id_jurusan = '$jurusan'") ) {
			$this->notif("Gagal! Kelas sudah ada","warning");
			$this->redirect($this->baseurl . "class_add.php");
		} else {
			$insert = $this->exe("INSERT INTO tblkelas VALUES ('','$jurusan','$kelas')");
			if ( $insert > 0 ) {
				$this->notif("Sukses menambah kelas","success");
				$this->redirect($this->baseurl . "class.php");
			} else {
				$this->notif("Gagal! Kesalahan pada query","danger");
				$this->redirect($this->baseurl . "class_add.php");
			}
		}
	}

	public function delete_class($id_kelas)
	{
		$delete = $this->exe("DELETE FROM tblkelas WHERE id_kelas = '$id_kelas'");
		if ( $delete > 0 ) {
			$this->notif("Sukses menghapus kelas","success");
			$this->redirect($this->baseurl . "class.php");
		} else {
			$this->notif("Gagal! Kesalahan pada query","danger");
			$this->redirect($this->baseurl . "class.php");
		}
	}

	public function edit_class($data)
	{
		$id_kelas = $data['id_kelas'];
		$id_jurusan = $data['id_jurusan'];
		$kelas = $data['kelas'];

		if ( $this->check_availability("SELECT * FROM tblkelas WHERE kelas = '$kelas' AND id_jurusan = '$id_jurusan'") ) {
			$this->notif("Gagal! Kelas sudah ada","warning");
			$this->redirect($this->baseurl . "class_edit.php?id=$id_kelas");
		} else {
			$insert = $this->exe("UPDATE tblkelas SET id_jurusan = '$id_jurusan', kelas = '$kelas' WHERE id_kelas = '$id_kelas'");
			if ( $insert > 0 ) {
				$this->notif("Sukses mengubah kelas","success");
				$this->redirect($this->baseurl . "class.php");
			} else {
				$this->notif("Gagal! Kesalahan pada query","danger");
				$this->redirect($this->baseurl . "class_edit.php?id=$id_kelas");
			}
		}
	}

	public function get_officer($id_user = null)
	{
		if ( $id_user == null ) {
			$query = "SELECT * FROM tbluser";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tbluser WHERE id_user = '$id_user'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function get_payment($id_spp = null)
	{
		if ( $id_spp == null ) {
			$query = "SELECT * FROM tblspp";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tblspp WHERE id_spp = '$id_spp'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function get_transaksi($id_pembayaran = null)
	{
		if ( $id_pembayaran == null ) {
			$query = "SELECT * FROM tblpembayaran ORDER BY id_pembayaran DESC";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM tblpembayaran WHERE id_pembayaran = '$id_pembayaran'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function do_payment($data)
	{
		$nisn = $data['nisn'];
		$id_user = $data['id_user'];
		$tgltransaksi = date("Y-m-d");
		$blnbayar = $data['bulan'];
		$thnbayar = $data['tahun'];

		$query = "SELECT * FROM tblpembayaran WHERE nisn = '$nisn' AND blnbayar = '$blnbayar' AND thnbayar = '$thnbayar'";

		if ( $this->check_availability($query) ) {
			$this->notif("Siswa ini sudah melakukan pembayaran","warning");
			$this->redirect($this->baseurl . "transaction.php?pay=$nisn");
		} else {
			$query = "INSERT INTO tblpembayaran VALUES ('','$nisn','$id_user','$tgltransaksi','$blnbayar','$thnbayar')";
			$insert = $this->exe($query);
			if ( $insert > 0 ) {
				$this->notif("Sukses melakukan pembayaran","success");
				$this->redirect($this->baseurl . "transaction.php");
			} else {
				$this->notif("Gagal! Kesalahan pada query","danger");
				$this->redirect($this->baseurl . "transaction.php?pay=$nisn");
			}
		}
	}

	public function get_report($data)
	{
		$kelas = $data['kelas'];
		$bulan = $data['bulan'];
		$tahun = $data['tahun'];

		if ( $kelas == 0 ) {
			$siswa = "SELECT * FROM tblsiswa ORDER BY id_kelas ASC";
		} else{
			$siswa = "SELECT * FROM tblsiswa WHERE id_kelas = '$kelas' ORDER BY nama ASC";
		}

		$siswa = $this->query($siswa);

		$output = [];

		foreach ($siswa as $row) {
			$nisn = $row['nisn'];
			$get_payment = "SELECT * FROM tblpembayaran WHERE nisn = '$nisn' AND blnbayar = '$bulan' AND thnbayar = '$tahun'";
			if ( $this->check_availability($get_payment) ) {
				$status = "LUNAS";
			} else {
				$status = "BELUM LUNAS";
			}

			$kelas = $this->get_class($row['id_kelas']);

			$arr = ["siswa" => $row['nama'], "kelas" => $kelas['kelas'], "status" => $status];
			array_push($output, $arr);
		}

		return $output;
	}
}