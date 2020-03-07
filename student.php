<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Siswa");
$myfunc->set_subtitle("Manajemen Siswa");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN SISWA");

include 'templates/head.php';
include 'templates/nav.php';
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			List Siswa
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>NISN</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Kelas</th>
							<th>Alamat</th>
							<th>Nomor HP</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>