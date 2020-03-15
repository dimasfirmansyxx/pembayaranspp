<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Beranda");
$myfunc->set_subtitle("");
$myfunc->set_breadcrumbs("HOME /");

include 'templates/head.php';
include 'templates/nav.php';
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Beranda
		</div>
		<div class="card-body">
			<h1 class="text-center"><?= $myfunc->siteinfo("nama_sekolah") ?></h1>
			<h3 class="text-center"><?= $myfunc->siteinfo("alamat") ?></h3>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>