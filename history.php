<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("History Transaksi");
$myfunc->set_subtitle("Riwayat");
$myfunc->set_breadcrumbs("HOME / HISTORY TRANSAKSI");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_transaksi();

$bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Daftar Riwayat
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Siswa</th>
							<th>Kelas</th>
							<th>Petugas</th>
							<th>Tanggal Transaksi</th>
							<th>Periode Pembayaran</th>
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
								<?php 
									$siswa = $myfunc->get_siswa($row['nisn']);
									$kelas = $myfunc->get_class($siswa['id_kelas']);
									$petugas = $myfunc->get_officer($row['id_user']);
								?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $siswa['nama'] ?></td>
									<td><?= $kelas['kelas'] ?></td>
									<td><?= $petugas['nama'] ?></td>
									<td><?= $row['tgltransaksi'] ?></td>
									<td><?= $bulan[$row['blnbayar'] - 1] ?> <?= $row['thnbayar'] ?></td>
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