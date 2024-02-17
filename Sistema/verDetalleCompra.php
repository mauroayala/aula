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

              <h3 class="box-title"><i class="fa fa-tag"></i>Ver detalle de la compra.</h3>

            </div>

            <div class="box-body">
 

<?php 
$id_carrito=$_GET["id_carrito"];
    $sql="
                select carrito.*,
                detalle_compra.id_detalle,
                detalle_compra.id_producto,
                detalle_compra.cantidad,
                productos.nombre,
                productos.precio,
                productos.medidas,
                productos.colores,
                productos.foto1

                from carrito 
                left join detalle_compra on (detalle_compra.id_carrito=carrito.id_carrito)
                left join productos on (productos.id_producto=detalle_compra.id_producto)
                where carrito.id_carrito='$id_carrito' and id_detalle is not null ";
                
                $res=$mysqli->query($sql);
                $rows=mysqli_num_rows($res);
 
                ?>
              <table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Imagen</th>

                        <th>Producto</th>

                        <th>Cantidad</th>

                        <th>Sub-total</th>
 

                      </tr>

                    </thead>

                    <tbody>

 
                            
                
                <?php
                $descripcionCompra="";
                $total=0;
                
            

                while($fila=mysqli_fetch_array($res)){
                  $nombreProducto=$fila["nombre"];
                  $cantidadProducto=$fila["cantidad"];
                  $unidadMEDIDA=$fila["colores"];
                  ?>
                                <tr>
                                        <td><div class="thumb"><span> 
                                          <img alt="alt"  src="../images/productos/<?php echo $fila["foto1"];?>" style=" max-width: 100px;"draggable="false"> 
                                        </span></div></td>
                                        <td>
                                            <h5> <?php echo $nombreProducto;?> </h5>
                                            <p>$<?php echo $fila["precio"];?>  x <span> <?php echo $unidadMEDIDA;?></span></p>
                                        </td>
                                        <td>
       
                                               <input type="hidden" name="id_detalle" value="<?php echo $fila["id_detalle"];?>"> 
                                       
                                              <span style=" FLOAT: LEFT;"><?php echo $cantidadProducto;?> <?php echo  $unidadMEDIDA;?></span>
                                
                                        </td>
                                        <td>
                                            <div class="price" style="    float: left;">$<?php 
                      
                                            $subtotal=$fila["cantidad"]*$fila["precio"];
                                            echo $subtotal;
                                             $descripcionCompra .="($cantidadProducto Unidad) del producto : $nombreProducto = $ $subtotal . ";
                                            $total=$total+$subtotal;
                                            ?></div>
                    
                                        </td>
                                    </tr>
                                <?php }?>
                </tbody></table>

           
                        <br>     Total: $<?php echo $total;  ?> 

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>
 