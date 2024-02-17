<?php 
session_start(); 
include("../conectar.php"); 
        $sql="select * from  excel  where id_excel='1' ";
        $res=$mysqli->query($sql);
        $fila=mysqli_fetch_array($res);
        $nombre=$fila["nombre"];
        $tipo=$fila["tipo"];
        $tipo=$fila["tipo"];
        $content=$fila["contenido"];
		//$contenido=file_get_contents($fila["contenido"]); 
        //echo  $nombre; 
     //   header("Content-type : $tipo");
 header("Content-type: $tipo");
header("Content-Disposition: attachment; filename=$nombre");
 
echo $content;
mysqli_close($connection);
exit; ?>