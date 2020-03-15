<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Kelas");
$myfunc->set_subtitle("Tambah Kelas");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN KELAS / TAMBAH");

include 'templates/head.php';
include 'templates/nav.php';

if ( isset($_POST['simpan']) ) {
	$myfunc->add_class($_POST);
}

$major = $myfunc->get_major();
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Tambah Kelas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>class.php" class="btn btn-primary">< Kembali</a>
			<form action="" method="post" class="mt-5">
				<div class="form-group">
					<label>Kelas</label>
					<input type="text" name="kelas" required class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label>Jurusan</label>
					<select class="form-control" name="jurusan">
						<?php foreach ($major as $row): ?>
							<option value="<?= $row['id_jurusan'] ?>"><?= $row['jurusan'] ?></option>
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