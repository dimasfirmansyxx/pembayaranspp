<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Pembayaran");
$myfunc->set_subtitle("Pembayaran");
$myfunc->set_breadcrumbs("HOME / PEMBAYARAN");

include 'templates/head.php';
include 'templates/nav.php';

$get = $myfunc->get_siswa();
$bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$nowmonth = date("n");
$nowyear = date("Y");

if ( isset($_GET['pay']) ) {
	$siswa = $myfunc->get_siswa($_GET['pay']);
	if ( $siswa == 3 ) {
		$myfunc->redirect($myfunc->baseurl . "transaction.php");
	} else {
		$kelas = $myfunc->get_class($siswa['id_kelas']);
		$spp = $myfunc->get_payment($siswa['id_spp']);
	}
}

if ( isset($_POST['bayar']) ) {
	$_POST['nisn'] = $_GET['pay'];
	$_POST['id_user'] = $_SESSION["user_logged"]['id_user'];
	$myfunc->do_payment($_POST);
}
?>

<?php if ( !isset($_GET['pay']) ): ?>
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
									<a href="<?= $myfunc->baseurl ?>transaction.php?pay=<?= $row['nisn'] ?>" class="btn btn-success">
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

<?php else: ?>
<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Pembayaran
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>transaction.php" class="btn btn-danger">< Batal</a>
			<table class="table mt-5">
				<tr class="bg-warning text-white">
					<th colspan="2">Data Siswa</th>
				</tr>
				<tr>
					<td>NISN</td>
					<td><?= $siswa['nisn'] ?></td>
				</tr>
				<tr>
					<td>NIS</td>
					<td><?= $siswa['nis'] ?></td>
				</tr>
				<tr>
					<td>Nama Siswa</td>
					<td><?= $siswa['nama'] ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td><?= $kelas['kelas'] ?></td>
				</tr>
			</table>
		</div>
		<form action="" method="post">
		<div class="card-body">
			<table class="table">
				<tr class="bg-warning text-white">
					<th colspan="2">Detail Pembayaran</th>
				</tr>
				<tr>
					<td>Pembayaran Bulan</td>
					<td class="form-group">
						<select class="form-control" name="bulan">
							<?php foreach ($bulan as $key => $value): ?>
								<?php if ( $nowmonth == $key + 1 ): ?>
									<option value="<?= $key + 1 ?>" selected><?= $value ?></option>
								<?php else: ?>
									<option value="<?= $key + 1 ?>"><?= $value ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Pembayaran Tahun</td>
					<td class="form-group">
						<select class="form-control" name="tahun">
							<option value="<?= $nowyear - 1 ?>"><?= $nowyear - 1 ?></option>
							<option value="<?= $nowyear ?>" selected><?= $nowyear ?></option>
							<option value="<?= $nowyear + 1 ?>"><?= $nowyear + 1 ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Total Bayar (<?= $spp['remarks'] ?>)</td>
					<td>Rp.<?= number_format($spp['nominal']) ?>,-</td>
				</tr>
			</table>
		</div>
		<div class="card-body">
			<div class="bagi-2">
				<p><?= date("d") ?> <?= $bulan[$nowmonth - 1] ?> <?= date("Y") ?>,</p>
				<p><?= $_SESSION["user_logged"]['nama'] ?></p>
			</div>
			<div class="bagi-2 text-right">
				<button class="btn btn-success" name="bayar" type="submit">Bayar</button>
			</div>
		</div>
		</form>
	</div>
</div>
<?php endif ?>

<?php
	include 'templates/footer.php';
?>