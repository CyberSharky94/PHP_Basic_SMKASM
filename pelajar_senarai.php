<?php include 'connection.php'; ?>

<?php 

	//kod proses di sini
	if(isset($_POST['buang_rekod'])){
		$id_pelajar = $_POST['id_pelajar'];

		$sql = "DELETE FROM pelajar WHERE id_pelajar = '".$id_pelajar."'";
		$result = mysqli_query($conn, $sql);

		if($result == false){
			$mesej = "RALAT: Rekod Pelajar Gagal Dibuang!";
		} else {
			$mesej = "Rekod Pelajar Telah Berjaya Dibuang!";
		}
	}

	$sql = "SELECT * FROM pelajar pl JOIN persatuan pr ON pl.id_persatuan = pr.id_persatuan";
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
			<th>Nama</th>
			<th>No KP</th>
			<th>Tarikh Lahir</th>
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
			<td><?php echo $row['nama_pelajar']; ?></td>
			<td><?php echo $row['nokp_pelajar']; ?></td>
			<td><?php echo $row['tlahir_pelajar']; ?></td>
			<td><?php echo $row['nama_persatuan']; ?></td>
			<td>
				<input type="button" value="Papar" onclick="window.location.href='pelajar_papar.php?id=<?php echo $row['id_pelajar']; ?>'">
				<input type="button" value="Kemaskini" onclick="window.location.href='pelajar_kemaskini.php?id=<?php echo $row['id_pelajar']; ?>'">
				<form method="post">
					<input type="hidden" name="id_pelajar" value="<?php echo $row['id_pelajar']; ?>">
					<input type="submit" name="buang_rekod" value="Buang" onclick="return confirm('Adakah anda pasti untuk membuang rekod ini?');">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>