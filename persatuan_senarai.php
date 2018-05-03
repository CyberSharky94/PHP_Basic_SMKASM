<?php include 'connection.php'; ?>

<?php 
	
	//kod proses di sini

	if(isset($_POST['buang_rekod'])){
		$id_persatuan = $_POST['id_persatuan'];

		$sql = "DELETE FROM persatuan WHERE id_persatuan = '".$id_persatuan."'";
		$result = mysqli_query($conn, $sql);

		if($result == false){
			$mesej = "RALAT: Rekod Persatuan Gagal Dibuang!";
		} else {
			$mesej = "Rekod Persatuan Telah Berjaya Dibuang!";
		}
	}

	$sql = "SELECT * FROM persatuan";
	$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php if(isset($mesej)){ ?>
		<script type="text/javascript">
			alert('<?php echo $mesej;?>');
		</script>
	<?php } ?>

	<table border="1">
		<tr>
			<th>Bil</th>
			<th>Nama Persatuan</th>
			<th>Tindakan</th>
		</tr>
		<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
				$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['nama_persatuan']; ?></td>
			<td>
				<input type="button" value="Laporan" onclick="window.location.href='persatuan_laporan.php?id=<?php echo $row['id_persatuan']; ?>'">
				<input type="button" value="Kemaskini" onclick="window.location.href='persatuan_kemaskini.php?id=<?php echo $row['id_persatuan']; ?>'">
				<form method="post">
					<input type="hidden" name="id_persatuan" value="<?php echo $row['id_persatuan']; ?>">
					<input type="submit" name="buang_rekod" value="Buang" onclick="return confirm('Adakah anda pasti untuk membuang rekod ini?');">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>