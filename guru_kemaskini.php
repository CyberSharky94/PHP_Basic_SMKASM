<?php include 'connection.php'; ?>

<?php 

	$id_guru = $_GET['id'];
	
	//kod proses di sini
	if(isset($_POST['hantar'])){
		$nama_guru = $_POST['nama_guru'];
		
		$nokplama_guru = $_POST['nokplama_guru'];
		$nokp_guru = $_POST['nokp_guru'];

		$namagunalama_guru = $_POST['namagunalama_guru'];
		$namaguna_guru = $_POST['namaguna_guru'];

		$katalaluan_guru = $_POST['katalaluan_guru'];
		$sahkatalaluan_guru = $_POST['sahkatalaluan_guru'];

		$id_persatuan = $_POST['id_persatuan'];

		if($katalaluan_guru!="" && $katalaluan_guru != $sahkatalaluan_guru){
			$mesej = "RALAT: Kata Laluan Guru tidak sama!";
			$ralat = true;
		}
			

		if(!isset($ralat))
		{
			//semak nama pengguna guru lama & sedia ada
			if($namagunalama_guru != $namaguna_guru) {
				$sql = "SELECT namaguna_guru FROM guru WHERE namaguna_guru = '".$namaguna_guru."'";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_execute($stmt); //jalankan semakan rekod
				mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
				if(mysqli_stmt_num_rows($stmt) > 0){
					$mesej = "RALAT: Nama Pengguna Guru Sedia Ada Di Dalam Rekod!";
					$ralat = true;
				}
			}
		}
			
		if(!isset($ralat))
		{
			//semak kp guru lama & sedia ada
			if($nokplama_guru != $nokp_guru) {
				$sql = "SELECT nokp_guru FROM guru WHERE nokp_guru = '".$nokp_guru."'";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_execute($stmt); //jalankan semakan rekod
				mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
				if(mysqli_stmt_num_rows($stmt) > 0){
					$mesej = "RALAT: No KP Guru Sedia Ada Di Dalam Rekod!";
					$ralat = true;
				}
			}
		}

		if(!isset($ralat))
		{
			//proses kemaskini guru sini
			if($katalaluan_guru != "")
			{
				$sql = "UPDATE guru SET 
					nama_guru='".$nama_guru."',
					nokp_guru='".$nokp_guru."',
					namaguna_guru='".$namaguna_guru."',
					katalaluan_guru='".$katalaluan_guru."',
					id_persatuan='".$id_persatuan."' 
					WHERE id_guru = '".$id_guru."'";
			} else {
				$sql = "UPDATE guru SET 
					nama_guru='".$nama_guru."',
					nokp_guru='".$nokp_guru."',
					namaguna_guru='".$namaguna_guru."',
					id_persatuan='".$id_persatuan."' 
					WHERE id_guru = '".$id_guru."'";
			}

			
			$result = mysqli_query($conn, $sql);

			if($result == false) {
				$mesej = "RALAT: Rekod Guru Tidak Berjaya Dikemaskini!";
			} else {
				$mesej = "Rekod Guru Telah Berjaya Dikemaskini!";
			}
		}
			 
	} //TAMAT: Kemaskini Rekod Guru

	//Dapatkan Maklumat Guru
	$sql = "SELECT * FROM guru WHERE id_guru = '".$id_guru."'";
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
			<th colspan="2">KEMASKINI REKOD GURU</th>
		</tr>
		<tr>
			<td>Nama Guru</td>
			<td><input type="text" name="nama_guru" required="" value="<?php echo $data['nama_guru']; ?>"></td>
		</tr>
		<tr>
			<td>No KP Guru</td>
			<input type="hidden" name="nokplama_guru" value="<?php echo $data['nokp_guru']; ?>">
			<td><input type="text" name="nokp_guru" required="" value="<?php echo $data['nokp_guru']; ?>"></td>
		</tr>
		<tr>
			<td>Persatuan Guru</td>
			<td>
				<?php
				$sql = "SELECT * FROM persatuan";
				$result = mysqli_query($conn, $sql);

				?>
				<select name="id_persatuan" required="">
					<option value="" disabled="">[SILA PILIH PERSATUAN]</option>
					<?php while($row = mysqli_fetch_array($result)) { ?>
	    	  		<option value="<?php echo $row['id_persatuan']; ?>" <?php if($data['id_persatuan'] == $row['id_persatuan']) { echo 'selected'; } ?>><?php echo $row['nama_persatuan']; ?></option>
			    	<?php } ?>
			    </select>
			</td>
		</tr>
		<tr>
			<td>Nama Pengguna</td>
			<input type="hidden" name="namagunalama_guru" value="<?php echo $data['namaguna_guru']; ?>">
			<td><input type="text" name="namaguna_guru" required="" value="<?php echo $data['namaguna_guru']; ?>"></td>
		</tr>
		<tr>
			<td colspan="2"><i>Isi Untuk Tukar Kata Laluan</i></td>
		</tr>
		<tr>
			<td>Katalaluan Guru</td>
			<td><input type="text" name="katalaluan_guru"></td>
		</tr>
		<tr>
			<td>Sahkan Katalaluan Guru</td>
			<td><input type="text" name="sahkatalaluan_guru"></td>
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