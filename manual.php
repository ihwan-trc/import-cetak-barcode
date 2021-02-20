<!DOCTYPE html>
<html>
<head>    
  <title>Beranda</title>
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
 
<h1>Masukkan Data Barang</h1>

<form action="result.php" method="get" name="barcode-form">
	<table>

		<tr>
			<td>Nama Barang</td>
			<td>:<input type="text" id="text" name="desc" /></td>
		</tr>

		<tr>
			<td>Harga</td>
			<td>:<input type="text" id="text" name="qty" /></td>
		</tr>

		<tr>
			<td>Kode Barang</td>
			<td>:<input type="text" id="text" name="serial" /></td>
		</tr>

		<tr>
			<td></td>
			<td>&nbsp;&nbsp;<input type="submit" name="barcode-button" value="Cetak" /></td>
		</tr>

	</table>
</form>
</body>

</html>

