<?php include('menu.php');
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');
?>   

         <!-- DataTables -->

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Home

            <small>Panel de Control</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="ion-search"></i> Home</a></li>

            <li class="active"> Alta del Listado</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Producto  </h3>

            </div>

            <div class="box-body">
              <div class="col-md-6">
          <form action="altaDeListado.php" method="POST" enctype="multipart/form-data" >
              <div class="form-group">
                    <label>Adjunto</label>
                    <div class="input-group">
            
                      <input type="file" name="adjunto" class="form-control pull-right"  >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

        <div class="form-group">
          <button type="submit" name="Actualizar" class="btn btn-success" value="Actualizar"> Actualizar</button>
        </div>
          </form>
          <a href="descargar.php" target="_blank" class="btn btn-warning">Descargar</a>
          </div>

			<?php 

			if(isset($_POST["Actualizar"])){

          if($_FILES["adjunto"]["tmp_name"]==""){
            echo "Debe seleccionar un archivo";
          }else{
       $intfecha=date("Y-m-d H:i:s");
		$adjunto=$_FILES["adjunto"]["tmp_name"];

        $name=filtroInyeccion($_FILES["adjunto"]["name"]);
 		  $tipo    = $_FILES["adjunto"]["type"];
		 $nombre  = $_FILES["adjunto"]["name"];
		 $titulo  = $_POST["adjunto"];

			$tamanio = $_FILES["adjunto"]["size"];
    $fp = fopen($adjunto, "rb");
    $contenido = fread($fp, $tamanio);
    $contenido = addslashes($contenido);
    fclose($fp); 
	
  $sql="update excel set contenido='$contenido'  , nombre='$name' , fecha='$intfecha',tipo='$tipo' where id_excel='1' ";

	

     //   $sql="update excel set contenido='".mysql_real_escape_string($adjunto)."'  , nombre='$name' , fecha='$intfecha',tipo='$tipo' where id_excel='1' ";
        $res=$mysqli->query($sql) or die(mysqli_error());
     //  $mysqli->query($sql) or die(mysql_error());

        echo "Se actualizado el listado de mayoristas correctamente";

        }
       


        }



        ?>
              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- DataTables -->
 