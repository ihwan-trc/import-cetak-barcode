<?php
// Create database connection using config file
include_once("config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM tabel_barang");
?>

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
     <h1>AlkhaibarCode</h1>
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


    <div class="left">
      <form action="cari.php" method="get" onsubmit="return validasi_input(this)">
        <label>&nbsp;</label>
        <input type="text" name="cari" placeholder="Masukkan Keyword">
        <input type="submit" value="Cari">   
      </form>
    </div>
    <div class="right">
         <input class="right" type="submit" name="" value="Cetak Barcode">
    </div>


<form method="POST" action="cetaksemua.php">

    <table border=1 class="table">
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>satuan</th>
        <th>HPP</th>
        <th>Harga Jual</th>
        <th>kategori</th>
        <th>supplier</th>
        <th>Aksi</th>
        <th><input type="checkbox" onchange="checkAll(this)"></th>
    </tr>
    <?php  
      $page = (isset($_GET['page']))? $_GET['page'] : 1;
      $limit = 10; 
      $limit_start = ($page - 1) * $limit;
      $no = $limit_start + 1;
      $query = "SELECT * FROM tabel_barang ORDER BY kd_barang ASC LIMIT $limit_start, $limit";
      $dewan1 = $mysqli->prepare($query);
      $dewan1->execute();
      $res1 = $dewan1->get_result();
      while ($user_data = $res1->fetch_assoc()) {
             
        echo "<tr>";
        echo "<td><center>".$no."</center></td>";
        echo "<td>".$user_data['kd_barang']."</td>";
        echo "<td>".$user_data['nm_barang']."</td>";
        echo "<td>".$user_data['satuan']."</td>";
        echo "<td>".$user_data['hrg_beli']."</td>";
        echo "<td>".$user_data['hrg_jual']."</td>";
        echo "<td>".$user_data['kategori']."</td>";
        echo "<td>".$user_data['supplier']."</td>";   
        echo "<td>
                  <center>
                        <a href='edit.php?id=$user_data[id]'>Edit</a> |
                        <a href='delete.php?id=$user_data[id]'>Delete</a> |
                        <a href='cetak.php?id=$user_data[id]'>Cetak</a>
                  </center>
              </td>";
        echo "<td>
                  <center>
                      <input type='checkbox' name='checkbox_list[]' alt='checkbox' value='$user_data[id]'/>

                  </center>
              </td>"; ?>
        </tr>
        <?php 
        $no++; // Tambah 1 setiap kali looping      
    } 
    ?>
    </table>
    <input type="submit" name="tampil" value="Submit" style="float: right; margin-top: 10px;"/>

</form>

<?php
  $query_jumlah = "SELECT count(*) AS jumlah FROM tabel_barang";
  $dewan1 = $mysqli->prepare($query_jumlah);
  $dewan1->execute();
  $res1 = $dewan1->get_result();
  $row = $res1->fetch_assoc();
  $total_records = $row['jumlah'];
?>

<nav>
  <ul class="pagination justify-content-end">
    <?php
      $jumlah_page = ceil($total_records / $limit);
      $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
      
      if($page == 1){
        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      } else {
        $link_prev = ($page > 1)? $page - 1 : 1;
        echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
        echo '<li class="page-item"><a class="page-link" href="?page='.$link_prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
      }
 
      for($i = $start_number; $i <= $end_number; $i++){
        $link_active = ($page == $i)? ' active' : '';
        echo '<li class="page-item '.$link_active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
      }
 
      if($page == $jumlah_page){
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        echo '<li class="page-item"><a class="page-link">Total Baris :'.$total_records.'</li>';
      } else {
        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
        echo '<li class="page-item"><a class="page-link" href="?page='.$link_next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item"><a class="page-link" href="?page='.$jumlah_page.'">Last</a></li>';
        echo '<li class="page-item"><a class="page-link">Total Baris :'.$total_records.'</li>';
      }
    ?>
  </ul>
</nav>

<script type="text/javascript">
  function checkAll(box) 
  {
   let checkboxes = document.getElementsByTagName('input');

   if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'checkbox') {
      checkboxes[i].checked = true;
     }
    }
   } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'checkbox') {
      checkboxes[i].checked = false;
     }
    }
   }
  }
</script>

</body>
</html>