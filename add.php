<html>
<head>
    <title>Tambah Barang</title>
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

    <br/><br/>

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Kode Barang</td>
                <td><input type="text" name="kd_barang"></td>
            </tr>
            <tr> 
                <td>Nama Barang</td>
                <td><input type="text" name="nm_barang"></td>
            </tr>
            <tr> 
                <td>satuan</td>
                <td><input type="text" name="satuan"></td>
            </tr>
            <tr> 
                <td>Harga Beli</td>
                <td><input type="text" name="hrg_beli"></td>
            </tr>
            <tr> 
                <td>Harga Jual</td>
                <td><input type="text" name="hrg_jual"></td>
            </tr>
            <tr> 
                <td>kategori</td>
                <td><input type="text" name="kategori"></td>
            </tr>
            <tr> 
            <tr> 
                <td>supplier</td>
                <td><input type="text" name="supplier"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $kd_barang = $_POST['kd_barang'];
        $nm_barang = $_POST['nm_barang'];
        $satuan = $_POST['satuan'];
        $hrg_beli = $_POST['hrg_beli'];
        $hrg_jual = $_POST['hrg_jual'];
        $kategori = $_POST['kategori'];
        $supplier = $_POST['supplier'];

        // include database connection file
        include_once("config.php");

        // Insert barang data into table
        $result = mysqli_query($mysqli, "INSERT INTO tabel_barang(kd_barang,nm_barang,satuan,hrg_beli,hrg_jual,kategori,supplier) VALUES('$kd_barang','$nm_barang','$satuan','$hrg_beli','$hrg_jual','$kategori','$supplier')");

        // Show message when user added
        echo "Barang Berhasil ditambahkan. <a href='index.php'>View Users</a>";
    }
    ?>
</body>
</html>