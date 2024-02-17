<?php include('menu.php');?>

 

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

            <li class="active"> Listado General Agrupado</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Listado General Agrupado</h3>

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

				
<?php 

        $fecha="";
        $excursion=""; 
        $desde=""; 
        $hasta=""; 
		$parque=12;
		$excel="SUMA";
		
if (isset($_POST["Buscar"])) {

        $fecha=filtroInyeccion($_POST["fecha"]);
        $excursion=filtroInyeccion($_POST["excursion"]); 
        $desde=filtroInyeccion($_POST["desde"]); 
        $hasta=filtroInyeccion($_POST["hasta"]); 
        $parque=filtroInyeccion($_POST["parque"]); 
        $excel=filtroInyeccion($_POST["excel"]); 
		
$and="";


if($fecha!=""){
  $and.=" and start_date='$fecha' " ;
}


if($desde!=""){
  $and.=" and start_date>='$desde' " ;
}


if($hasta!=""){
  $and.=" and start_date<='$hasta' " ;
}



if($excursion!=""){
  $and.=" and product_title='$excursion' " ;
}
 
$sql="select * from informe where  estado='1' $and 

and product_title!='5-Hour Nat Park + City Tour *Shore Excursion* USHUAIA (Shared tour for cruises)'
and product_title!='Punta Tombo Shore Excursion (Shared tour for cruises) - PUERTO MADRYN'

order by start_date asc,product_title asc";
$res=$mysqli->query($sql);



$sqlAgrupados="select 
id_informe,start_date,start_date_hora,GROUP_CONCAT(barco_hotel, ',') ,SUM(total_PAX) AS total_PAX,status,product_title,SUM(total_price_with_discount) AS total_price_with_discount
from informe where  estado='1' $and 
and (
product_title='5-Hour Nat Park + City Tour *Shore Excursion* USHUAIA (Shared tour for cruises)'
)

GROUP BY start_date,start_date_hora,status,product_title
order by start_date asc,product_title asc
";
$resAgrupados=$mysqli->query($sqlAgrupados);



$sqlAgrupados="select 
id_informe,start_date,start_date_hora,GROUP_CONCAT(barco_hotel, ',') as barco_hotel ,SUM(total_PAX) AS total_PAX,status,product_title,SUM(total_price_with_discount) AS total_price_with_discount
from informe where  estado='1' $and 
and (
product_title='5-Hour Nat Park + City Tour *Shore Excursion* USHUAIA (Shared tour for cruises)'
or  product_title='Punta Tombo Shore Excursion (Shared tour for cruises) - PUERTO MADRYN' 
)

GROUP BY start_date,start_date_hora,status,product_title
order by start_date asc,product_title asc
";
$resAgrupados=$mysqli->query($sqlAgrupados);



 }
