<?php include 'connection.php'; ?>

<?php 
	
	//kod proses di sini
	if(isset($_POST['buang_rekod'])){
		$id_guru = $_POST['id_guru'];

		$sql = "DELETE FROM guru WHERE id_guru = '".$id_guru."'";
		$result = mysqli_query($conn, $sql);

		if($result == false){
			$mesej = "RALAT: Rekod Guru Gagal Dibuang!";
		} else {
			$mesej = "Rekod Guru Telah Berjaya Dibuang!";
		}
	}

	$sql = "SELECT * FROM guru g JOIN persatuan p ON g.id_persatuan = p.id_persatuan";
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
			<th>Nama Pengguna</th>
			<th>Nama</th>
			<th>No KP</th>
			<th>Persatuan</th>
			<th>Tindakan</th>
		</tr>
		<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
				$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['namaguna_guru']; ?></td>
			<td><?php echo $row['nama_guru']; ?></td>
			<td><?php echo $row['nokp_guru']; ?></td>
			<td><?php echo $row['nama_persatuan']; ?></td>
			<td>
				<input type="button" value="Papar" onclick="window.location.href='guru_papar.php?id=<?php echo $row['id_guru']; ?>'">
				<input type="button" value="Kemaskini" onclick="window.location.href='guru_kemaskini.php?id=<?php echo $row['id_guru']; ?>'">
				<form method="post">
					<input type="hidden" name="id_guru" value="<?php echo $row['id_guru']; ?>">
					<input type="submit" name="buang_rekod" value="Buang" onclick="return confirm('Adakah anda pasti untuk membuang rekod ini?');">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>