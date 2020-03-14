<?php 
include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Manajemen Pembayaran");
$myfunc->set_subtitle("Manajemen Pembayaran");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN PEMBAYARAN");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_payment();

if ( isset($_GET['hapus']) ) {
	$myfunc->payment_delete($_GET['hapus']);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Manajemen Pembayaran
		</div>
		<div class="card-body">
			<a class="btn btn-primary" href="<?= $myfunc->baseurl ?>payment_add.php">Tambah Nominal</a>
			<div class="table-responsive mt-5">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>No</th>
							<th>Tahun</th>
							<th>Nominal</th>
							<th>Remarks</th>
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
									$tahun = $myfunc->get_payment($row['id_spp']);
									$nominal = $myfunc->get_payment($row['id_spp']);
									$remarks = $myfunc->get_payment($row['id_spp']);
									?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $tahun['tahun']; ?></td>
								<td><?= $nominal['nominal']; ?></td>
								<td><?= $remarks['remarks']; ?></td>
								<td>
									<a href="<?= $myfunc->baseurl ?>payment_edit.php?id=<?= $row['id_spp'] ?>" class="btn btn-primary">Edit</a>
									<a href="<?= $myfunc->baseurl ?>payment.php?hapus=<?= $row['id_spp'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
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
