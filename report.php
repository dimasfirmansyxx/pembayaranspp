<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Laporan Transaksi");
$myfunc->set_subtitle("Laporan");
$myfunc->set_breadcrumbs("HOME / LAPORAN TRANSAKSI");

include 'templates/head.php';
include 'templates/nav.php';

$bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

$kelas = $myfunc->get_class();
$nowmonth = date("n");
$nowyear = date("Y");

if ( isset($_POST['filter']) ) {
	$get = $myfunc->get_report($_POST);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Filter Laporan
		</div>
		<div class="card-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Kelas</label>
					<select class="form-control" name="kelas">
						<option value="0">Semua</option>
						<?php foreach ($kelas as $row): ?>
							<option value="<?= $row['id_kelas'] ?>"><?= $row['kelas'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Bulan</label>
					<select class="form-control" name="bulan">
						<?php foreach ($bulan as $key => $value): ?>
							<?php if ( $nowmonth == $key + 1 ): ?>
								<option value="<?= $key + 1 ?>" selected><?= $value ?></option>
							<?php else: ?>
								<option value="<?= $key + 1 ?>"><?= $value ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Tahun</label>
					<input type="number" name="tahun" class="form-control" required value="<?= $nowyear ?>">
				</div>
				<button class="btn btn-warning" type="submit" name="filter">Submit</button>
			</form>
		</div>
	</div>

	<div class="card mt-4">
		<div class="card-header bg-warning text-white">
			Laporan Transaksi
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Siswa</th>
							<th>Kelas</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !isset($_POST['filter']) ): ?>
							<tr>
								<td align="center" colspan="4">Filter laporan terlebih dahulu</td>
							</tr>
						<?php else: ?>
							<?php if ( $get == 3 ): ?>
								<tr>
									<td align="center" colspan="4">Tidak ada data</td>
								</tr>
							<?php else: ?>
								<?php $i = 1;
								foreach ($get as $row): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $row['siswa'] ?></td>
										<td><?= $row['kelas'] ?></td>
										<td><?= $row['status'] ?></td>
									</tr>
								<?php endforeach ?>	
							<?php endif ?>
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