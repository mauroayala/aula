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

            <li><a href="#"><i class="ion-search"></i> Home</a></li>

            <li class="active"> Listado de Ventas </li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Ventas  </h3>

            </div>

            <div class="box-body">
              <div class="col-md-6">
          <form action="listadoDeVentas.php" method="POST">
              <div class="form-group">
                    <label>Buscar por fechas:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="fechas" class="form-control pull-right" id="reservation">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

        <div class="form-group">
          <button type="submit" name="Buscar" class="btn btn-success" value="Buscar"><i class="fa fa-fw fa-search"></i> Buscar</button>
        </div>
          </form>
          </div>

			<?php 

			if(isset($_POST["Buscar"])){

				$fechas=explode(" - ",filtroInyeccion($_POST["fechas"]));
        $fechaDesde= $fechas[0];
        $fechaHasta= $fechas[1];
         
 

				?>

                <script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=800,height=500&,scrollbars=YES") 
} 
</script>

           <div class="col-md-12"></div>
			<table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Codigo</th>

                        <th>Fecha</th>

                        <th>Total</th>

                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>

                        <th>Ver</th>

                      </tr>

                    </thead>

                    <tbody>

					<?php 

        $sql="SELECT
              carrito.id_carrito,carrito.fecha,carrito.estado,carrito.email,carrito.telefono,(
                  
                  SELECT SUM(detalle_compra.cantidad*detalle_compra.precio) FROM detalle_compra
                        WHERE detalle_compra.id_carrito = carrito.id_carrito) as subtotal

              FROM `carrito` WHERE `fecha` BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
              ";

        $res=$mysqli->query($sql);
   
					while($fila=mysqli_fetch_array($res)){

					?>

                      <tr>

                        <td><?php echo $fila["id_carrito"];?></td>

                        <td><?php echo $fila["fecha"];?></td>

                        <td>$<?php echo $fila["subtotal"];?></td>
                        <td><?php echo $fila["email"];?></td>
                        <td><?php echo $fila["telefono"];?></td>

                        <td><?php  if($fila["estado"]==1)
                                        echo "En proceso";
                                        else
                                          echo "Concluida"
                        ;?></td>
                        <td>

                             <a class="btn btn-primary" href="javascript:ventanaSecundaria('verDetalleCompra.php?id_carrito=<?php echo $fila["id_carrito"];?>')">Ver Detalle</a>

                           </td>

                      </tr>

					  <?php

						}

					  ?>

                    </tfoot>

                  </table>

                
        <?php

        }

        ?>
              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- DataTables -->

	<script src="plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

	    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/moment.min.js?v2"></script>
    <script src="plugins/daterangepicker/daterangepicker.js?v2"></script>

	  <script>

      $(function () {
    $("#example1").DataTable({
          "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

//Date range picker
        $('#reservation').daterangepicker();


      });

    </script>