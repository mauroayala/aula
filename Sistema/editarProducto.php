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
            <li class="active"> Editar Producto </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Editar Producto </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["id"])){
				 $id=$_POST["id"];
				 $sql="select * from productos where id_producto='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				
			}
			
			if(isset($_POST["Enviar"])){
				
function filtroInyeccion2($valor){  
 	$valor = str_ireplace("INSERT ","",$valor);	$valor = str_ireplace("INTO ","",$valor);	$valor = str_ireplace("JOIN ","",$valor);	$valor = str_ireplace("WHERE ","",$valor);	$valor = str_ireplace("FROM ","",$valor);	$valor = str_ireplace("SELECT ","",$valor);		$valor = str_ireplace("COPY ","",$valor);	$valor = str_ireplace("DELETE ","",$valor);	$valor = str_ireplace("DROP ","",$valor);		$valor = str_ireplace("DUMP ","",$valor);		$valor = str_ireplace(" OR ","",$valor);		$valor = str_ireplace("%","",$valor);		$valor = str_ireplace("LIKE ","",$valor);		$valor = str_ireplace("--","",$valor);		$valor = str_ireplace("^","",$valor);		$valor = str_ireplace("[","",$valor);		$valor = str_ireplace("]","",$valor);		$valor = str_ireplace("\\","",$valor);		

	$valor = str_ireplace("?","",$valor);		$valor = str_ireplace("=","",$valor);		$valor = str_ireplace("&","",$valor);  		
	return $valor; }
	
				/*
 				$medidas=""; 
				if($_POST['medidas']!=""){
 				$medidas = implode(",",$_POST['medidas']); 
				$medidas=filtroInyeccion($medidas);
				}*/
				
				$medidas=filtroInyeccion($_POST["medidas"]);
				$nombre=filtroInyeccion($_POST["nombre"]);
				$colores=filtroInyeccion($_POST["colores"]);
				$orden=filtroInyeccion($_POST["orden"]);
				$codigo=filtroInyeccion($_POST["codigo"]);
 				$descripcion=$_POST["descripcion"];
 
  				$descripcion=filtroInyeccion2($descripcion);
  				$categoria=filtroInyeccion($_POST["categoria"]);
  				$precio=filtroInyeccion($_POST["precio"]);
  								$intfecha=date("YmdHis");
				$stock=filtroInyeccion($_POST["stock"]);

    			$imagen1=$intfecha.$_FILES['uploadImage1']['name'];
				$imagen2=$intfecha.$_FILES['uploadImage2']['name'];
				$imagen3=$intfecha.$_FILES['uploadImage3']['name'];
				$imagen4=$intfecha.$_FILES['uploadImage4']['name'];
				 				$categoria=filtroInyeccion($_POST["categoria"]);

				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE `productos` SET  `nombre` =  '$nombre',
						`medidas` =  '$medidas',`colores` =  '$colores',`descripcion` =  '$descripcion',
						 `categoria` =  '$categoria', `stock` =  '$stock',`codigo` =  '$codigo',
						`precio` =  '$precio',`orden` =  '$orden'
						WHERE  `id_producto` ='$id' ;";
			 
				 $res=$mysqli->query($sql);

			
				for($cont=1;$cont<=4;$cont++){
				$columna="foto".$cont;

				if($_FILES['uploadImage'.$cont]['name']!=""){
				$nombre=$intfecha.$_FILES['uploadImage'.$cont]['name'];
				
				 $sql="UPDATE `productos` SET $columna='$nombre' where `id_producto` ='$id'";
				 $res=$mysqli->query($sql);
				// echo $sql;
				upload_image('../images/productos','uploadImage'.$cont,$nombre);
				}

				if(isset($_POST['eliminar'.$cont])){ 
				$mysqli->query("UPDATE `productos` SET $columna=null where `id_producto` ='$id'");
				}

				}
				
				
				
				 $sql="select * from productos where id_producto='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				 
				 
				?>
				<div class="callout callout-info">
                    <p>El Producto se modifico Correctamente.</p>
                  </div>
				  
				 
				<?php
				}
				?>
 		 
              <form action="editarProducto.php" method="POST"  enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo $fila["id_producto"];?>" >
     <div class="form-group">
                      <label for="titulo">Código</label>
                      <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $fila["codigo"];?>" placeholder="">
                    </div>


     <div class="form-group">
                      <label for="titulo">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila["nombre"];?>" placeholder="">
                    </div>

		    <div class="form-group" >


                      <label for="titulo">Categoria</label>


                    <SELECT class="form-control" id="categoria" name="categoria"  >    
  <?php                     
  $sql123="select subcategoria.*,categorias.categoria from subcategoria	
  LEFT JOIN categorias ON categorias.id_categoria=subcategoria.id_categoria		
  order by categoria asc";                    
  $res123=$mysqli->query($sql123);                 
  while ($fila123=mysqli_fetch_array($res123)) {   
  $idcategoria= $fila123["id_subcategoria"];
  $categoria= $fila123["categoria"];         
  $subcategoria= $fila123["subcategoria"];   
  ?>                      	
  <OPTION VALUE="<?php echo $idcategoria; ?>"><?php echo $categoria . "/" . $subcategoria; ?></OPTION>    
  <?php                      }                        ?>		
  </SELECT>             
				
                    </div>



	  <div class="form-group">  
	  <label for="titulo">Orden</label>  
		<SELECT class="form-control" id="orden" name="orden"  >
				<?php for($or=1;$or<=30;$or++){ ?>
				<option value="<?php echo $or;?>"><?php echo $or;?></option>	
				<?php  } ?>				
					</SELECT> 

	  </div>	
	  
	  
	  	<script type="text/javascript">
						 document.getElementById("categoria").value="<?php echo $fila['categoria'];?>";
						 document.getElementById("orden").value="<?php echo $fila['orden'];?>";
					</script>
	  

						<div class="form-group">
                      <label for="titulo">Unidad de Medida</label>
					  
 <input type="text" class="form-control" id="medidas" name="medidas"   value="<?php echo $fila["medidas"];?>">                 


				
                    </div>


				   <div class="form-group"> 
	  <label for="titulo">Precio (Para varios precios separar con guion - )</label> 
	  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" value="<?php echo $fila["precio"];?>">                    </div>
	  
					
			       <div class="form-group" style="display:none">
			       	   <label for="titulo">Peso/Paquete</label>

                      <select id="colores" name="colores" class="form-control" >
                      		<option value="KG">KG</option>
                      		<option value="UNIDAD">UNIDAD</option>
                      		<option value="GRAMOS">GRAMOS</option>
                      		<option value="PAQUETE">PAQUETE</option>
                      		<option value="CAJON">CAJON</option>
                      		<option value="BOLSON">BOLSON</option>
                      		<option value="DOCENA">DOCENA</option>
                      		<option value="MAPLE">MAPLE</option>
                      	</select> 
					<script type="text/javascript">
						 document.getElementById("colores").value="<?php echo $fila["colores"];?>";
					</script>


                    
                    </div>
			     
				 

	  
	  
					
	       <div class="form-group">


                      <label for="titulo">¿En Stock?</label>


                      <select class="form-control" id="stock" name="stock"  >
                      	<option value="SI">Si</option>
                      	<option value="NO">No</option>
						</select>

                    </div>

			<script type="text/javascript">
						 document.getElementById("stock").value="<?php echo $fila['stock'];?>";
					</script>
			       <div class="form-group">
                      <label for="titulo">Descripción del Producto</label>
                      <textarea class="form-control" id="descripcion" name="descripcion" style="min-height: 400px;"><?php echo str_ireplace('"',"'",$fila["descripcion"]);?></textarea>
                    </div>
					
		
			
