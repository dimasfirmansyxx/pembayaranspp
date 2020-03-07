<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Jurusan");
$myfunc->set_subtitle("Tambah Jurusan");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN JURUSAN / TAMBAH");

include 'templates/head.php';
include 'templates/nav.php';

if ( isset($_POST['simpan']) ) {
	$myfunc->add_major($_POST['jurusan']);
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
					<input type="text" name="jurusan" required class="form-control" autocomplete="off">
				</div>
				<button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>