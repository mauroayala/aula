<?php require_once('menu.php');?>   
      <!-- DataTables -->      <!-- Content Wrapper. Contains page content --> 
	  <div class="content-wrapper">        <!-- Content Header (Page header) -->  
      <section class="content-header">          <h1>            Home            <small>Panel de Control</small>          </h1>          <ol class="breadcrumb">         
	  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>            <li class="active"> Alta de Producto </li>          </ol>        </section>        <!-- Main content -->        <section class="content">          		  <div class="box box-primary">           
	  <div class="box-header">              <h3 class="box-title"><i class="fa fa-tag"></i> Alta de Producto </h3>            </div>            <div class="box-body">		



	  <?php 	

function filtroInyeccion2($valor){  
 	$valor = str_ireplace("INSERT ","",$valor);	$valor = str_ireplace("INTO ","",$valor);	$valor = str_ireplace("JOIN ","",$valor);	$valor = str_ireplace("WHERE ","",$valor);	$valor = str_ireplace("FROM ","",$valor);	$valor = str_ireplace("SELECT ","",$valor);		$valor = str_ireplace("COPY ","",$valor);	$valor = str_ireplace("DELETE ","",$valor);	$valor = str_ireplace("DROP ","",$valor);		$valor = str_ireplace("DUMP ","",$valor);		$valor = str_ireplace(" OR ","",$valor);		$valor = str_ireplace("%","",$valor);		$valor = str_ireplace("LIKE ","",$valor);		$valor = str_ireplace("--","",$valor);		$valor = str_ireplace("^","",$valor);		$valor = str_ireplace("[","",$valor);		$valor = str_ireplace("]","",$valor);		$valor = str_ireplace("\\","",$valor);		

	$valor = str_ireplace("?","",$valor);		$valor = str_ireplace("=","",$valor);		$valor = str_ireplace("&","",$valor);  		
	return $valor; }
	
	  if(isset($_POST["Enviar"])){		
 /*
   $medidas=""; 			
   if($_POST['medidas']!=""){ 	
   $medidas = implode(",",$_POST['medidas']); 	
   $medidas=filtroInyeccion($medidas);			
   }	
   
   */
	  $medidas=filtroInyeccion($_POST["medidas"]); 			
	  $codigo=filtroInyeccion($_POST["codigo"]); 			
	  $orden=filtroInyeccion($_POST["orden"]); 			
	  $colores=filtroInyeccion($_POST["colores"]); 			
	  $precio=filtroInyeccion($_POST["precio"]);			
	  $nombre=filtroInyeccion($_POST["nombre"]);			
	  $stock=filtroInyeccion($_POST["stock"]);				
	  $descripcion=filtroInyeccion2($_POST["descripcion"]);	
	  $categoria=filtroInyeccion($_POST["categoria"]);		
	  $imagen1="";				$imagen2="";				
	  $imagen3="";				$imagen4="";			
	  $intfecha=date("YmdHis");				
	  $image1Verificar=filtroInyeccion($_FILES['uploadImage1']['name']);		
	  if($image1Verificar!=""){  			
	  $imagen1=$intfecha.$image1Verificar;		
	  }				
	  $image2Verificar=filtroInyeccion($_FILES['uploadImage2']['name']);
	  if($image2Verificar!=""){  	
	  $imagen2=$intfecha.$image2Verificar;
	  }			
	  $image3erificar=filtroInyeccion($_FILES['uploadImage3']['name']);			
	  if($image3erificar!=""){  		
	  $imagen3=$intfecha.$image3erificar;	
	  } 			
	  $image4erificar=filtroInyeccion($_FILES['uploadImage4']['name']);		
	  if($image4erificar!=""){  
	  $imagen4=$intfecha.$image4erificar;	
	  }  /*nuevo cambio traido de tesoros*/ 
	  $sql="INSERT INTO `productos` (`id_producto`, `nombre`, `medidas`, `precio`, `estado`, 
	  `foto1`, `colores`, `foto2`, `foto3`, `foto4`, `foto5`, `descripcion`,`categoria`,`stock`,`codigo`,`orden`)	
	  VALUES (NULL, '$nombre', '$medidas', '$precio', '1', '$imagen1', '$colores', '$imagen2',
	  '$imagen3', '$imagen4', '', '$descripcion','$categoria','$stock','$codigo','$orden');";						

	  $res=$mysqli->query($sql);		
	  for($cont=1;$cont<=3;$cont++){	
	  if($_FILES['uploadImage'.$cont]['name']!=""){		
	  $nombre=$intfecha.$_FILES['uploadImage'.$cont]['name'];	
	  upload_image('../images/productos','uploadImage'.$cont,$nombre);	
	  }				} 			
	  ?> 				
	  
	  <div class="callout callout-info">              
      <p>El Producto se cargo Correctamente.</p>                  </div>			

	  <?php				}				?> 		             

	  <form action="altaDeProducto.php" method="POST"  enctype="multipart/form-data" >		
	  <div class="form-group">                  
	  <label for="titulo">Código</label>   
	  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo">   
	  </div>


	  <div class="form-group">                  
	  <label for="titulo">Nombre</label>   
	  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">   
	  </div>

	  
	  <div class="form-group" >                      
	  <label for="titulo">Categoria</label>                   
  <SELECT class="form-control" id="categoria" name="categoria"  >    
  <?php                     
  $sql="select subcategoria.*,categorias.categoria from subcategoria	
  LEFT JOIN categorias ON categorias.id_categoria=subcategoria.id_categoria		
  order by categoria asc";                    
  $res=$mysqli->query($sql);                 
  while ($fila=mysqli_fetch_array($res)) {   
  $idcategoria= $fila["id_subcategoria"];
  $categoria= $fila["categoria"];         
  $subcategoria= $fila["subcategoria"];   
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



	  <div class="form-group">  
	  <label for="titulo">Unidad de Medida</label>  
	<input type="text" class="form-control" id="medidas" name="medidas" placeholder="Unidad">  
			 <!-- 		<SELECT class="form-control" id="medidas" name="medidas[]"  multiple style=" min-height: 150px;">
					<option value="">Sin Peso</option>	 
					<option id="900ml" value="900ml">900ml</option>		 				
					<option id="1 Unidad" value="1 Unidad">1 Unidad</option>		 				
					<option id="2KG" value="2KG">2KG</option>	
					<option id="1.5KG" value="1.5KG">1.5KG</option>	 				
					<option id="1KG" value="1KG">1KG</option>		 				
					<option id="1/2 kilo" value="1/2 kilo">1/2 kilo</option>		 				
					<option id="1/4 kilo" value="1/4 kilo">1/4 kilo</option>	 
					<option id="1/2 HORMA" value="1/2 HORMA">1/2 HORMA</option>		  
					<option id="HORMA ENTERA" value="HORMA ENTERA">HORMA ENTERA</option>		  
					</SELECT>  -->  

	  </div>	

	  <div class="form-group"> 
	  <label for="titulo">Precio (Para varios precios separar con guion - )</label> 
	  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">                    </div>

	  
	  <div class="form-group" style="display:none">               
	  <label for="titulo">Peso/Paquete</label>   
	  <select id="colores" name="colores" class="form-control">   
	  <option value="KG">KG</option>   
	  <option value="UNIDAD">UNIDAD</option>       
	  <option value="GRAMOS">GRAMOS</option>      
	  <option value="PAQUETE">PAQUETE</option>                      		
	  <option value="CAJON">CAJON</option>
	  <option value="BOLSON">BOLSON</option>
	  <option value="DOCENA">DOCENA</option>
	  <option value="MAPLE">MAPLE</option>   
	  </select>                 
	  </div>  			      
			

	  <div class="form-group">     
	  <label for="titulo">¿En Stock?</label>  
	  <select class="form-control" id="stock" name="stock"  >    
	  <option value="SI">Si</option>   
	  <option value="NO">No</option>	
	  </select>                 
	  </div>			   
	  <div class="form-group">   
	  <label for="titulo">Descripción del Producto</label> 
	  <textarea class="form-control" id="cuerpo" name="descripcion" style="min-height: 400px;"></textarea>                
	  </div>			
	  <?php 			
	  $contador=1;		
	  $contadorLabel=1;	
	  for($i=1;$i<=1;$i++){?>
	  <table>				
	  <tr>					
	  <td><label for="titulo">Imagen <?php echo $contadorLabel; $contadorLabel++;?></label></td>	
	  <td><input type="file" id="archivo1" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">					
	  <br></br>				
	  </td>				
	  </tr>			
	  <tr>				
	  <td><label for="titulo">Imagen <?php echo $contadorLabel; $contadorLabel++;?></label></td>					
	  <td><input type="file" id="archivo2" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">		
	  <br></br></td>		
	  </tr>				
	  <tr>				
	  <td><label for="titulo">Imagen <?php echo $contadorLabel; $contadorLabel++;?></label></td>						
	  <td><input type="file" id="archivo3" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">	
	  <br></br></td>			
	  </tr>			
	  <tr>			
	  <td><label for="titulo">Imagen <?php echo $contadorLabel; $contadorLabel++;?></label></td>	<td><input type="file" id="archivo4" class="input-file" accept="image/*" name="uploadImage<?php echo $contador; $contador++;?>" class="form-control">			
	  <br></br></td>			
	  </tr>	 					
	  
	  </table>					
	  <?php } ?>			
	  <br></br>		
	  <p> 				
	  <button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Crear Producto</button>
	  </p>			 
	  </form>             
	  </div><!-- /.box-body --> 
	  </div>		  		    
	  </section><!-- /.content -->  
	  </div><!-- /.content-wrapper --> 
	  <?php include("pie.php");?>    <!-- DataTables -->
	  <script src="plugins/datatables/jquery.dataTables.min.js"></script>    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>		  <script>      $(function () {        $("#example1").DataTable();        $('#example2').DataTable({          "paging": true,          "lengthChange": false,          "searching": false,          "ordering": true,          "info": true,          "autoWidth": false        });      });    </script>