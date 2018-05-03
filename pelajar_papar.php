<?php include 'connection.php'; ?>

<?php 

	$id_pelajar = $_GET['id'];

	//Dapatkan Maklumat Pelajar
	$sql = "SELECT * FROM pelajar pl JOIN persatuan pr ON pl.id_persatuan = pr.id_persatuan WHERE pl.id_pelajar = '".$id_pelajar."'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<table border="1">
		<tr>
			<th colspan="2">KEMASKINI REKOD PELAJAR</th>
		</tr>
		<tr>
			<td>Nama Pelajar</td>
			<td><?php echo $data['nama_pelajar']; ?></td>
		</tr>
		<tr>
			<td>No KP Pelajar</td>
			<td><?php echo $data['nokp_pelajar']; ?></td>
		</tr>
		<tr>
			<td>Tarikh Lahir Pelajar</td>
			<td><?php echo $data['tlahir_pelajar']; ?></td>
		</tr>
		<tr>
			<td>Persatuan Pelajar</td>
			<td><?php echo $data['nama_persatuan']; ?></td>
		</tr>
		<tr>
			<td colspan="2"><center><input type="button" value="< KEMBALI" onclick="window.history.back();"></center></td>
		</tr>
	</table>
</body>
</html>