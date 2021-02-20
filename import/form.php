<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Load File bootstrap.min.css yang ada difolder css -->
		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
<div class="header">
  <div class="container">
   <div class="navbar">
    <div class="brand">
     <h1>AlkhaibarCode</h1>
    </div>

    <div class="menu">
     <nav class="nav">
      <a id="toggle" href="#">Menu</a>
      <ul id="dropdown">
       <li><a href="../index.php">Beranda</a></li>
       <li><a href="../add.php">Tambah Produk</a></li>
       <li><a href="../cetaksemua.php">Cetak Barcode</a></li>
       <li><a href="../manual.php">Manual</a></li>
      </ul>
     </nav>

     <div class="">
      <p><a style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="form.php">Import</a>
        <a style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="#">Export</a></p>
     </div>
    </div>
   </div>
  </div>
 </div>

		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="../index.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>

			<h3>Form Import Data</h3>
			<hr>

			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="Format.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>

				<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>

			<hr>

			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
				$tmp_file = $_FILES['file']['tmp_name'];

				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($ext == "xlsx"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";

					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='7' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>kd_barang</th>
						<th>nm_barang</th>
						<th>satuan</th>
						<th>kategori</th>
						<th>supplier</th>
						<th>hrg_jual</th>
						<th>hrg_beli</th>
					</tr>";

					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						$kd_barang = $row['A'];
						$nm_barang = $row['B'];
						$satuan = $row['C'];
						$kategori = $row['D'];
						$supplier = $row['E'];
						$hrg_jual = $row['F'];
						$hrg_beli = $row['G'];

						// Cek jika semua data tidak diisi
						if($kd_barang == "" && $nm_barang == "" && $satuan == "" && $kategori == "" && $supplier == "" && $hrg_jual == "" && $hrg_beli == "")
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$kd_barang_td = ( ! empty($kd_barang))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$nm_barang_td = ( ! empty($nm_barang))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$satuan_td = ( ! empty($satuan))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$kategori_td = ( ! empty($kategori))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$supplier_td = ( ! empty($supplier))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$hrg_jual_td = ( ! empty($hrg_jual))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$hrg_beli_td = ( ! empty($hrg_beli))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							
							// Jika salah satu data ada yang kosong
							if($kd_barang == "" or $nm_barang == "" or $satuan == "" or $kategori == "" or $supplier == "" or $hrg_jual == "" or $hrg_beli == ""){
								$kosong++; // Tambah 1 variabel $kosong
							}

							echo "<tr>";
							echo "<td".$kd_barang_td.">".$kd_barang."</td>";
							echo "<td".$nm_barang_td.">".$nm_barang."</td>";
							echo "<td".$satuan_td.">".$satuan."</td>";
							echo "<td".$kategori_td.">".$kategori."</td>";
							echo "<td".$supplier_td.">".$supplier."</td>";
							echo "<td".$hrg_jual_td.">".$hrg_jual."</td>";
							echo "<td".$hrg_beli_td.">".$hrg_beli."</td>";
							echo "</tr>";
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>
