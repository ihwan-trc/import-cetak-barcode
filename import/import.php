<?php
// Load file koneksi.php
include "../config.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		
		$kd_barang = $row['A'];
		$nm_barang = $row['B'];
		$satuan = $row['C'];
		$kategori = $row['D'];
		$supplier = $row['E'];
		$hrg_jual = $row['F'];
		$hrg_beli = $row['G'];

		$kd_toko = 'SS001';
		$stok = '0';
		$stok_min = '0';
		$tgl_perubahan = date('d-m-Y');
		$ket = 'Barang Baru';

		// Cek jika semua data tidak diisi
		if($kd_barang == "" && $nm_barang == "" && $satuan == "" && $kategori == "" && $supplier == "" && $hrg_jual == "" && $hrg_beli == "")
		continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Buat query Insert
			// $barang = "INSERT INTO tabel_barang VALUES('".$kd_barang."','".$nm_barang."','".$satuan."','".$kategori."','".$supplier."','".$hrg_jual."','".$hrg_beli."')";
			// $query = mysqli_query($connect,$barang);

			 $result = mysqli_query($mysqli, "INSERT INTO tabel_barang
			 	(kd_barang,nm_barang,satuan,hrg_beli,hrg_jual,kategori,supplier)
			 	VALUES
			 	('$kd_barang','$nm_barang','$satuan','$hrg_beli','$hrg_jual','$kategori','$supplier')");


		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: ../index.php'); // Redirect ke halaman awal
?>
