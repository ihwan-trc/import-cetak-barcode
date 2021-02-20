<?php 
//dengan print text
//echo "barcode.php?text=$_GET[text]&print=true";

//Tanpa Print text
//echo "barcode.php?text=$_GET[text]";

$qty       = $_GET['qty'];
$desc       = $_GET['desc'];
$serial       = $_GET['serial'];
?>

<!DOCTYPE html>
<html>
<head>    
  <title>Beranda</title>
</head>
<body>


 
<br />

<table border="2">
<tr>
  <td colspan="2" width="230">
    <center><b><?php echo $desc ?> </b></center>

  <font size="6"> <center><b>Rp <?php echo number_format($qty, 0, ',', '.') ?>  
    </b> </center></font>

    <center> <img alt="<? $_GET['serial'];?>" src="<?php echo "barcode.php?size=30&text=$serial"; ?>" /> </center>
    <center><b><?php echo $serial; ?></b> </center>

    Al-Khaibar : <?php echo date('d.m.Y'); ?>
 </td>
</tr>
</table>
<br/>
<button><a href="#" onclick="window.print()"> PRINT </a></button>
<button><a href="manual.php"> BACK </a></button>
</body>
</html>