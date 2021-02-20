<?php
include_once("config.php");

        if(isset($_POST['tampil'])){
            if(empty($_POST['checkbox_list'])){
                echo"Pilih dong ...";
            }
            else{
                echo "Anda memilih;<br/><br/>"; 
                foreach($_POST['checkbox_list'] as $item){  
                    
                  $id = $item;
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
                      echo $kd_barang ."<br/>";
                      echo $nm_barang ."<br/>";
                      echo $hrg_jual ."<br/>";
                }
            }
        }
    ?>

    
<!-- <!DOCTYPE html>
<html>
<head>
  <title>Cetak Barcode</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
 -->
<!-- <div class="header">
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
 </div> -->

<!-- <br>
<table  > -->
      <!-- <?php
      $kolom = 6;    
      $i=1;       
      $result=mysqli_query($mysqli,"SELECT * FROM tabel_barang");
      while ($data=mysqli_fetch_array($result)) {
        $kd_barang = $data['kd_barang'];
        $nm_barang =$data['nm_barang'];
        $satuan = $data['satuan'];
        $hrg_beli = $data['hrg_beli'];
        $hrg_jual = $data['hrg_jual'];
        $kategori = $data['kategori'];
        $supplier = $data['supplier'];
        if(($i) % $kolom== 1) {    
        echo'<tr bgcolor="#42f584">';     
        }  ?> -->
        <!-- <td colspan="2" width="230">
        <center><b><?php echo $nm_barang; ?></b></center>
     
        <font size="6"> <center><b>Rp <?php echo number_format($hrg_jual, 0, ',', '.') ?>  
        </b> </center></font>
        
        <center> <img alt="<?php echo $kd_barang; ?>" src="<?php echo "barcode.php?size=30&text=$kd_barang"; ?>" /> </center>
        <center><b><?php echo $kd_barang; ?></b> </center>

         <font color="red">Al-Khaibar : <?php echo date('d.m.Y'); ?></font>
        </td> -->
        <!-- <?php
        if(($i) % $kolom== 0) {    
        echo'</tr>';        
        }
      $i++;
      }
      ?> -->
    <!-- </table>
<br/>
<button><a href="#" onclick="window.print()"> PRINT </a></button>
<button><a href="index.php"> BACK </a></button> -->

<!-- <?php
      $kolom = 6;    
      $i=1;       
      $result=mysqli_query($mysqli,"SELECT * FROM tabel_barang");
      while ($data=mysqli_fetch_array($result)) {
        $kd_barang = $data['kd_barang'];
        $nm_barang =$data['nm_barang'];
        $satuan = $data['satuan'];
        $hrg_beli = $data['hrg_beli'];
        $hrg_jual = $data['hrg_jual'];
        $kategori = $data['kategori'];
        $supplier = $data['supplier'];
        if(($i) % $kolom== 1) {   
echo '<table border="5" bgcolor="#42f584">';
  }  ?>
<tr>
        <td colspan="2" width="230">
        <center><b><?php echo $nm_barang; ?></b></center>
     
        <font size="6"> <center><b>Rp <?php echo number_format($hrg_jual, 0, ',', '.') ?>  
        </b> </center></font>
        
        <center> <img alt="<?php echo $kd_barang; ?>" src="<?php echo "barcode.php?size=30&text=$kd_barang"; ?>" /> </center>
        <center><b><?php echo $kd_barang; ?></b> </center>

         <font color="red">Al-Khaibar : <?php echo date('d.m.Y'); ?></font>
        </td> 
      <?php
        if(($i) % $kolom== 0) {
     echo'</table>';
      }
      $i++;
      }
      ?> -->
<!-- 
</body>
</html> -->