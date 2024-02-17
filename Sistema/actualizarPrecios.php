<?php include('menu.php');?>

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

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"> Actualizar Precios </li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Actualizar</h3>

            </div>

            <div class="box-body">

			<?php 

			if(isset($_POST["Enviar"])){

				$estado=filtroInyeccion($_POST["estado"]);

				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE productos set estado='$estado'  where id_producto='$id' ";

 				$res=$mysqli->query($sql);

				?>

				<div class="callout callout-info">

                    <p>La modificacion se realizo Correctamente.</p>

                  </div>

				<?php

				}

				?>

				

						<?php 

			if(isset($_POST["Borrar"])){

				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE productos set estado='3'  where id_producto='$id' ";

 				$res=$mysqli->query($sql);

				?>

				<div class="callout callout-danger">

                    <p>El Producto se borro Correctamente.</p>

                  </div>

				<?php

				}

				

							if(isset($_GET["mensaje"])){

				?>	

				<div class="callout callout-info">

                    <p>El Producto se cargo Correctamente.</p>

                  </div>

				<?php

				}

				?>

				
<!--
              <div class="col-md-6">
          <form action="actualizarPrecios.php" method="POST">


             <div class="form-group">  
                      <label for="titulo">Nombre</label> 
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"> 
                    </div>

                 <div class="form-group"> 
                      <label for="titulo">¿En Stock?</label> 
                      <select class="form-control" id="stock" name="stock"  >
                        <option value=""></option>
                        <option value="SI">Si</option>
                        <option value="NO">No</option>
                         </select> 
                    </div>

                 <div class="form-group"> 
                      <label for="titulo">Estado</label> 
                      <select class="form-control" id="estado" name="estado"  > 
                        <option value="1">Publicado</option>
                        <option value="2">Despublicado</option>
                         </select> 
                    </div>


               <div class="form-group" > 
                      <label for="titulo">Categoria</label> 
                      <SELECT class="form-control" id="categoria" name="categoria"  >
                       <option value=""></option>            <?php 
                      $sqlc="select * from categorias order by categoria asc";
                      $resc=$mysqli->query($sqlc);
                      while ($filac=mysqli_fetch_array($resc)) {
                        $idcategoriac= $filac["id_categoria"];
                        $categoriac= $filac["categoria"];
                    ?>
                        <OPTION VALUE="<?php echo $idcategoriac; ?>"><?php echo $categoriac; ?></OPTION>
                      
                      <?php
                      }
                        ?>
                      </SELECT>
                  </div>


        <div class="form-group">
          <button type="submit" name="Buscar" class="btn btn-success" value="Buscar"><i class="fa fa-fw fa-search"></i> Buscar</button>
        </div>
          </form>
          </div>-->

              <div class="col-md-12" style="clear: both;"></div>
			  <style>
			    .actualizar  {
     top: 225px;
     height: 50px;
    padding: 2px;
    position: fixed;
    right: 15px;
    text-align: center;
    text-decoration: none;
    width: 150px;
    z-index: 99999
}</style>
<?php 
if (isset($_POST["Actualizar"])) {
		$intfecha=date("YmdHis");
$sql1="select * from productos where  estado='1'  ";

$res1=$mysqli->query($sql1);

while($fila1=mysqli_fetch_array($res1)){
	$idProducto=$fila1["id_producto"];
//	$idProducto=filtroInyeccion($_POST["id$idProducto"]);
	$precio=filtroInyeccion($_POST["precio$idProducto"]);
	$nombre=filtroInyeccion($_POST["nombre$idProducto"]);
	$descripcion=filtroInyeccion($_POST["descripcion$idProducto"]);
	$stock=filtroInyeccion($_POST["stock$idProducto"]);
	
//	echo "precio$idProducto<br>";
	$sql="UPDATE productos set precio='$precio',nombre='$nombre',descripcion='$descripcion',stock='$stock' where id_producto='$idProducto' ";
	//echo $sql ."<br>";
	$res=$mysqli->query($sql);

				if($_FILES['foto'.$idProducto]['name']!=""){
				$nombre=$intfecha.$_FILES['foto'.$idProducto]['name'];
				
				 $sql="UPDATE `productos` SET foto1='$nombre' where `id_producto` ='$idProducto'";
				 $res=$mysqli->query($sql);
				// echo $sql;
				upload_image('../images/productos','foto'.$idProducto,$nombre);
				}

		



}



}
//if (isset($_POST["Buscar"])) {

/*        $categoria=filtroInyeccion($_POST["categoria"]);
        $stock=filtroInyeccion($_POST["stock"]);
        $nombre=filtroInyeccion($_POST["nombre"]);
        $estado=filtroInyeccion($_POST["estado"]);
$and="";

if($estado!=""){
  $and.=" and estado='$estado' " ;
}

if($stock!=""){
  $and.=" and stock='$stock' " ;
}
if($nombre!=""){
  $and.=" and UPPER(nombre) like '%$nombre%' " ;
}

if($categoria!=""){
  $and.=" and categoria='$categoria' " ;
}*/
$sql="select * from productos where  estado='1'  order by nombre asc ";
$res=$mysqli->query($sql);

?><form action="actualizarPrecios.php" method="POST" enctype="multipart/form-data" >
			<table id="" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Nombre</th>

                        <th>Unidad/Botella</th>

                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>Stock</th>

                        <th>Foto</th>

 
                      </tr>

                    </thead>

                    <tbody>

					<?php 
					while($fila=mysqli_fetch_array($res)){

					?>

                      <tr>

                        <td><?php echo $fila["nombre"];?>
						<input type="text" name="nombre<?php echo $fila["id_producto"];?>" value="<?php echo $fila["nombre"];?>"></td>

                        <td> <?php echo $fila["medidas"];?></td>

                        <td><input type="text" name="precio<?php echo $fila["id_producto"];?>" value="<?php echo $fila["precio"];?>"></td>
                        <td><textarea name="descripcion<?php echo $fila["id_producto"];?>"><?php echo $fila["descripcion"];?></textarea></td>
						<td>
						
						  <select class="form-control"  style="    width: 65px;"id="stock<?php echo $fila["id_producto"];?>" name="stock<?php echo $fila["id_producto"];?>"  >
                      	<option value="SI">Si</option>
                      	<option value="NO">No</option>
						</select>

        

			<script type="text/javascript">
						 document.getElementById('stock<?php echo $fila["id_producto"];?>').value="<?php echo $fila['stock'];?>";
					</script>
					
					</td>
                        <td>
						     <img src="../images/productos/<?php echo $fila["foto1"];?>" style="    WIDTH: 100PX;">
							 <input type="file" name="foto<?php echo $fila["id_producto"];?>" id="foto<?php echo $fila["id_producto"];?>">
					</td>


                      </tr>

					  <?php

						}

					  ?>

                    </tfoot>

                  </table>
        <input type="submit" value="Actualizar" name="Actualizar" class="btn btn-primary actualizar">         
</form>
              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- DataTables -->

	<script src="plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

	

	  <script>

      $(function () {

        $("#example1").DataTable();

        $('#example2').DataTable({

          "paging": true,

          "lengthChange": false,

          "searching": false,

          "ordering": true,

          "info": true,

          "autoWidth": false

        });

      });

    </script>