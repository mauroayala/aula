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
            <li class="active"> Editar Usuario </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Editar Usuario </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["id_usuario"])){
				 $id=$_POST["id_usuario"];
				 $sql="select * from usuariositumanda where id='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				
			}
			
			if(isset($_POST["Enviar"])){
				$email=filtroInyeccion($_POST["email"]);
				$nombre=filtroInyeccion($_POST["nombre"]);
				$empresa=filtroInyeccion($_POST["empresa"]);
				$localidad=filtroInyeccion($_POST["localidad"]);
				$direccion=filtroInyeccion($_POST["direccion"]);
				$telefono=filtroInyeccion($_POST["telefono"]);
				$apellido=$_POST["apellido"];
				$apellido=$_POST["apellido"];
				$pass=md5(filtroInyeccion($_POST["pass"])); 
				$passHidden=$_POST["passHidden"];
				$id=filtroInyeccion($_POST["id"]);

				if($passHidden!=$_POST["pass"]){
						$sql="UPDATE `usuariositumanda` SET  
						`pass` =  '$pass' WHERE `id` ='$id' ;";
				
				 $res=$mysqli->query($sql);
				}
				$sql="UPDATE `usuariositumanda` SET  `nombre` =  '$nombre',
						`apellido` =  '$apellido',
						`email` =  '$email',
						`empresa` =  '$empresa',
						`telefono` =  '$telefono',
						`usuario` =  '$email',
						`direccion` =  '$direccion',
						`localidad` =  '$localidad'
						 WHERE `id` ='$id' ;";
				
				 $res=$mysqli->query($sql);

				 $sql="select * from usuariositumanda where id='$id' ";
				 $res=$mysqli->query($sql);
				 $fila=mysqli_fetch_array($res);
				 
		 
				?>
				<div class="callout callout-info">
                    <p>El Usuario se modifico Correctamente.</p>
                  </div>
				<?
				}
				?>
 		 
              <form action="editarUsuario.php" method="POST"  enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo $fila["id"];?>" >
			    <input type="hidden"  name="passHidden" value="<?php echo $fila["pass"];?>">

			       <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila["nombre"];?>" placeholder="nombre">
                    </div>
			       <div class="form-group">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $fila["apellido"];?>"placeholder="apellido">
                    </div>
			 
					<div class="form-group">
                      <label for="titulo">Teléfono</label>
                      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $fila["telefono"];?>" placeholder="telefono">
                    </div>
			 	 

                    <div class="form-group">
                      <label for="titulo">Empresa</label>
                      <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $fila["empresa"];?>" placeholder="Empresa">
                    </div>
			 	 

                    <div class="form-group">
                      <label for="titulo">Localidad</label>
                      <input type="text" class="form-control" id="localidad" name="localidad" value="<?php echo $fila["localidad"];?>" placeholder="localidad">
                    </div>
			 	 

                <div class="form-group">
                      <label for="titulo">Direccion</label>
                      <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $fila["direccion"];?>" placeholder="direccion">
                    </div>
			 	 

				 <div class="form-group">
                      <label for="titulo">Email</label>
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $fila["email"];?>" placeholder="Email">
                    </div>
			 	 

					<div class="form-group">
                      <label for="pass">Contraseña</label>
                      <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $fila["pass"];?>" placeholder="pass">
                    </div> 				
			      <p>
 				<button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Editar Usuario</button>
				</p>
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