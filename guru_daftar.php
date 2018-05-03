<?php include 'connection.php'; ?>

<?php 
	
	//kod proses di sini
	if(isset($_POST['hantar'])){
		$nama_guru = $_POST['nama_guru'];
		$nokp_guru = $_POST['nokp_guru'];
		$namaguna_guru = $_POST['namaguna_guru'];
		$katalaluan_guru = $_POST['katalaluan_guru'];
		$sahkatalaluan_guru = $_POST['sahkatalaluan_guru'];
		$id_persatuan = $_POST['id_persatuan'];

		if($katalaluan_guru != $sahkatalaluan_guru){
			$mesej = "RALAT: Kata Laluan Guru tidak sama!";
		} else {
			//semak nama pengguna guru
			$sql = "SELECT namaguna_guru FROM guru WHERE namaguna_guru = '".$namaguna_guru."'";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_execute($stmt); //jalankan semakan rekod
			mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
			if(mysqli_stmt_num_rows($stmt) > 0){
				$mesej = "RALAT: Nama Pengguna Guru Sedia Ada Di Dalam Rekod!";
			} else {

				//semak kp guru
				$sql = "SELECT nokp_guru FROM guru WHERE nokp_guru = '".$nokp_guru."'";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_execute($stmt); //jalankan semakan rekod
				mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
				if(mysqli_stmt_num_rows($stmt) > 0){
					$mesej = "RALAT: No KP Guru Sedia Ada Di Dalam Rekod!";
				} else {

					//proses daftar guru sini
					$sql = "INSERT INTO guru(nama_guru, nokp_guru, namaguna_guru, katalaluan_guru, id_persatuan) VALUES ('".$nama_guru."', '".$nokp_guru."', '".$namaguna_guru."', '".$katalaluan_guru."', '".$id_persatuan."')";
					$result = mysqli_query($conn, $sql);

					if($result == false) {
						$mesej = "RALAT: Rekod Guru Tidak Berjaya Didaftarkan!";
					} else {
						$mesej = "Rekod Guru Telah Berjaya Didaftarkan!";
					}
				}
			}
		}
	} //TAMAT: Rekod Guru

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
			<th colspan="2">TAMBAH REKOD GURU</th>
		</tr>
		<tr>
			<td>Nama Guru</td>
			<td><input type="text" name="nama_guru" required=""></td>
		</tr>
		<tr>
			<td>No KP Guru</td>
			<td><input type="text" name="nokp_guru" required=""></td>
		</tr>
		<tr>
			<td>Persatuan Guru</td>
			<td>
				<?php
				$sql = "SELECT * FROM persatuan";
				$result = mysqli_query($conn, $sql);

				?>
				<select name="id_persatuan" required="">
					<option value="" selected="" disabled="">[SILA PILIH PERSATUAN]</option>
					<?php while($row = mysqli_fetch_array($result)) { ?>
	    	  		<option value="<?php echo $row['id_persatuan']; ?>"><?php echo $row['nama_persatuan']; ?></option>
			    	<?php } ?>
			    </select>
			</td>
		</tr>
		<tr>
			<td>Nama Pengguna</td>
			<td><input type="text" name="namaguna_guru" required=""></td>
		</tr>
		<tr>
			<td>Katalaluan Guru</td>
			<td><input type="text" name="katalaluan_guru" required=""></td>
		</tr>
		<tr>
			<td>Sahkan Katalaluan Guru</td>
			<td><input type="text" name="sahkatalaluan_guru" required=""></td>
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