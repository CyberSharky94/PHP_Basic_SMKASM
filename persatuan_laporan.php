<?php include 'connection.php'; ?>

<?php 
	
	$id_persatuan = $_GET['id'];

	//Dapatkan Maklumat Persatuan
	$sql = "SELECT nama_persatuan FROM persatuan WHERE id_persatuan = '".$id_persatuan."'";
	$result = mysqli_query($conn, $sql);
	$datap = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Laporan Pendaftaran Kokurikulum</h3>
	<hr>
	<table>
		<tr>
			<td>Nama Persatuan: </td>
			<td><b><?php echo $datap['nama_persatuan']; ?></b></td>
		</tr>
		<tr>
			<?php
				//Dapatkan Maklumat Guru Persatuan
				$sql = "SELECT * FROM guru g JOIN persatuan p ON g.id_persatuan = p.id_persatuan WHERE g.id_persatuan = '".$id_persatuan."'";
				$result = mysqli_query($conn, $sql);
			?>
			<td>Nama Penasihat: </td>
			<td><b>
				<ul>
					<?php while($datag = mysqli_fetch_array($result)) { ?>
					<li><?php echo $datag['nama_guru']; ?></li>
					<?php } ?>
				</ul>
				</b>
			</td>
		</tr>
	</table>
	<hr>

	<table border="1">
		<tr>
			<th>Bil</th>
			<th>Nama Pelajar</th>
			<th>No KP</th>
			<th>Tarikh Lahir</th>
		</tr>
		<?php
			//Dapatkan Maklumat Pelajar Persatuan
			$sql = "SELECT * FROM pelajar pl JOIN persatuan p ON pl.id_persatuan = p.id_persatuan WHERE pl.id_persatuan = '".$id_persatuan."'";
			$result = mysqli_query($conn, $sql);
		?>
		<?php $i=0; 
			while($datapl = mysqli_fetch_array($result)) {  $i++; ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $datapl['nama_pelajar']; ?></td>
			<td><?php echo $datapl['nokp_pelajar']; ?></td>
			<td><?php echo $datapl['tlahir_pelajar']; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="4"><i>Jumlah pelajar: <?php echo $i; ?></i></td>
		</tr>
	</table><br>
	<input type="button" onclick="window.print();" value="CETAK">
</body>
</html>