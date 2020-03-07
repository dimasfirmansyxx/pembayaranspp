<!-- navbar -->
<nav class="navbar bg-warning">
	<h3 class="text-center text-white mt-5 mb-5">Pembayaran</h3>
	<a href="<?= $myfunc->baseurl ?>">Beranda</a>
	<a href="<?= $myfunc->baseurl ?>student.php">Manajemen Siswa</a>
	<a href="<?= $myfunc->baseurl ?>class.php">Manajemen Kelas</a>
	<a href="<?= $myfunc->baseurl ?>major.php">Manajemen Jurusan</a>
	<a href="<?= $myfunc->baseurl ?>payment.php">Manajemen Pembayaran</a>
	<a href="<?= $myfunc->baseurl ?>officer.php">Manajemen Petugas</a>
	<a href="<?= $myfunc->baseurl ?>transaction.php">Transaksi</a>
	<a href="<?= $myfunc->baseurl ?>history.php">History Transaksi</a>
	<a href="<?= $myfunc->baseurl ?>report.php">Laporan</a>
</nav>

<!-- topnav -->
<nav class="topnav bg-dark">
	<a href="<?= $myfunc->baseurl ?>profil.php">Profil</a>
	<a href="<?= $myfunc->baseurl ?>index.php?logout=">Logout</a>
</nav>

	<div class="content">
		
		<!-- breadcrumb -->
		<div class="breadcrumb">
			<p class="text-muted"><?= $myfunc->breadcrumbs ?></p>
		</div>

		<div class="page-info">
			<h2><?= $myfunc->title ?></h2>
			<p><?= $myfunc->subtitle ?></p>
		</div>	

		<?php if ( isset($_SESSION["flash_data"]) ): ?>
			<div class="alert bg-<?= $_SESSION["flash_data"]["status"] ?> text-white">
				<?= $_SESSION["flash_data"]["message"] ?>
			</div>
			<?php unset($_SESSION["flash_data"]) ?>
		<?php endif ?>
		<!-- content section -->