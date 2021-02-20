<?php 
include_once("config.php");
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM tabel_barang WHERE id=$id");

while($user_data = mysqli_fetch_array($result))
{
    $kd_barang = $user_data['kd_barang'];
    $nm_barang =$user_data['nm_barang'];
    $satuan = $user_data['satuan'];
    $hrg_beli = $user_data['hrg_beli'];
    $hrg_jual = $user_data['hrg_jual'];
    $kategori = $user_data['kategori'];
    $supplier = $user_data['supplier'];
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkbox Cetak</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>



<br>
<table border="2">
<tr>
    <td colspan="2" width="230">
        <center><b><?php echo $nm_barang; ?></b></center>
     
    <font size="6"> <center><b>Rp <?php echo number_format($hrg_jual, 0, ',', '.') ?>  
    </b> </center></font>
        
        <center> <img alt="<?php echo $kd_barang; ?>" src="<?php echo "barcode.php?size=30&text=$kd_barang"; ?>" /> </center>
        <center><b><?php echo $kd_barang; ?></b> </center>

         Al-Khaibar : <?php echo date('d.m.Y'); ?>
    </td>
</tr>
</table>
<br/>
<button><a href="#" onclick="window.print()"> PRINT </a></button>
<button><a href="index.php"> BACK </a></button>
</body>
</html>