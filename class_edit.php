<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Kelas");
$myfunc->set_subtitle("Edit Kelas");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN KELAS / EDIT");

include 'templates/head.php';
include 'templates/nav.php';

if ( !isset($_GET['id']) ) {
	$myfunc->redirect($myfunc->baseurl . "class.php");
} else {
	$_SESSION["id_kelas"] = $_GET['id'];
	$get = $myfunc->get_class($_GET['id']);
}

if ( isset($_POST['simpan']) ) {
	$data = [
		"id_kelas" => $_SESSION['id_kelas'],
		"id_jurusan" => $_POST['jurusan'],
		"kelas" => strtoupper($_POST['kelas'])
	];
	unset($_SESSION['id_kelas']);
	if ( $data['kelas'] == $get['kelas'] && $data['id_jurusan'] == $get['id_jurusan'] ) {
		$myfunc->redirect($myfunc->baseurl . "class.php");
	} else {
		$myfunc->edit_class($data);
	}
}

$major = $myfunc->get_major();
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Edit Kelas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>class.php" class="btn btn-primary">< Kembali</a>
			<form action="" method="post" class="mt-5">
				<div class="form-group">
					<label>Kelas</label>
					<input type="text" name="kelas" required class="form-control" autocomplete="off" value="<?= $get['kelas'] ?>">
				</div>
				<div class="form-group">
					<label>Jurusan</label>
					<select class="form-control" name="jurusan">
						<?php foreach ($major as $row): ?>
							<?php if ( $row['id_jurusan'] == $get['id_jurusan'] ): ?>
								<option value="<?= $row['id_jurusan'] ?>" selected><?= $row['jurusan'] ?></option>
							<?php else: ?>
								<option value="<?= $row['id_jurusan'] ?>"><?= $row['jurusan'] ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
				<button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>