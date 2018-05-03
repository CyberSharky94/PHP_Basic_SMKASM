<?php include 'connection.php'; ?>

<?php 

	$id_pelajar = $_GET['id'];
	
	//kod proses di sini
	if(isset($_POST['hantar'])){
		$nama_pelajar = $_POST['nama_pelajar'];
		$nokp_pelajar = $_POST['nokp_pelajar'];
		$nokplama_pelajar = $_POST['nokplama_pelajar'];
		$tlahir_pelajar = $_POST['tlahir_pelajar'];
		$id_persatuan = $_POST['id_persatuan'];

		//semak kp pelajar lama & sedia ada
		if($nokp_pelajar != $nokplama_pelajar) {
			$sql = "SELECT nokp_pelajar FROM pelajar WHERE nokp_pelajar = '".$nokp_pelajar."'";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_execute($stmt); //jalankan semakan rekod
			mysqli_stmt_store_result($stmt); //simpan sementara rekod semak
			if(mysqli_stmt_num_rows($stmt) > 0){
				$mesej = "RALAT: No KP Pelajar Sedia Ada Di Dalam Rekod!";	
				$ralat = true;
			}
		}
		
		if(!isset($ralat)) {
			//proses daftar pelajar sini
			$sql = "UPDATE pelajar SET 
					nama_pelajar='".$nama_pelajar."',
					nokp_pelajar='".$nokp_pelajar."',
					tlahir_pelajar='".$tlahir_pelajar."',
					id_persatuan='".$id_persatuan."' 
					WHERE id_pelajar = '".$id_pelajar."'";
			$result = mysqli_query($conn, $sql);

			if($result == false) {
				$mesej = "RALAT: Rekod Pelajar Tidak Berjaya Dikemaskini!";
			} else {
				$mesej = "Rekod Pelajar Telah Berjaya Dikemaskini!";
			}
		}
	} //TAMAT: Kemaskini Rekod Pelajar

	//Dapatkan Maklumat Pelajar
	$sql = "SELECT * FROM pelajar WHERE id_pelajar = '".$id_pelajar."'";
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
			<th colspan="2">KEMASKINI REKOD PELAJAR</th>
		</tr>
		<tr>
			<td>Nama Pelajar</td>
			<td><input type="text" name="nama_pelajar" required="" value="<?php echo $data['nama_pelajar']; ?>"></td>
		</tr>
		<tr>
			<td>No KP Pelajar</td>
			<input type="hidden" name="nokplama_pelajar" value="<?php echo $data['nokp_pelajar']; ?>">
			<td><input type="text" name="nokp_pelajar" required="" value="<?php echo $data['nokp_pelajar']; ?>"></td>
		</tr>
		<tr>
			<td>Tarikh Lahir Pelajar</td>
			<td><input type="date" name="tlahir_pelajar" required="" value="<?php echo $data['tlahir_pelajar']; ?>"></td>
		</tr>
		<tr>
			<td>Persatuan Pelajar</td>
			<td>
				<?php
				$sql = "SELECT * FROM persatuan";
				$result = mysqli_query($conn, $sql);

				?>
				<select name="id_persatuan" required="">
					<option value="" disabled="">[SILA PILIH PERSATUAN]</option>
					<?php while($row = mysqli_fetch_array($result)) { ?>
	    	  		<option value="<?php echo $row['id_persatuan']; ?>" <?php if($data['id_persatuan'] == $row['id_persatuan']) { echo 'selected'; } ?> ><?php echo $row['nama_persatuan']; ?></option>
			    	<?php } ?>
			    </select>
			</td>
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