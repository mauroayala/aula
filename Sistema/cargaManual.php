<?php include('menu.php');?> 

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Home

            <small>Panel de Control</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"> Carga Manual </li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Carga Manual </h3>

            </div>
 	<style>	  
		  .box-body {
    overflow: scroll;
	}
	</style>
            <div class="box-body">

				<?php 	
				$cantidadPersonas=10;
				
				if(isset($_POST["Enviar"])){  
	  $fecha=filtroInyeccion($_POST["fecha"]); 			
	  $hora=filtroInyeccion($_POST["hora"]); 			
	  $excursion=filtroInyeccion($_POST["excursion"]); 			
	  $barco_hotel=filtroInyeccion($_POST["barco"]); 			
	  $costo=filtroInyeccion($_POST["costo"]); 			
	  
	  $sumarCostos=0;
	  $cont=0;
	  for($i=1;$i<=$cantidadPersonas;$i++){
		  
	  $nombre=filtroInyeccion($_POST["nombre$i"]); 			
	  $telefono=filtroInyeccion($_POST["telefono$i"]); 			
	  $email=filtroInyeccion($_POST["email$i"]); 			
	  $reserva=filtroInyeccion($_POST["reserva$i"]); 			
	  $idioma=filtroInyeccion($_POST["idioma$i"]); 			
	  $requerimientos=filtroInyeccion($_POST["requerimientos$i"]); 			
	  $fechareserva=filtroInyeccion($_POST["fechareserva$i"]); 			
	  $guia=filtroInyeccion($_POST["guia$i"]); 			
	  $bus=filtroInyeccion($_POST["bus$i"]); 			 
	  $down_payment=filtroInyeccion($_POST["down_payment$i"]); 			 
	  $amount_due=filtroInyeccion($_POST["amount_due$i"]);
	  $cantidad=filtroInyeccion($_POST["cantidad$i"]);
	 
	  
		if($nombre!="" && $telefono!="" && $email!="" && $reserva!="" && $idioma!="" && $requerimientos!="" && $fechareserva!="" && $down_payment!="" && $amount_due!="" && $bus!="" && $guia!="" && $cantidad!="" ){
			$cont=$cont+$cantidad;
			$sumarCostos=$sumarCostos+$amount_due+$down_payment;

		}		
		}
	
	if($cont>0 && $hora!=""&& $fecha!=""&& $excursion!=""&& $barco_hotel!=""){
	
	              /*
				  $queryVerifico = "select * from `viaje`
  				    where excursion='$excursion'
					and fecha='$fecha' and hora='$hora' and estado='1' ";
                    
 					$resultadosVerifico = mysqli_query($mysqli, $queryVerifico);
					$rowsVerifico=mysqli_num_rows($resultadosVerifico);
					if($rowsVerifico>0){
						
					$filaVerifico=mysqli_fetch_array($resultadosVerifico);
					$id_viaje=$filaVerifico["id_viaje"];		
					}else{
							*/
					$query = "INSERT INTO `viaje` (`id_viaje`, `excursion`, `fecha`, `hora`, `barco_hotel`, `estado`, `cantidad`,`total_price_with_discount`)
				    VALUES ('', '$excursion', '$fecha', '$hora', '$barco_hotel', '1','$cont','$sumarCostos')";
                    
 					$resultados = mysqli_query($mysqli, $query);
					$id_viaje=$mysqli->insert_id;
	
					//} me parece que no tengo que verificar, directamente grabo los viajes, por que en cada viaje hay diferentes personas`
					// 1 excursion tiene varios viajes , y un viaje varias personas`

	 for($i=1;$i<=$cantidadPersonas;$i++){
	
					
	  $nombre=filtroInyeccion($_POST["nombre$i"]); 			
	  $telefono=filtroInyeccion($_POST["telefono$i"]); 			
	  $email=filtroInyeccion($_POST["email$i"]); 			
	  $reserva=filtroInyeccion($_POST["reserva$i"]); 			
	  $idioma=filtroInyeccion($_POST["idioma$i"]); 			
	  $requerimientos=filtroInyeccion($_POST["requerimientos$i"]); 			
	  $fechareserva=filtroInyeccion($_POST["fechareserva$i"]); 			
	  $guia=filtroInyeccion($_POST["guia$i"]); 			
	  $bus=filtroInyeccion($_POST["bus$i"]); 			 
	  $down_payment=filtroInyeccion($_POST["down_payment$i"]); 			 
	  $amount_due=filtroInyeccion($_POST["amount_due$i"]); 	
	  $cantidad=filtroInyeccion($_POST["cantidad$i"]);

		 
		 		if($nombre!="" && $telefono!="" && $email!="" && $reserva!="" && $idioma!="" && $requerimientos!="" && $fechareserva!="" && $down_payment!="" && $amount_due!="" && $bus!="" && $guia!="" ){
		 
	  
	  
	  
	               $query = "INSERT INTO `personas` (`id_persona`, `id_viaje`, `nombre`, `telefono`, `email`, `reserva`, `idiomas`, `requerimientos`, `fechareserva`, `guia`, `bus`, `estado`, `down_payment`, `amount_due`, `cantidad`) 
				   VALUES ('', '$id_viaje', '$nombre', '$telefono', '$email', '$reserva', '$idioma', '$requerimientos', '$fechareserva', '$guia', '$bus', '1', '$down_payment', '$amount_due','$cantidad')";
                    
					$resultados = mysqli_query($mysqli, $query);
			  }		
	  }
	  
	  
	  

	  
	  ?> 				
	  
	  <div class="callout callout-info">              
      <p>Se cargo Correctamente.</p>     
	  </div>			

	  <?php	
	  

	
	}else{
		
		  
	  ?> 				
	  
	  <div class="callout callout-info">              
      <p>Debe completar todos los datos.</p>     
	  </div>			

	  <?php	
	  	
		
	}
	
	
	}
				
				?>
				
				
				 		


			
          <form action="cargaManual.php" method="POST" style="    width: 1500px;">
              <div class="col-md-6" style="    width: 200px;">


				<div class="form-group">  
                      <label for="titulo">Fecha:</label> 
                      <input type="date" class="form-control" id="fecha" name="fecha" > 
                    </div>
					
				<div class="form-group">  
                      <label for="titulo">Hora:</label> 
                      <input type="time" class="form-control" id="hora" name="hora" > 
                    </div>
					
              </div>
		

		<div class="col-md-6">

            <div class="col-md-12">
               <div class="form-group" > 
                      <label for="titulo">Excursion</label> 
                      <SELECT class="form-control" id="excursion" name="excursion"  >
                       <option value=""></option>           
					   <?php 
                      $sqlc="select product_title as excursion from excursiones 
					    where product_title!='5-Hour National Park + City Tour *Shore Excursion* USHUAIA ( Shared tour )'";
                      $resc=$mysqli->query($sqlc);
                      while ($filac=mysqli_fetch_array($resc)) {
                        $excursion= $filac["excursion"];
                    ?>
                        <OPTION VALUE="<?php echo $excursion; ?>"><?php echo $excursion; ?></OPTION>
                      
                      <?php
                      }
                        ?>
                      </SELECT>
                  </div>
    </div>

