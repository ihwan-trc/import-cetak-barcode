<?php
// Create database connection using config file
include_once("config.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>cari</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

 <div class="header">
  <div class="container">
   <div class="navbar">
    <div class="brand">
     <h1><a href="#">AlkhaibarCode</a></h1>
    </div>

    <div class="menu">
     <nav class="nav">
      <a id="toggle" href="#">Menu</a>
      <ul id="dropdown">
       <li><a href="index.php">Beranda</a></li>
       <li><a href="add.php">Tambah Produk</a></li>
       <li><a href="cetaksemua.php">Cetak Barcode</a></li>
       <li><a href="manual.php">Manual</a></li>
      </ul>
     </nav>

     <div class="">
      <p><a style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="import/form.php">Import</a>
        <a style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="#">Export</a></p>
     </div>
    </div>
   </div>
  </div>
 </div>
 
<br />
<script type="text/javascript">
function validasi_input(form){
  if (form.cari.value == ""){
    alert("Keyword masih kosong!");
    form.cari.focus();
    return (false);
  }
return (true);
}
</script>

<form action="cari.php" method="get" onsubmit="return validasi_input(this)">
    <label>&nbsp;</label>
    <input type="text" name="cari" placeholder="Masukkan Keyword">
    <input type="submit" value="Cari">
</form>
 
<?php 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
 
?>

	<?php 
	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$data = mysqli_query($mysqli,"select * from tabel_barang where kd_barang like '%".$cari."%' OR nm_barang like '%".$cari."%'");				
	}else{
		$data = mysqli_query($mysqli,"select * from tabel_barang");		
	}
	
	?>
<table width='100%' border=1>
 <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Kategori</th>
        <th>Supplier</th>
        <th>Aksi</th>
    </tr>
    <?php  
    $no = 1;
    while($user_data = mysqli_fetch_array($data)) {         
        echo "<tr>";
        echo "<td><center>".$no."</center></td>";
        echo "<td>".$user_data['kd_barang']."</td>";
        echo "<td>".$user_data['nm_barang']."</td>";
        echo "<td>".$user_data['satuan']."</td>";
        echo "<td>".$user_data['hrg_beli']."</td>";
        echo "<td>".$user_data['hrg_jual']."</td>";
        echo "<td>".$user_data['kategori']."</td>";
        echo "<td>".$user_data['supplier']."</td>";   
        echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a> | <a href='cetak.php?id=$user_data[id]'>Cetak</a></td></tr>";  
        $no++; // Tambah 1 setiap kali looping      
    }
    ?>
</table>
</body>
</html>