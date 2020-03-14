<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Kelas");
$myfunc->set_subtitle("Manajemen Kelas");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN KELAS");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_class();

if ( isset($_GET['hapus']) ) {
	$myfunc->delete_class($_GET['hapus']);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			List Kelas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>class_add.php" class="btn btn-primary">Tambah Kelas</a>
			<div class="table-responsive mt-5">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Kelas</th>
							<th>Jurusan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $get == 3 ): ?>
							<tr class="text-center">
								<td colspan="4">Tidak ada data</td>
							</tr>
						<?php else: ?>
							<?php $i = 1;
							foreach ($get as $row): ?>
								<?php 
									$major = $myfunc->get_major($row['id_jurusan']);
								?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $row['kelas'] ?></td>
									<td><?= $major['jurusan'] ?></td>
									<td>
										<a href="<?= $myfunc->baseurl ?>class_edit.php?id=<?= $row['id_kelas'] ?>" class="btn btn-primary">Edit</a>
										<a href="<?= $myfunc->baseurl ?>class.php?hapus=<?= $row['id_kelas'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
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