<?php
// include database connection file
include_once("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];
    $kd_barang = $_POST['kd_barang'];
    $nm_barang = $_POST['nm_barang'];
    $satuan = $_POST['satuan'];
    $hrg_beli = $_POST['hrg_beli'];
    $hrg_jual = $_POST['hrg_jual'];
    $kategori = $_POST['kategori'];
    $supplier = $_POST['supplier'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE tabel_barang SET kd_barang='$kd_barang',nm_barang='$nm_barang',satuan='$satuan',hrg_beli='$hrg_beli',hrg_jual='$hrg_jual',kategori='$kategori',supplier='$supplier' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
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
<html>
<head>  
    <title>Edit Barang</title>
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
</br>
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Kode Barang</td>
                <td><input type="text" name="kd_barang" value="<?php echo $kd_barang;?>"></td>
            </tr>
            <tr> 
                <td>Nama Barang</td>
                <td><input type="text" name="nm_barang" value="<?php echo $nm_barang;?>"></td>
            </tr>
            <tr> 
                <td>satuan</td>
                <td><input type="text" name="satuan" value="<?php echo $satuan;?>"></td>
            </tr>
            <tr> 
                <td>hrg_beli</td>
                <td><input type="text" name="hrg_beli" value="<?php echo $hrg_beli;?>"></td>
            </tr>
            <tr> 
                <td>Harga Jual</td>
                <td><input type="text" name="hrg_jual" value="<?php echo $hrg_jual;?>"></td>
            </tr>
            <tr> 
                <td>kategori</td>
                <td><input type="text" name="kategori" value="<?php echo $kategori;?>"></td>
            </tr>
            
            <tr> 
                <td>supplier</td>
                <td><input type="text" name="supplier" value="<?php echo $supplier;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Simpan">
                    <button><a href="index.php">Batal</a></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>