<?php ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();

include("conectar.php");



if(!isset($_SESSION["usuario"])){



if (isset($_POST['email'])){







$usuariotie=filtroInyeccion($_POST['email']);



$contrasena=filtroInyeccion($_POST['password']);



$contrasena=md5($contrasena);



$valido=true;


  $consulta2="SELECT * FROM usuariositumanda where email='$usuariotie' AND pass='$contrasena'";


         $result=$mysqli->query($consulta2);



         $filasn= mysqli_num_rows($result);



         if ($filasn<=0 ){


 

    header("location:login.php?error=error");



	         }else{



        $rowsresult=mysqli_fetch_array($result);          



        $_SESSION['idusuario']= $rowsresult['id'];
	


             $valido=true;



             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos



             $_SESSION["usuario"]=$usuariotie;



             $_SESSION["nivel"]= $rowsresult['nivel'];
              $_SESSION["estado"]= $rowsresult['estado'];

             $_SESSION["email"]= $rowsresult['email'];

             $_SESSION["nombre"]= $rowsresult['apellido'] . " " .$rowsresult['nombre'];
 
			 header("location:Sistema/index.php"); exit;



         }







		 echo "asd";



		 }







	}else{



		$_SESSION["usuario"];



		header("location:cerrar_sesion.php");



		}







		?>



