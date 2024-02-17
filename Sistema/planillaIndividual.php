<?php include('menu.php');?>

         <!-- DataTables

Create view excursiones as 
select distinct product_title from informe
order by product_title asc


		 -->

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

            <li class="active"> Planilla Individual </li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Planilla Individual </h3>

            </div>

            <div class="box-body">
 
				

              <div class="col-md-6">
       
          </div>
	<style>	  
		  div.dataTables_wrapper {
    overflow: scroll;
	}
	</style>

              <div class="col-md-12" style="clear: both;"></div>
<?php 
 
 if(isset($_GET["eliminar"])){
$id_persona=$_GET["eliminar"];
$sqlpp="select * from personas where id_persona='$id_persona'";
$respp=$mysqli->query($sqlpp);
$filapp=mysqli_fetch_array($respp);


$id_viajeValidarEliminar=$filapp["id_viaje"];


$sqlpp2="update personas set estado='0' where id_persona='$id_persona'";
$respp2=$mysqli->query($sqlpp2);


$sqlpp3="select * from personas where id_viaje='$id_viajeValidarEliminar' and estado='1' ";
$respp3=$mysqli->query($sqlpp3);
$rowspp3=mysqli_num_rows($respp3);
 
 if($rowspp3==0){ 
	$sqlchauviaje="update viaje set estado='0' where id_viaje='$id_viajeValidarEliminar'";
	$mysqli->query($sqlchauviaje);
}


 }
 
 
 
if(isset($_GET["id"])){
 
$id=$_GET["id"];
$sql="select * from informe where id_informe='$id' and estado='1' ";
$res=$mysqli->query($sql);

 // ahora busco la fecha y excursion para ver todos los que estan en esa excursion
$fila=mysqli_fetch_array($res);
 $fecha=$fila["start_date"];
 $hora=$fila["start_date_hora"];
 $excursion=$fila["product_title"];
 
 
 ////////////////////dudosa
 $sql="select * from informe where start_date='$fecha'
and product_title='$excursion' and start_date_hora='$hora' and estado='1' ";
$res=$mysqli->query($sql);
///////////////fin de dudosa
//var_dump($sql);
$nowHour = date($hora);
$nowHour = strtotime('-1 minute', strtotime($nowHour));
$nowHour = date('H:i', $nowHour);


 $nowHour2 = date($hora);
$nowHour2 = strtotime('+1 minute', strtotime($nowHour2));
$nowHour2 = date('H:i', $nowHour2);
	


}	



if(isset($_GET["id_viaje"])){
$id_viaje=$_GET["id_viaje"];

$sql="select * from viaje where id_viaje='$id_viaje' and estado='1' ";
$res=$mysqli->query($sql);
$fila=mysqli_fetch_array($res);
 $fecha=$fila["fecha"];
 $hora=$fila["hora"];
 $excursion=$fila["excursion"];
 
 
$nowHour = date($hora);
$nowHour = strtotime('-1 minute', strtotime($nowHour));
$nowHour = date('H:i', $nowHour);


 $nowHour2 = date($hora);
$nowHour2 = strtotime('+1 minute', strtotime($nowHour2));
$nowHour2 = date('H:i', $nowHour2);
	
	
	

$sql="select * from informe where estado='1' and start_date='$fecha' and product_title='$excursion'
and (start_date_hora='$hora' or start_date_hora='$nowHour' or  start_date_hora='$nowHour2' ) 
 ";
$res=$mysqli->query($sql);

/*$fila=mysqli_fetch_array($res);
var_dump($sql);

 $fecha=$fila["start_date"];
 $hora=$fila["start_date_hora"];
 $excursion=$fila["product_title"];*/
 

}		 




 
?>
<h2><?php echo $excursion;?></h2>

