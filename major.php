<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Jurusan");
$myfunc->set_subtitle("Manajemen Jurusan");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN JURUSAN");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_major();

if ( isset($_GET['hapus']) ) {
	$myfunc->delete_major($_GET['hapus']);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			List Jurusan
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>major_add.php" class="btn btn-primary">Tambah Jurusan</a>
			<div class="table-responsive mt-5">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Jurusan</th>
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
									<td><?= $row['jurusan'] ?></td>
									<td>
										<a href="<?= $myfunc->baseurl ?>major_edit.php?id=<?= $row['id_jurusan'] ?>" class="btn btn-primary">Edit</a>
										<a href="<?= $myfunc->baseurl ?>major.php?hapus=<?= $row['id_jurusan'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
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