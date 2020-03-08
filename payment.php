<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Pembayaran");
$myfunc->set_subtitle("Pembayaran");
$myfunc->set_breadcrumbs("HOME / PEMBAYARAN");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_siswa();
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Pembayaran
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
					<tbody>
						<?php foreach ($get as $row): ?>
							<?php 
								$kelas = $myfunc->get_class($row['id_kelas']);
							?>
							<tr>
								<td><?= $row['nisn'] ?></td>
								<td><?= $row['nis'] ?></td>
								<td><?= $row['nama'] ?></td>
								<td><?= $kelas['kelas'] ?></td>
								<td><?= $row['alamat'] ?></td>
								<td><?= $row['nohp'] ?></td>
								<td align="center">
									<a href="<?= $myfunc->baseurl ?>payment.php?pay=<?= $row['nisn'] ?>" class="btn btn-success">
										Bayar
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>