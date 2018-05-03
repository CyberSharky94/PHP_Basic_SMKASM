<?php include 'connection.php'; ?>

<?php 

	$id_guru = $_GET['id'];
	
	//Dapatkan Maklumat Guru
	$sql = "SELECT * FROM guru g JOIN persatuan p ON g.id_persatuan = p.id_persatuan WHERE g.id_guru = '".$id_guru."'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);
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
			<th colspan="2">BUTIRAN REKOD GURU</th>
		</tr>
		<tr>
			<td>Nama Guru</td>
			<td><?php echo $data['nama_guru']; ?></td>
		</tr>
		<tr>
			<td>No KP Guru</td>
			<td><?php echo $data['nokp_guru']; ?></td>
		</tr>
		<tr>
			<td>Persatuan Guru</td>
			<td><?php echo $data['nama_persatuan']; ?></td>
		</tr>
		<tr>
			<td>Nama Pengguna</td>
			<td><?php echo $data['namaguna_guru']; ?></td>
		</tr>
		<tr>
			<td colspan="2"><center><input type="button" value="< KEMBALI" onclick="window.history.back();"></center></td>
		</tr>
	</table>
</body>
</html>