<div class="col-md-6">
          <div class="form-group" > 
                      <label for="titulo">Barco / Hotel</label> 
					<input type="text" class="form-control" id="barco" name="barco" > 

                  </div>    </div>
<div class="col-md-6">
          <div class="form-group"  style="display:none;"> 
                      <label for="titulo">Costo</label> 
					<input type="text" class="form-control" id="costo" name="costo" > 

                  </div>    </div>
				  
				  
             
      </div>
	  
	  

		  
		  
 

              <div class="col-md-12" style="clear: both;"></div>



<table id="example" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Cant.</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Reserva</th>
                        <th>Idioma</th>
                        <th>Requerimientos</th>
                        <th>Fecha Reserva</th>
                        <th>Guia</th>
                        <th>Bus</th> 
                        <th>Down Payment</th>
                        <th>Amount Due</th> 
                      </tr>

                    </thead>

                    <tbody>

					<?php 
					$totalPax=0;
					$total_price_with_discount=0;
					
					for($i=1;$i<=$cantidadPersonas;$i++){

					?>

                      <tr>
 
						<td><input type="number" class="form-control" id="cantidad<?php echo $i;?>" name="cantidad<?php echo $i;?>"  placeholder ="Cantidad" >  </td>
						<td><input type="text" class="form-control" id="nombre<?php echo $i;?>" name="nombre<?php echo $i;?>"  placeholder ="Nombre" >  </td>
						<td><input type="text" class="form-control" id="telefono<?php echo $i;?>" name="telefono<?php echo $i;?>"  placeholder ="Telefono" >  </td>
						<td><input type="text" class="form-control" id="email<?php echo $i;?>" name="email<?php echo $i;?>"  placeholder ="Email" >  </td>
						<td><input type="text" class="form-control" id="reserva<?php echo $i;?>" name="reserva<?php echo $i;?>"  placeholder ="Reserva" >  </td>
						<td><input type="text" class="form-control" id="idioma<?php echo $i;?>" name="idioma<?php echo $i;?>"  placeholder ="Idioma" >  </td>
						<td><input type="text" class="form-control" id="requerimientos<?php echo $i;?>" name="requerimientos<?php echo $i;?>"  placeholder ="Requerimientos" >  </td>
						<td><input type="date" class="form-control" id="fechareserva<?php echo $i;?>" name="fechareserva<?php echo $i;?>"   >  </td>
						<td><input type="text" class="form-control" id="guia<?php echo $i;?>" name="guia<?php echo $i;?>"  placeholder ="Guia">  </td>
						<td><input type="text" class="form-control" id="bus<?php echo $i;?>" name="bus<?php echo $i;?>"  placeholder ="Bus" >  </td>
						<td><input type="text" class="form-control" id="down_payment<?php echo $i;?>" name="down_payment<?php echo $i;?>"  placeholder ="down_payment" >  </td>
						<td><input type="text" class="form-control" id="amount_due<?php echo $i;?>" name="amount_due<?php echo $i;?>"  placeholder ="amount_due" >  </td>
  
                      </tr>
					<?php
					} 
					?>
                    </tfoot>

                  </table>

                

	  		<div class="col-md-12">
	  
     
        <div class="form-group">
          <button type="submit" name="Enviar" class="btn btn-success" value="Enviar"> Cargar</button>
        </div>
		
		</div>
		
          </form>
    
		  
		  
		  
              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

      
