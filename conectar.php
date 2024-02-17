<?php header("Content-Type: text/html; charset=UTF-8");
$mysqli = new mysqli("localhost","root","","aula"); $mysqli->select_db("aula"); $mysqli->query("SET NAMES 'utf8'");  

function filtroInyeccion($valor){  //	$valor = strtoupper($valor); 
 	$valor = str_ireplace("INSERT ","",$valor);	$valor = str_ireplace("INTO ","",$valor);	$valor = str_ireplace("JOIN ","",$valor);	$valor = str_ireplace("WHERE ","",$valor);	$valor = str_ireplace("FROM ","",$valor);	$valor = str_ireplace("SELECT ","",$valor);		$valor = str_ireplace("COPY ","",$valor);	$valor = str_ireplace("DELETE ","",$valor);	$valor = str_ireplace("DROP ","",$valor);		$valor = str_ireplace("DUMP ","",$valor);		$valor = str_ireplace(" OR ","",$valor);		$valor = str_ireplace("%","",$valor);		$valor = str_ireplace("LIKE ","",$valor);		$valor = str_ireplace("--","",$valor);		$valor = str_ireplace("^","",$valor);		$valor = str_ireplace("[","",$valor);		$valor = str_ireplace("]","",$valor);		$valor = str_ireplace("\\","",$valor);		

//	$valor = str_ireplace("!","",$valor);	


	$valor = str_ireplace("?","",$valor);		$valor = str_ireplace("=","",$valor);		$valor = str_ireplace("&","",$valor);  		$valor = trim($valor); $valor = addslashes($valor);
	return $valor; }
    function upload_image($destination_dir,$name_media_field,$intfecha){

        $tmp_name = $_FILES[$name_media_field]['tmp_name'];

        //si hemos enviado un directorio que existe realmente y hemos subido el archivo    

        if ( is_dir($destination_dir) && is_uploaded_file($tmp_name)) 

        {        

            $img_file  = $_FILES[$name_media_field]['name'] ;                      

            $img_type  = $_FILES[$name_media_field]['type'];   

            //echo 1; 

            //?es una im?gen realmente?           

            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,"jpg")) || strpos($img_type,"png") )){

                //?Tenemos permisos para subir la im?gen?

               // echo 2;

                if(move_uploaded_file($tmp_name, $destination_dir.'/'. $intfecha)){                

                  //  return true;

                }

            }

        }

        //si llegamos hasta aqu? es que algo ha fallado

      //  return false; 

    }//end function
?>