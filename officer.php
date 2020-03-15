<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Petugas");
$myfunc->set_subtitle("Manajemen Petugas");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN PETUGAS");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_officer();

if ( isset($_GET['hapus']) ) {
	$myfunc->delete_officer($_GET['hapus']);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			List Petugas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>officer_add.php" class="btn btn-primary">Tambah Petugas</a>
			<div class="table-responsive mt-5">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Password</th>
							<th>privilege</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $get == 3 ): ?>
							<tr class="text-center">
								<td colspan="3">Tidak ada data</td>
							</tr>
						<?php else: ?>
							<?php $i = 1;
							foreach ($get as $row): ?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $row['nama'] ?></td>
									<td><?= $row['username'] ?></td>
									<td><?= $row['password'] ?></td>
									<td><?= $row['privilege'] ?></td>
									<td>
										<a href="<?= $myfunc->baseurl ?>officer.php?hapus=<?= $row['id_user'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
									</td>
								</tr>	
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>