<h3>FECHA :<?php echo date("d/m/Y",strtotime($fecha));?></h3>
<h3>HORA :<?php echo $hora;?></h3>
			<table id="example" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th></th>
                        <th>NAMES LIST</th>
                        <th>Age</th>
                        <th>S.R</th>
                        <th>Language</th>
                        <th>PRE-PAYMENT</th>
                        <th>AMOUNT DUE</th>
                        <th>SELLER</th>
                        <th>BARCO</th>
                        <th>DEPOSIT DATE</th>
						<th>BOKING CODE</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>

                      </tr>

                    </thead>

                    <tbody>

					<?php 
					$totalPax=0;
					$total_price_with_discount=0;
					while($fila=mysqli_fetch_array($res)){

					?>

                      <tr>

                        <td><?php echo $fila["total_PAX"];
						$totalPax=$totalPax+$fila["total_PAX"];?></td>
                        <td><?php echo $fila["customer"];?></td>
                        <td><?php echo $fila["participants"];?></td>
                        <td><?php echo $fila["special"];?></td>
                        <td><?php echo $fila["guide"];?></td>
						<td> </td>
						<td> </td>
                        <td><?php echo $fila["seller"];?></td>
                        <td><?php echo $fila["barco_hotel"];?></td>
                        <td><?php echo $fila["creation_date"];?></td>
                        <td><?php echo $fila["external_booking_ref"];?></td>
                        <td><?php echo $fila["phone_number"];?></td>
                        <td><?php echo $fila["email"];?></td>
                       
                      </tr>

					  <?php
						}
						
if(isset($_GET["id_viaje"])){
$id_viaje=$_GET["id_viaje"];

$sql="select * from viaje where id_viaje='$id_viaje' and estado='1' ";
}				 
$sql="select * from viaje where fecha='$fecha'
and excursion='$excursion' and 
(hora='$hora' or hora='$nowHour' or hora='$nowHour2') ";
//var_dump($sql);
$res=$mysqli->query($sql);
$rows=mysqli_num_rows($res);
if($rows>0){
	
while($fila=mysqli_fetch_array($res)){
$id_viaje=$fila["id_viaje"];		


$sqlp="select * from personas where id_viaje='$id_viaje' and estado='1'";
$resp=$mysqli->query($sqlp);
$rowsp=mysqli_num_rows($resp);
if($rowsp>0){

	while($filap=mysqli_fetch_array($resp)){

	?>

                      <tr>

                        <td><?php echo $filap["cantidad"];?>
						<a href="planillaIndividual.php?id=<?php echo $id;?>&&eliminar=<?php echo  $filap["id_persona"];?>" onclick="return confirm('¿Estas seguro de eliminar este registro?');" > X </a>
						<?php $totalPax=$totalPax+$filap["cantidad"];?>
						</td>
                        <td><?php echo $filap["nombre"];?></td>
                        <td></td>
                        <td><?php echo $filap["requerimientos"];?></td>
                        <td><?php echo $filap["idiomas"];?></td>
                        <td><?php echo $filap["down_payment"];?></td>
                        <td><?php echo $filap["amount_due"];?></td>
                        <td>CARGA MANUAL</td>
                        <td><?php echo $fila["barco_hotel"];?></td>				
                        <td><?php echo $filap["fechareserva"];?></td>				
                        <td><?php echo $filap["reserva"];?></td>
                        <td><?php echo $filap["telefono"];?></td>
                        <td><?php echo $filap["email"];?></td>
                       
                      </tr>

					  <?php
	}//WHILE DE PERSONAS
	
}	
				
}//WHILE DE VIAJES		


} 		
						
					  ?>



                     <tr>

						<td><?php echo $totalPax;?> </td>
						<td> </td>
						<td> </td>
						<td> </td>
                    	<td> </td>
                    	<td> </td>
						<td> </td> 
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
					
                      </tr>
					  
                    </tfoot>

                  </table>

                

              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- DataTables 

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
			 'excel','csv'
        ]
    } );
} );

</script>
