<?php include('menu.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);
ini_set('upload_max_filesize', '600M'); 
ini_set('post_max_size', '650M'); 
ini_set('max_execution_time', '500'); 
ini_set('max_input_time', '500');  
?>
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
            <li class="active"> Cargar Excel </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Cargar Excel </h3>
            </div>
            <div class="box-body">
			<?php 
			
										      function paragrafizar($string=""){
        // normalizamos los saltos de línea
        $string = str_replace(array("\r\n", "\r"), "\n", $string);
        // creamos un array de parrafos
        $strParrafos = explode("\n", $string);
        // abrimos tag, deconstruimos el array, cerramos tag
        $string = '<p>' . implode("</p>\n<p>", $strParrafos) . '</p>';
        return $string;
    }
	
	
			$message = "";
			if(isset($_POST["Enviar"])){  
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
				$fechacarga=date("Y-m-d H:i:s");

		
		            $queryinformeestado = " update `informe` set estado='0' where estado='1' ";
                    mysqli_query($mysqli, $queryinformeestado);

				$tituloViejo="Punta Tombo Shore Excursion (Shared tour for cruises) - PUERTO MADRYN";
				$tituloNuevo="Punta Tombo Shore Excursion w/box Lunch(Shared tour for cruises)";
					
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $creation_date = "";
                if(isset($Row[0])) {
                    $creation_date = mysqli_real_escape_string($mysqli,$Row[0]);
					$fechaaordenar = explode(".", $creation_date);
					$creation_date=$fechaaordenar[2]."-".$fechaaordenar[1]."-".$fechaaordenar[0];

                }
                
                $cart_confirmation_code = "";
                if(isset($Row[1])) {
                    $cart_confirmation_code = mysqli_real_escape_string($mysqli,$Row[1]);
                }
				
                $product_confirmation_code = "";
                if(isset($Row[2])) {
                    $product_confirmation_code = mysqli_real_escape_string($mysqli,$Row[2]);
                }
				
				
				$customer = "";
                if(isset($Row[3])) {
                    $customer = mysqli_real_escape_string($mysqli,$Row[3]);
                }
				
				
				$email = "";
                if(isset($Row[4])) {
                    $email = mysqli_real_escape_string($mysqli,$Row[4]);
                }
				
				              $phone_number = "";
                if(isset($Row[5])) {
                    $phone_number = mysqli_real_escape_string($mysqli,$Row[5]);
                }
				
				              $product_ID = "";
                if(isset($Row[6])) {
                    $product_ID = mysqli_real_escape_string($mysqli,$Row[6]);
                }
				
				              $product_title = "";
                if(isset($Row[7])) {
                    $product_title = mysqli_real_escape_string($mysqli,$Row[7]);
					
					if($product_title==$tituloViejo){
						$product_title=$tituloNuevo;
					}
                }
				
				              $product_country = "";
                if(isset($Row[8])) {
                    $product_country = mysqli_real_escape_string($mysqli,$Row[8]);
                }
				
				              $product_city = "";
                if(isset($Row[9])) {
                    $product_city = mysqli_real_escape_string($mysqli,$Row[9]);
                }
				
				              $start_date = "";
                if(isset($Row[10])) {
                    $start_date = mysqli_real_escape_string($mysqli,$Row[10]);
					$fechayhora = explode(" ", $start_date);

					$fechastardate = explode(".", $fechayhora[0]);
					$start_date=$fechastardate[2]."-".$fechastardate[1]."-".$fechastardate[0];
					$start_date_hora=$fechayhora[1];
					
					
                }
				
				              $end_date = "";
                if(isset($Row[11])) {
                    $end_date = mysqli_real_escape_string($mysqli,$Row[11]);
                }
				
				              $status = "";
                if(isset($Row[12])) {
                    $status = mysqli_real_escape_string($mysqli,$Row[12]);
                }
				
				              $rate_title = "";
                if(isset($Row[13])) {
                    $rate_title = mysqli_real_escape_string($mysqli,$Row[13]);
                }
				
				              $total_price_with_discount = "";
                if(isset($Row[14])) {
                    $total_price_with_discount = mysqli_real_escape_string($mysqli,$Row[14]);
                }
				
				              $discount = "";
                if(isset($Row[15])) {
                    $discount = mysqli_real_escape_string($mysqli,$Row[15]);
                }
				
				              $sale_currency = "";
                if(isset($Row[16])) {
                    $sale_currency = mysqli_real_escape_string($mysqli,$Row[16]);
                }
				
				              $commission = "";
                if(isset($Row[17])) {
                    $commission = mysqli_real_escape_string($mysqli,$Row[17]);
                }
				
				              $supplier_NET_price = "";
                if(isset($Row[18])) {
                    $supplier_NET_price = mysqli_real_escape_string($mysqli,$Row[18]);
                }
				
				              $supplier_currency = "";
                if(isset($Row[19])) {
                    $supplier_currency = mysqli_real_escape_string($mysqli,$Row[19]);
                }
				
				              $payment_status = "";
                if(isset($Row[20])) {
                    $payment_status = mysqli_real_escape_string($mysqli,$Row[20]);
                }
				
				              $supplier = "";
                if(isset($Row[21])) {
                    $supplier = mysqli_real_escape_string($mysqli,$Row[21]);
                }
				
				              $seller = "";
                if(isset($Row[22])) {
                    $seller = mysqli_real_escape_string($mysqli,$Row[22]);
                }
				
				              $affiliate_number = "";
                if(isset($Row[23])) {
                    $affiliate_number = mysqli_real_escape_string($mysqli,$Row[23]);
                }
				              $affiliate = "";
                if(isset($Row[24])) {
                    $affiliate = mysqli_real_escape_string($mysqli,$Row[24]);
                }
				
				              $booking_agent = "";
                if(isset($Row[25])) {
                    $booking_agent = mysqli_real_escape_string($mysqli,$Row[25]);
                }
				
				              $agent_claim = "";
                if(isset($Row[26])) {
                    $agent_claim = mysqli_real_escape_string($mysqli,$Row[26]);
                }
				              $booking_channel = "";
                if(isset($Row[27])) {
                    $booking_channel = mysqli_real_escape_string($mysqli,$Row[27]);
                }
				              $total_PAX = "";
                if(isset($Row[28])) {
                    $total_PAX = mysqli_real_escape_string($mysqli,$Row[28]);
                }
				              $participants = "";
                if(isset($Row[29])) {
                    $participants = mysqli_real_escape_string($mysqli,$Row[29]);
                }
				              $external_booking_ref = "";
                if(isset($Row[30])) {
                    $external_booking_ref = mysqli_real_escape_string($mysqli,$Row[30]);
                }
				              $inventory_service_reference = "";
                if(isset($Row[31])) {
                    $inventory_service_reference = mysqli_real_escape_string($mysqli,$Row[31]);
                }
				              $product_group_labels = "";
                if(isset($Row[32])) {
                    $product_group_labels = mysqli_real_escape_string($mysqli,$Row[32]);
                }
				              $notes = "";
							  $barco_hotel="";
							  
							  

	
	
                if(isset($Row[33])) {
                    $notes = mysqli_real_escape_string($mysqli,$Row[33]);
					$notes = str_replace("'", "", $notes);

					$notesparacolumnas = $Row[33];
					$notesparacolumnas = str_replace("'", "", $notesparacolumnas);

					$barcoConExtras = explode("Cruise Ship : ", $notesparacolumnas);
 					$b=$barcoConExtras[1]; 
					$barco_hotelsinextras = explode("\n", $b );
 	 
					$location = explode("Pick up Location : ", $notesparacolumnas);
 					$a=$location[1]; 
					$locationsinextras = explode("\n", $a );
	 
	 
					$barco_hotel=$barco_hotelsinextras[0] . " / " . $locationsinextras[0]; 
					
					
					$specialConExtras=explode("--- Special requirement: ---", $notesparacolumnas);
					$special=$specialConExtras[1];
					$specialSinEXTRAS = explode("\n", $special );
	 				$special=$specialSinEXTRAS[1];

	 
	 
	 
	 				$guideConExtras=explode("--- Booking languages: ---", $notesparacolumnas);
					$guide=$guideConExtras[1];
					$guideSinEXTRAS = explode("\n", $guide );
					$guide=$guideSinEXTRAS[1];
 					
                 } 
				$numero=1;
				$fecha=date("Y-m-d");
      
                
                if (!empty($creation_date) || !empty($cart_confirmation_code) || !empty($product_confirmation_code)) {
                    $query = "
					INSERT INTO `informe` (`id_informe`, `numero`, `fecha`, `creation_date`, `cart_confirmation_code`, `product_confirmation_code`, `customer`, `email`, `phone_number`, `product_ID`, `product_title`, `product_country`, `product_city`, `start_date`,`start_date_hora`, `end_date`, `status`, `rate_title`, `total_price_with_discount`, `discount`, `sale_currency`, `commission`, `supplier_NET_price`, `supplier_currency`, `payment_status`, `supplier`, `seller`, `affiliate_number`, `affiliate`, `booking_agent`, `agent_claim`, `booking_channel`, `total_PAX`, `participants`, `external_booking_ref`, `inventory_service_reference`, `product_group_labels`, `notes`, `barco_hotel`, `special`, `guide`, `estado`, `fechacarga`) 
					
					VALUES (NULL, '$numero', '$fecha', '$creation_date', '$cart_confirmation_code', '$product_confirmation_code', '$customer', '$email', '$phone_number', '$product_ID', '$product_title', '$product_country', '$product_city', '$start_date','$start_date_hora', '$end_date', '$status', '$rate_title', '$total_price_with_discount', '$discount', '$sale_currency', '$commission', '$supplier_NET_price', '$supplier_currency', '$payment_status', '$supplier', '$seller', '$affiliate_number', '$affiliate', '$booking_agent', '$agent_claim', '$booking_channel', '$total_PAX', '$participants', '$external_booking_ref', '$inventory_service_reference', '$product_group_labels', '$notes' , '$barco_hotel', '$special','$guide','1','$fechacarga')";
 

					$resultados = mysqli_query($mysqli, $query);
 
                    if (! empty($resultados)) {
                        $type = "success";
                        $message = "Excel importado correctamente";
                    } else {
                        $type = "error";
                        $message = "Hubo un problema al importar registros";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}

echo $message;
				?>
 		 
              <form action="cargarInforme.php" method="POST"  enctype="multipart/form-data" >
		 
					
					<div class="form-group">
                      <label for="titulo">Archivo</label>
					  <input type="file" id="file" class="input-file"  name="file" class="form-control">
                    </div>
					

										
										
			      <p>
 				<button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Importar </button>
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