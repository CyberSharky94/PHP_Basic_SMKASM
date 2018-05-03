<?php include 'connection.php'; ?>

<?php 
	
	//kod proses di sini
	if(isset($_POST['hantar'])){
		$nama_persatuan = $_POST['nama_persatuan'];

		//semak daftar persatuan
		$sql = "SELECT nama_persatuan FROM persatuan WHERE nama_persatuan = " . "'".$nama_persatuan."'";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_execute($stmt); //jalankan semakan rekod
		mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
		if(mysqli_stmt_num_rows($stmt) > 0){
			$mesej = "RALAT: Rekod Persatuan Tersebut Telah Sedia Ada!";
		} else {
			$sql = "INSERT INTO persatuan(nama_persatuan) VALUES ('$nama_persatuan')";
			$result = mysqli_query($conn, $sql);

			if($result != false){
				$mesej = "Tahniah! Rekod Persatuan Telah Berjaya Didaftarkan!";
			} else {
				$mesej = "RALAT: Rekod Persatuan Gagal Didaftarkan!";
			}
		}
	}
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
	<form method="post">
		<tr>
			<th colspan="2">TAMBAH REKOD PERSATUAN</th>
		</tr>
		<tr>
			<td>Nama Persatuan</td>
			<td><input type="text" name="nama_persatuan"></td>
		</tr>
		<tr>
			<td colspan="2"><center>
				<input type="submit" name="hantar" value="Hantar">
				<input type="reset" value="Set Semula">
			</center></td>
		</tr>
	</form>
	</table>
</body>
</html>