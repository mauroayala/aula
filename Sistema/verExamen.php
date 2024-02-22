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
            <li class="active"> Ver Examene </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          


        <?php 
        $id_usuario=$_SESSION['idusuario'];
        $fecha=date("Y-m-d H:i:s");
			if(isset($_POST["Finalizar"])){
				$id_examen=filtroInyeccion($_POST["id_examen"]);

                $sqlPreguntas="select preguntas.* from preguntas  where preguntas.estado='1' and id_examen='$id_examen' order by numero asc ";
                $resPreguntas=$mysqli->query($sqlPreguntas);
                while($filaPreguntas=mysqli_fetch_array($resPreguntas)){ 
                    $puntajeObtenido=0;
                    $respuestaAlumno="";
                    $id_pregunta=$filaPreguntas["id_pregunta"];
                    $tipo=$filaPreguntas["tipo"];

                    $id_respuesta=filtroInyeccion($_POST["pregunta$id_pregunta"]);
                    $respuestaCorrecta=$filaPreguntas["respuesta_correcta"];

                    if($id_respuesta==$respuestaCorrecta){
                        $puntajeObtenido=$filaPreguntas["puntaje"];
                    }
                    if($tipo=="textarea"){
                        $respuestaAlumno=filtroInyeccion($_POST["pregunta$id_pregunta"]);
                        $id_respuesta=0;
                    }

                    $validoSiRespondio="select * from alumnos_examen where id_usuario='$id_usuario' and id_examen='$id_examen' and id_pregunta='$id_pregunta' ";
                    $resvalidoSiRespondio=$mysqli->query($validoSiRespondio);
 
                    $row=mysqli_num_rows($resvalidoSiRespondio);

                    if($row>0){

                        $filavalidoSiRespondio=mysqli_fetch_array($resvalidoSiRespondio);
                        $id_alumnos_examen=$filavalidoSiRespondio["id_alumnos_examen"];
                        $sql="update `alumnos_examen`  set `id_respuesta`='$id_respuesta', `fecha`='$fecha', `puntaje`='$puntajeObtenido', `respuesta`='$respuestaAlumno'
                        where id_alumnos_examen='$id_alumnos_examen' ";
                        $res=$mysqli->query($sql);

                    }else{
				$sql="INSERT INTO `alumnos_examen` (`id_alumnos_examen`, `id_usuario`, `id_examen`, `id_pregunta`, `id_respuesta`, `fecha`, `estado`, `puntaje`, `respuesta`)
                 VALUES (NULL, '$id_usuario', '$id_examen', '$id_pregunta', '$id_respuesta', '$fecha', '1', '$puntajeObtenido', '$respuestaAlumno');";
 				$res=$mysqli->query($sql);
                }


            }


				?>
				<div class="callout callout-info">
                    <p>Usted ha finalizado el examen. Muchas gracias</p>
                  </div>
				<?php
				}
				?>



        <?php 
				$id_examen=filtroInyeccion($_POST["id_examen"]);
                    $sql="select * from examen where estado='1' and id_examen='$id_examen'";
					$res=$mysqli->query($sql);
					$fila=mysqli_fetch_array($res);


                    $sqlPreguntas="
                    
                    select preguntas.*,rp1.respuesta as respuesta1texto 
                    ,rp2.respuesta as respuesta2texto 
                    ,rp3.respuesta as respuesta3texto 
                    ,rp4.respuesta as respuesta4texto 
                    ,rp5.respuesta as respuesta5texto 
