<?php include 'connection.php'; ?>

<?php 

	$id_persatuan = $_GET['id'];
	
	//kod proses di sini
	if(isset($_POST['hantar'])){
		$namalama_persatuan = $_POST['namalama_persatuan'];
		$nama_persatuan = $_POST['nama_persatuan'];

		//semak daftar persatuan lama & sedia ada
		if($namalama_persatuan != $nama_persatuan) {
			$sql = "SELECT nama_persatuan FROM persatuan WHERE nama_persatuan = " . "'".$nama_persatuan."'";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_execute($stmt); //jalankan semakan rekod
			mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
			if(mysqli_stmt_num_rows($stmt) > 0){
				$mesej = "RALAT: Rekod Persatuan Tersebut Telah Sedia Ada!";
			} else {
				$sql = "UPDATE persatuan SET nama_persatuan='".$nama_persatuan."' WHERE id_persatuan = '".$id_persatuan."'";
				$result = mysqli_query($conn, $sql);

				if($result != false){
					$mesej = "Tahniah! Rekod Persatuan Telah Berjaya Dikemaskini!";
				} else {
					$mesej = "RALAT: Rekod Persatuan Gagal Dikemaskini!";
				}
			}
		} else {
			$mesej = "Tiada Perubahan Rekod Dilakukan.";
		}
	} //Tamat: Kemaskini Rekod Persatuan

	//Dapatkan Maklumat Persatuan
	$sql = "SELECT * FROM persatuan WHERE id_persatuan = '".$id_persatuan."'";
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
	<form method="post">
		<tr>
			<th colspan="2">KEMASKINI REKOD PERSATUAN</th>
		</tr>
		<tr>
			<td>Nama Persatuan</td>
			<input type="hidden" name="namalama_persatuan" value="<?php echo $data['nama_persatuan']; ?>">
			<td><input type="text" name="nama_persatuan" required="" value="<?php echo $data['nama_persatuan']; ?>"></td>
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