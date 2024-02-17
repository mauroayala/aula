<? include('menu.php');?>
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
            <li class="active"> Editar Banner </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Editar Publicidad </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["id"])){
				 $id=$_POST["id"];
				 $sql="select * from publicidades where id_publicidad='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				
			}
			
			if(isset($_POST["Enviar"])){
				$titulo=filtroInyeccion($_POST["titulo"]);
				$link=$_POST["link"];
				$fecha=filtroInyeccion($_POST["fecha"]);
				$cuerpo=$_POST["cuerpo"];
				$orden=$_POST["orden"];
				$email=filtroInyeccion($_POST["email"]);
				$telefono=filtroInyeccion($_POST["telefono"]);
				$id_categoria=filtroInyeccion($_POST["id_categoria"]);
				$imagen=$_FILES['uploadImage']['name'];
				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE `publicidades` SET  `titulo` =  '$titulo',
						`cuerpo` =  '$cuerpo',
						`fecha` =  '$fecha',
						`email` =  '$email',
						`telefono` =  '$telefono',`id_categoria`='$id_categoria',`orden`='$orden',
						`link` =  '$link' WHERE `id_publicidad` ='$id' ;";
				
				 $res=$mysqli->query($sql);

				 $sql="select * from publicidades where id_publicidad='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				 
				if($imagen!=""){
				upload_image('../imagenesPublicidad','uploadImage',$id.".jpg");
				}
				?>
				<div class="callout callout-info">
                    <p>El Clasificado se modifico Correctamente.</p>
                  </div>
				<?
				}
				?>
 		 
              <form action="editarPublicidad.php" method="POST"  enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo $fila["id_publicidad"];?>" >

			       <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $fila["titulo"];?>" placeholder="Titulo">
                    </div>
						  <div class="form-group">  
	  <label for="titulo">Orden</label>  
		<SELECT class="form-control" id="orden" name="orden"  >
				<?php for($or=1;$or<=30;$or++){ ?>
				<option value="<?php echo $or;?>"><?php echo $or;?></option>	
				<?php  } ?>				
					</SELECT> 

	  </div>
	  
					
						<div class="form-group">
                      <label for="titulo">Categoria</label>
                      <select class="form-control" id="id_categoria" name="id_categoria">
					  <option value="0">Promo Banner Home</option>
					  <option value="3">Promo Banner Home CELULAR</option>
					  <option value="1">Promo Pie Productos</option>
					  </select>
                    </div>
					
					
						<script type="text/javascript">
						 document.getElementById("id_categoria").value="<?php echo $fila['id_categoria'];?>";
						 document.getElementById("orden").value="<?php echo $fila['orden'];?>";
					</script>
			       <div class="form-group" style="display:none">
                      <label for="titulo">Fecha</label>
                      <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fila["fecha"];?>"placeholder="">
                    </div>
			      <div class="form-group">
                      <label for="titulo">Link</label>
                      <input type="text" class="form-control" id="link" name="link" value="<?php echo $fila["link"];?>" placeholder="">
                    </div>
			       <div class="form-group" style="display:none">
                       <input type="hidden" class="form-control" id="telefono" name="telefono" value="<?php echo $fila["telefono"];?>"placeholder="Telefono">
                    </div>
					<div class="form-group" style="display:none">
                       <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $fila["email"];?>" placeholder="Email">
                    </div>
			 
			       <div class="form-group"   >
                      <label for="titulo">Segunda Linea</label>
                      <input type="text" class="form-control" id="cuerpo" name="cuerpo"  value="<?php echo $fila["cuerpo"];?>">
                    </div>
					
					<div class="form-group">
                      <label for="titulo">Imagen</label>
					  <input type="file" id="archivo" class="input-file" accept="image/*" name="uploadImage" class="form-control"> 
					  <img src="../imagenesPublicidad/<?php echo $fila["id_publicidad"];?>.jpg" style="max-height: 200px;margin: 10px;"></div>
					

										
										
			      <p>
 				<button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Editar Banner</button>
				</p>
			  </form>
            
			
			<form action="listadoDePublicidades.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $fila["id_publicidad"];?>" >

			<button type="submit" name="Borrar" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Borrar Banner</button>
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