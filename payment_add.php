<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Manajemen Pembayaran");
$myfunc->set_subtitle("Tambah Pembayaran");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN PEMBAYARAN / TAMBAH");

include 'templates/head.php';
include 'templates/nav.php';

if ( isset($_POST['simpan']) ) {
	$myfunc->payment_add($_POST);
}

?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Tambah Kelas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>payment.php" class="btn btn-primary">< Kembali</a>
			<form action="" method="post" class="mt-5">
				<div class="form-group">
					<label>Tahun</label>
					<input type="text" name="tahun" required class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label>Nominal</label>
					<input type="text" name="nominal" required class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label>Remarks</label>
					<input type="text" name="remarks" required class="form-control" autocomplete="off">
				</div>
				<button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>