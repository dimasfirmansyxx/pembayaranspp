<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Jurusan");
$myfunc->set_subtitle("Edit Jurusan");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN JURUSAN / EDIT");

include 'templates/head.php';
include 'templates/nav.php';

if ( !isset($_GET['id']) ) {
	$myfunc->redirect($myfunc->baseurl . "major.php");
} else {
	$_SESSION["id_jurusan"] = $_GET['id'];
	$get = $myfunc->get_major($_GET['id']);
}

if ( isset($_POST['simpan']) ) {
	$data = [
		"id_jurusan" => $_SESSION['id_jurusan'],
		"jurusan" => ucwords($_POST['jurusan'])
	];
	unset($_SESSION['id_jurusan']);
	if ( $data['jurusan'] == $get['jurusan'] ) {
		$myfunc->redirect($myfunc->baseurl . "major.php");
	} else {
		$myfunc->edit_major($data);
	}
}

?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Tambah Jurusan
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>major.php" class="btn btn-primary">< Kembali</a>
			<form action="" method="post" class="mt-5">
				<div class="form-group">
					<label>Jurusan</label>
					<input type="text" name="jurusan" required class="form-control" autocomplete="off" value="<?= $get['jurusan'] ?>">
				</div>
				<button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>