else {
	
	$sql="select * from informe where estado='1' order by start_date asc,product_title asc";
$res=$mysqli->query($sql);
}
?>


	
	 
	
          
          <form action="listadoAgrupado.php" method="POST">

    <div class="col-md-6">
             <div class="form-group">  
                      <label for="titulo">Fecha:</label> 
                      <input type="date" class="form-control" id="fecha" name="fecha" <?php if($fecha!=""){ ?> value="<?php echo $fecha;?>" <?php } ?> > 
                    </div>
					
					
             

               <div class="form-group" > 
                      <label for="titulo">Excursion</label> 
                      <SELECT class="form-control" id="excursion" name="excursion"  >
                       <option value=""></option>         
					   <?php 
                      $sqlc="select product_title as excursion 
					  from excursiones
					  where product_title!='5-Hour National Park + City Tour *Shore Excursion* USHUAIA ( Shared tour )'
					  ";
                      $resc=$mysqli->query($sqlc);
                      while ($filac=mysqli_fetch_array($resc)) {
                        $excursionselect= $filac["excursion"];
                    ?>
                        <OPTION VALUE="<?php echo $excursionselect; ?>"><?php echo $excursionselect; ?></OPTION>
                      
                      <?php
                      }
                        ?>
                      </SELECT>
                  </div>
				  
				  
				   <?php if($excursion!=""){ ?>
				   <script type="text/javascript">
				   document.getElementById("excursion").value="<?php echo $excursion;?>";

				</script>

				   <?php } ?>
				   

 </div>  

 <div class="col-md-6">
 
      <div class="form-group">  
                      <label for="titulo">Desde:</label> 
                      <input type="date" class="form-control" id="desde" name="desde" <?php if($desde!=""){ ?> value="<?php echo $desde;?>" <?php } ?> > 
                    </div>
					
					     <div class="form-group">  
                      <label for="titulo">Hasta:</label> 
                      <input type="date" class="form-control" id="hasta" name="hasta" <?php if($hasta!=""){ ?> value="<?php echo $hasta;?>" <?php } ?> > 
                    </div>
					
					
      </div>
	  
	  
 
     <div class="col-md-6">
	     <div class="form-group">  
                      <label for="titulo">Parque:</label> 
                      <input type="number" class="form-control" id="parque" name="parque" <?php if($parque!=""){ ?> value="<?php echo $parque;?>" <?php } ?> > 
                    </div>
	       </div>
	 
	 
	      <div class="col-md-6">
	     <div class="form-group">  
                      <label for="titulo">Excel:</label> 
                      <SELECT class="form-control" id="excel" name="excel"  >
                       <option value="SUMA">Microsoft</option>         
                       <option value="SUM">Google</option>         
                      </SELECT>


			  
				   <?php if($excel!=""){ ?>
				   <script type="text/javascript">
				   document.getElementById("excel").value="<?php echo $excel;?>";

				</script>

				   <?php } ?>
				   
					  </div>
	       </div>
		   
		   
     <div class="col-md-12">
        <div class="form-group">
          <button type="submit" name="Buscar" class="btn btn-success" value="Buscar"><i class="fa fa-fw fa-search"></i> Buscar</button>
        </div>     </div>
          </form>
         
	<style>	  
		  div.dataTables_wrapper {
    overflow: scroll;
	}
	</style>

              <div class="col-md-12" style="clear: both;"></div>

			<table id="example" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Barco / Hotel </th>
                        <th>PAX</th>
                        <th>PAGO*</th>
                        <th>CP*</th>
                        <th>CANT</th>
                        <th>participants</th>
						<th>status</th>
                        <th>EXCURSION</th>
                        <th>OBSERVACIONES*</th>
                        <th>GUIA</th>
                        <th>BUS</th>
                        <th>COBR.EXC</th>
                
						<th>ENT.PN</th>
                        <th>TKT PN</th>
                        <th>BRUTO</th>
                        <th>COSTO GUIA</th>
                        <th>COSTO BUS</th>
                        <th>GCIA</th> 
			 

                      </tr>

                    </thead>

                    <tbody>

					<?php 
					$totalPax=0;
					$indice=2;
					$inicial=2;
					
					if($excel=="SUMA"){
					$indice=3;	
					$inicial=3;

					}
					$total_price_with_discount=0;
					
					$fechaAnt="";
					$excursionAnt="";
					
					while($fila=mysqli_fetch_array($res)){
						$fechadb=$fila["start_date"];
						$horadb=$fila["start_date_hora"];
						$excursiondb=$fila["product_title"];
				
					
					?>

                      <tr>
                        <td><a href="planillaIndividual.php?id=<?php echo $fila["id_informe"];?>" target="_blank">
						<?php echo date("d/m/Y",strtotime($fila["start_date"]));?> </a> </td>
                        <td><?php echo $fila["start_date_hora"];?></td>
                        <td><?php echo $fila["barco_hotel"];?></td>
                        <td><?php  //PAX
						echo $fila["customer"];?>
						</td>
						<td>PAGO</td>
						<td>CP</td>
						
						<td><?php 
						    if (is_numeric($fila["total_PAX"])) {
 
	
						$totalPax=$totalPax + $fila["total_PAX"];
						echo $fila["total_PAX"];
						   }
						?>
						</td>
						
						<td><?php echo $fila["participants"];?></td>
						<td><?php echo $fila["status"];?></td>
						<td><?php echo $fila["product_title"];?></td>
						<td>OBSERVACIONES</td>
						<td>GUIA</td>
						<td>BUS</td>
						<td><?php 
						$precioconcoma=str_replace(".", ",", $fila["total_price_with_discount"]);
						echo $precioconcoma;
						$total_price_with_discount=$total_price_with_discount+$fila["total_price_with_discount"];

						?></td>
				 
						<td><?php echo $parque;?></td>
						<td>=O<?php echo $indice;?>*G<?php echo $indice;?></td>
						<td>=N<?php echo $indice;?>-P<?php echo $indice;?></td>
						<td> </td>
						<td> </td>
						<td>=Q<?php echo $indice;?>-R<?php echo $indice;?>-S<?php echo $indice;?></td>
					 


                      </tr>
						<?php $indice++;?>
						
					  <?php
						$ultimoInforme=$fila["id_informe"];
						} //cierre del primer while
						
						
						while($fila=mysqli_fetch_array($resAgrupados)){
						$fechadb=$fila["start_date"];
						$horadb=$fila["start_date_hora"];
						$excursiondb=$fila["product_title"];
				
					
					?>

                      <tr>
                        <td><a href="planillaIndividual.php?id=<?php echo $fila["id_informe"];?>" target="_blank"> <?php echo date("d/m/Y",strtotime($fila["start_date"]));?> </a> </td>
                        <td><?php echo $fila["start_date_hora"];?></td>
                        <td><?php echo $fila["barco_hotel"];?></td>
                        <td>*</td>
						<td>PAGO</td>
						<td>CP</td>
						
						<td><?php 
						    if (is_numeric($fila["total_PAX"])) { 
						$totalPax=$totalPax + $fila["total_PAX"];
						echo $fila["total_PAX"];
						   }
						?>
						</td>
						
						<td><?php echo $fila["participants"];?></td>
						<td><?php echo $fila["status"];?></td>
						<td><?php echo $fila["product_title"];?></td>
						<td>OBSERVACIONES</td>
						<td>GUIA</td>
						<td>BUS</td>
						<td><?php 
						$precioconcoma=str_replace(".", ",", $fila["total_price_with_discount"]);
						echo $precioconcoma;
						$total_price_with_discount=$total_price_with_discount+$fila["total_price_with_discount"];

						?></td>
				 
						<td><?php echo $parque;?></td>
						<td>=O<?php echo $indice;?>*G<?php echo $indice;?></td>
						<td>=N<?php echo $indice;?>-P<?php echo $indice;?></td>
						<td> </td>
						<td> </td>
						<td>=Q<?php echo $indice;?>-R<?php echo $indice;?>-S<?php echo $indice;?></td>
					 
 
                      </tr>
					  <?php $indice++;?>
						
					  <?php
						$ultimoInforme=$fila["id_informe"];
						} //cierre del segundo while
						
						 
						
						//valido que busco por fecha / hora / excursion
						// || $fechadb!="" || $excursiondb!=""
						if($fecha!="" || $excursion!=""){
							
							$and="";
							
							if($fecha!=""){
							$and .=" and fecha='$fecha'";
							}
							
							/*else{
								
								if($fechadb!=""){
									$and .=" and fecha='$fechadb'";

								}
							}*/
								
							if($excursion!=""){
							$and .=" and excursion='$excursion'  ";
							}
							
							/*else{
										if($excursiondb!=""){
									$and .=" and excursion='$excursiondb'";

								}
								
							}*/
							
							  $sqlViaje="select * from viaje where estado='1' $and ";
							  //and hora='$horadb' 
							 // var_dump($sqlViaje);
								$resViaje=$mysqli->query($sqlViaje);
								$rowsViaje=mysqli_num_rows($resViaje);
								if($rowsViaje>0){
								$filaViaje=mysqli_fetch_array($resViaje);
								
								?>
								<tr>

                        <td><a href="planillaIndividual.php?id_viaje=<?php echo $filaViaje["id_viaje"];?>" target="_blank">
						<?php echo date("d/m/Y",strtotime($filaViaje["fecha"]));?> </a> </td>
                        <td><?php echo $filaViaje["hora"];?></td>
                        <td><?php echo $filaViaje["barco_hotel"];?></td>
                        <td></td>
						<td></td>
						<td></td>
						
						<td><?php 
						    if (is_numeric($filaViaje["cantidad"])) {
 
	
						$totalPax=$totalPax + $filaViaje["cantidad"];
						echo $filaViaje["cantidad"];
						   }
						?>
						</td>
						
						<td></td>
						<td>CARGA MANUAL</td>
						<td><?php echo $filaViaje["excursion"];?></td>
						<td>OBSERVACIONES</td>
						<td>GUIA</td>
						<td>BUS</td>
						<td><?php echo $filaViaje["total_price_with_discount"];
						$total_price_with_discount=$total_price_with_discount+$filaViaje["total_price_with_discount"];

						?></td>
				 
						<td><?php echo $parque;?></td>
						<td>=O<?php echo $indice;?>*G<?php echo $indice;?></td>
						<td>=N<?php echo $indice;?>-P<?php echo $indice;?></td>
						<td> </td>
						<td> </td>
						<td>=Q<?php echo $indice;?>-R<?php echo $indice;?>-S<?php echo $indice;?></td>
					 


                      </tr>
					  
					  		  <?php $indice++;?>
							  
							  
								<?php
								}

						}
					  ?>



                     <tr>

						<td> </td>
						<td> </td>
						<td> </td>
                    	<td> </td>
						<td> </td>
						<td> Total : </td>
						<td><?php 		echo $totalPax;	 	?>						</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> <?php 		echo $total_price_with_discount;	 	?> </td>
					  <?php 
						$indiceFinal=$indice-1;
					    //$indiceFinal=$indice;
					  ?>
						<td>=<?php echo $excel;?>(O<?php echo $inicial;?>:O<?php echo $indiceFinal;?>)</td>
						<td>=<?php echo $excel;?>(P<?php echo $inicial;?>:P<?php echo $indiceFinal;?>)</td>
						<td>=<?php echo $excel;?>(Q<?php echo $inicial;?>:Q<?php echo $indiceFinal;?>)</td>
						<td>=<?php echo $excel;?>(R<?php echo $inicial;?>:R<?php echo $indiceFinal;?>)</td>
						<td>=<?php echo $excel;?>(S<?php echo $inicial;?>:S<?php echo $indiceFinal;?>)</td>
						<td>=<?php echo $excel;?>(T<?php echo $inicial;?>:T<?php echo $indiceFinal;?>)</td>
						 



                      </tr>
					  
                    </tfoot>

                  </table>

                

              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- 
	

	
	DataTables 

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

    </script>-->
	
	
	<link rel="stylesheet" href="datatable/jquery.dataTables.min.css">
<link rel="stylesheet" href="datatable/buttons.dataTables.min.css">

  <script src="datatable/jquery-3.7.0.js"></script>
  <script src="datatable/jquery.dataTables.min.js"></script>
  <script src="datatable/dataTables.buttons.min.js"></script>
  <script src="datatable/jszip.min.js"></script>
  <script src="datatable/pdfmake.min.js"></script>
  <script src="datatable/vfs_fonts.js"></script>
  <script src="datatable/buttons.html5.min.js"></script>
  <script src="datatable/buttons.print.min.js"></script>
 
<style>
#example_filter {
	display:none;
	}
	
	div.dt-buttons {
    float: right!important;
    margin-top: 1em;
    margin-bottom: 1em;
}

.dt-button{
 color: #fff !important;
    border-color: #80CD03 !important;
    background-color: #80CD03 !important;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}

</style> 
<script>
$(document).ready(function() {
    $('#example').DataTable( {
		order: false,
		lengthMenu: [  100 ],
        dom: 'Bfrtip',
        buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print' 
			 'csv', 'excel'
        ]
    } );
} );

</script>