<?php 
					$contador=1;
					$contadorLabel=1;
					for($i=1;$i<=1;$i++){?>
					<table>
					<tr>
					<td><label for="titulo">Imagen <?php echo $contadorLabel;  ?>: </label>
					<?php $columna='foto'.$contador;?>
					<?php if($fila[$columna]){?>
					<br><br><label style="margin-right: 1em;" >Tildar para eliminar<br>
					<input style="margin-left: 45%;"  type="checkbox" name="eliminar<?php echo $contadorLabel;?>"></label>
					<?php } ?>
					<?php $contadorLabel++;?>

					</td>

					<td>
					<?php if($fila[$columna]){?> <img src="../images/productos/<?php echo $fila[$columna];?>" style="width: 200px;"><br><br><?php } ?>
					<input type="file" id="archivo1" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">
					<br></br>
					</td>
					</tr>


					<tr>
					<td><label for="titulo">Imagen <?php echo $contadorLabel;  ?>: </label>
					<?php $columna='foto'.$contador;?>
					<?php if($fila[$columna]){?>
					<br><br><label style="margin-right: 1em;" >Tildar para eliminar<br>
					<input style="margin-left: 45%;"  type="checkbox" name="eliminar<?php echo $contadorLabel;?>"></label>
					<?php } ?>
					<?php $contadorLabel++;?>

					</td>
					<td>
						<?php if($fila[$columna]){?> <img src="../images/productos/<?php echo $fila[$columna];?>" style=" width: 200px;"><br><br><?php } ?>
					<input type="file" id="archivo2" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">
					<br></br></td>
					</tr>

					<tr>
					
					<td><label for="titulo">Imagen <?php echo $contadorLabel;  ?>: </label>
					<?php $columna='foto'.$contador;?>
					<?php if($fila[$columna]){?>
					<br><br><label style="margin-right: 1em;" >Tildar para eliminar<br>
					<input style="margin-left: 45%;"  type="checkbox" name="eliminar<?php echo $contadorLabel;?>"></label>
					<?php } ?>
					<?php $contadorLabel++;?>

					</td>
					<td>
						
					<?php if($fila[$columna]){?> <img src="../images/productos/<?php echo $fila[$columna];?>" style=" width: 200px;"><br><br><?php } ?>
					<input type="file" id="archivo3" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">
					<br></br></td>


					</tr>

					<tr>
					<td><label for="titulo">Imagen <?php echo $contadorLabel;  ?>: </label>
					<?php $columna='foto'.$contador;?>
					<?php if($fila[$columna]){?>
					<br><br><label style="margin-right: 1em;" >Tildar para eliminar<br>
					<input style="margin-left: 45%;"  type="checkbox" name="eliminar<?php echo $contadorLabel;?>"></label>
					<?php } ?>
					<?php $contadorLabel++;?>

					</td>

					<td>
					<?php if($fila[$columna]){?> <img src="../images/productos/<?php echo $fila[$columna];?>" style=" width: 200px;"><br><br><?php } ?>
					<input type="file" id="archivo4" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">
					<br></br></td>

					</tr>
					
				 
					</table>	
				
				<?php } ?>
				
				<br>
			      <p>
 				<button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Editar Producto</button>
				</p>
			  </form>
            
			
			<form action="listadoDeProductos.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $fila["id_producto"];?>" >

			<button type="submit" name="Borrar" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Borrar Producto</button>
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