from preguntas 
left join respuestas rp1 on preguntas.respuesta1=rp1.id_respuesta
left join respuestas rp2 on preguntas.respuesta2=rp2.id_respuesta
left join respuestas rp3 on preguntas.respuesta3=rp3.id_respuesta
left join respuestas rp4 on preguntas.respuesta4=rp4.id_respuesta
left join respuestas rp5 on preguntas.respuesta5=rp5.id_respuesta
where preguntas.estado='1' and id_examen='$id_examen' order by numero asc

 
                    ";
					$resPreguntas=$mysqli->query($sqlPreguntas);

 					?>


		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> <?php echo $fila["titulo"];?> <?php echo $fila["descripcion"];?></h3>
            </div>
            <div class="box-body">
            <div class="col-md-8">

                <form action="verExamen.php" method="POST">
                <INPUT TYPE="hidden" value="<?php echo $id_examen;?>" name="id_examen">


                     <?php
                     
						while($filaPreguntas=mysqli_fetch_array($resPreguntas)){ 


                            $tipo=$filaPreguntas["tipo"];
                            $id_pregunta=$filaPreguntas["id_pregunta"];

              
                            $sqlRespuestas="select alumnos_examen.* from alumnos_examen 
                             where estado='1' and id_examen='$id_examen' and id_pregunta='$id_pregunta'  and id_usuario='$id_usuario'  ";
                            $resRespuestas=$mysqli->query($sqlRespuestas);
                             $filaRespuestas=mysqli_fetch_array($resRespuestas);
                            $respuestaUsuariodb=$filaRespuestas["id_respuesta"];
                            $respuestaUsuariodbText=$filaRespuestas["respuesta"];
                           

					  ?>
                        
                        <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">
                    
                  <label> Pregunta <?php echo $filaPreguntas["numero"];?> </label>
                  <br> <?php echo $filaPreguntas["pregunta"];?>

                  </h3>
                  <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body"> 
                <label>Respuesta: </label><br>
                        
                        <?php 
                 

                        if($tipo=="select"){
                            ?>
                            <select  id="pregunta<?php echo $id_pregunta;?>"  name="pregunta<?php echo $id_pregunta;?>" class="form-control">
                            <option></option>
                            <?php if($filaPreguntas["respuesta1"]>0 ){ ?><option value="<?php echo $filaPreguntas["respuesta1"];?>"><?php echo $filaPreguntas["respuesta1texto"];?></option>    <?php } ?>
                            <?php if($filaPreguntas["respuesta2"]>0){ ?><option value="<?php echo $filaPreguntas["respuesta2"];?>"><?php echo $filaPreguntas["respuesta2texto"];?></option>    <?php } ?>
                            <?php if($filaPreguntas["respuesta3"]>0){ ?><option value="<?php echo $filaPreguntas["respuesta3"];?>"><?php echo $filaPreguntas["respuesta3texto"];?></option>    <?php } ?>
                            <?php if($filaPreguntas["respuesta4"]>0){ ?><option value="<?php echo $filaPreguntas["respuesta4"];?>"><?php echo $filaPreguntas["respuesta4texto"];?></option>    <?php } ?>
                            <?php if($filaPreguntas["respuesta5"]>0){ ?><option value="<?php echo $filaPreguntas["respuesta5"];?>"><?php echo $filaPreguntas["respuesta5texto"];?></option>    <?php } ?>

                            </select>


                            <script type="text/javascript">
                            document.getElementById("pregunta<?php echo $id_pregunta;?>").value=<?php echo $respuestaUsuariodb;?>;
                            </script>

                            <?php
                        }
                        

                        if($tipo=="check"){
                        ?>
                          <?php if($filaPreguntas["respuesta1"]>0 ){ ?>
                            <p>  <input type="checkbox"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta1"];?>"  name="pregunta<?php echo $id_pregunta;?>"
                              value="<?php echo $filaPreguntas["respuesta1"];?>"> 
                          <?php echo $filaPreguntas["respuesta1texto"];?></p>
                          <?php  }  ?>
                          <?php if($filaPreguntas["respuesta2"]>0 ){ ?><p>
                          <input type="checkbox"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta2"];?>"  name="pregunta<?php echo $id_pregunta;?>"  
                          value="<?php echo $filaPreguntas["respuesta2"];?>"> 
                          <?php echo $filaPreguntas["respuesta2texto"];?></p>
                          <?php  }  ?>
                          <?php if($filaPreguntas["respuesta3"]>0 ){ ?><p>
                          <input type="checkbox"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta3"];?>"  name="pregunta<?php echo $id_pregunta;?>"
                            value="<?php echo $filaPreguntas["respuesta3"];?>">
                          <?php echo $filaPreguntas["respuesta3texto"];?></p>
                          <?php  }  ?>
                          <?php if($filaPreguntas["respuesta4"]>0 ){ ?><p>
                          <input type="checkbox"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta4"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta4"];?>"> 
                          <?php echo $filaPreguntas["respuesta4texto"];?></p>
                          <?php  }  ?>
                          <?php if($filaPreguntas["respuesta5"]>0 ){ ?><p>
                          <input type="checkbox"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta5"];?>"  name="pregunta<?php echo $id_pregunta;?>"
                            value="<?php echo $filaPreguntas["respuesta5"];?>"> 
                          <?php echo $filaPreguntas["respuesta5texto"];?></p>
                          <?php  }  ?>
                             
              
                          <script type="text/javascript">
                             document.getElementById("pregunta<?php echo $id_pregunta . $respuestaUsuariodb;?>").checked = true;
                             </script>
 

                        <?php  }   



                        if($tipo=="radio"){
                        ?>
                          <?php if($filaPreguntas["respuesta1"]>0 ){ ?><p>
                            <input type="radio"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta1"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta1"];?>">   
                          <?php echo $filaPreguntas["respuesta1texto"];?>
                          </p>  <?php  }  ?>
                          <?php if($filaPreguntas["respuesta2"]>0 ){ ?><p>
                            <input type="radio"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta2"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta2"];?>">   
                          <?php echo $filaPreguntas["respuesta2texto"];?>
                          </p> <?php  }  ?>
                          <?php if($filaPreguntas["respuesta3"]>0 ){ ?><p>
                            <input type="radio"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta3"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta3"];?>">  
                          <?php echo $filaPreguntas["respuesta3texto"];?>
                          </p>  <?php  }  ?>
                          <?php if($filaPreguntas["respuesta4"]>0 ){ ?><p>
                            <input type="radio"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta4"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta4"];?>">  
                          <?php echo $filaPreguntas["respuesta4texto"];?>
                          </p>   <?php  }  ?>
                          <?php if($filaPreguntas["respuesta5"]>0 ){ ?><p>
                            <input type="radio"  id="pregunta<?php echo $id_pregunta.$filaPreguntas["respuesta5"];?>"  name="pregunta<?php echo $id_pregunta;?>"  value="<?php echo $filaPreguntas["respuesta5"];?>"> 
                          <?php echo $filaPreguntas["respuesta5texto"];?>
                          </p> <?php  }  ?>
                             

                          <script type="text/javascript">
                             document.getElementById("pregunta<?php echo $id_pregunta . $respuestaUsuariodb;?>").checked = true;
                             </script>
 
                          <?php  }
                        
                        if($tipo=="textarea"){
                            ?>
                            <textarea  id="pregunta<?php echo $id_pregunta;?>"  
                            name="pregunta<?php echo $id_pregunta;?>" ><?php echo $respuestaUsuariodbText;?></textarea>

                        <?php  }  ?>

                        </div><!-- /.box-body -->
              </div><!-- /.box -->


              

                      
					  <?php
						} 
                        //fin de whule que arma preguntas
					  ?>
                       </div>
                   <div class="col-md-12" >
                   <INPUT TYPE="submit" value="Finalizar Examen" name="Finalizar" class="btn btn-success">
		     
                   </div>
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