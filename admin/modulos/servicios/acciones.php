<?php
	$modulo='servicios';
	$modulopic=$modulo.'pic';
	$modulovideos=$modulo.'videos';
	$modulomain=$modulo.'main';
	$rutaFinal='../img/contenido/'.$modulo.'/';

//    Artículo Nuevo                    
	if(isset($_POST['nuevo'])){ 
		// Actualizamos la base de datos
		if(!isset($fallo)){
			$sql = "INSERT INTO $modulo (fecha) VALUES ('$hoy')";
			if($insertar = $CONEXION->query($sql)){
				$exito=1;
				$legendSuccess .= "<br>servicios nuevo";
				$editarNuevo=1;
				$id=$CONEXION->insert_id;
				$archivo='detalle';
			}else{
				$fallo=1;  
				$legendFail .= "<br>No se pudo agregar a la base de datos - $cat";
			}
		}else{
			$legendFail .= "<br>La categoría o marca están vacíos.";
		}
	}

//    Video Nuevo                    
	if(isset($_POST['videos'])){ 
		// Obtenemos los valores enviados
		if (isset($_POST['id'])) { $video=$_POST['id'];   }else{	$video=false; $fallo=1; }

		$url = $_POST['url'];

		// Actualizamos la base de datos
		if($video!=""){
			$sql = "INSERT INTO serviciovideos (servicio,url) VALUES ('$video','$url')";
			if($insertar = $CONEXION->query($sql)){
				$cat = $CONEXION->insert_id;
				$exito=1;
				$legendSuccess .= "<br>Nuevo video";
			}
		}else{
			$fallo=1;  
			$legendFail .= "<br>El campo está vacío";
		}
	}
	
//    Borrar Videos                 
	if(isset($_REQUEST['borrarvideos'])){
		include '../../../includes/connection.php';

		$id = $_POST['id'];
		$borrar = $CONEXION->query("DELETE FROM $modulovideos WHERE id = $id");
	}

//    Artículo Editar                   
	if(isset($_REQUEST['editar']) OR isset($editarNuevo)) {
		// Obtenemos los valores enviados

		$fallo=1;  
		$legendFail .= "<br>No se pudo modificar la base de datos";
		foreach ($_POST as $key => $value) {
			if ($key=='txt' OR $key == 'txt2') {
				$dato = trim(str_replace("'", "&#039;", $value));
			}else{
				$dato = trim(htmlentities($value, ENT_QUOTES));
			}
			if ($actualizar = $CONEXION->query("UPDATE $modulo SET $key = '$dato' WHERE id = $id")) {
				$exito=1;
				if (isset($fallo)) {
					unset($fallo);
				}
			}
		}

		if (isset($exito)) {
			header('location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id);
		}
	}

//    Artículo Borrar                   
	if(isset($_REQUEST['borrarPod'])){
		$consulta= $CONEXION -> query("SELECT * FROM $modulopic WHERE servicio = $id");
		while ($rowConsulta = $consulta-> fetch_assoc()) {
			$picID=$rowConsulta['id'];
			// Borramos el archivo de imagen
			$rutaIMG="../img/contenido/".$modulo."/";
			$filehandle = opendir($rutaIMG); // Abrir archivos
			while ($file = readdir($filehandle)) {
				if ($file != "." && $file != "..") {
					// Id de la imagen
					if (strpos($file,'-')===false) {
						$imagenID = strstr($file,'.',TRUE);
					}else{
						$imagenID = strstr($file,'-',TRUE);
					}
					// Comprobamos que sean iguales
					if($imagenID==$picID){
						$pic=$rutaIMG.$file;
						$exito=1;
						unlink($pic);
					}
				}
			}
		}

		if($borrar = $CONEXION->query("DELETE FROM $modulo WHERE id = $id")){
			$borrar = $CONEXION->query("DELETE FROM $modulopic WHERE servicios = $id");
			$exito=1;
			$legendSuccess .= "<br>servicio eliminado";
		}else{
			$legendFail .= "<br>No se pudo borrar de la base de datos";
			$fallo=1;  
		}
	}



//    Subir foto galería                
	if(isset($_FILES["uploadedfile"])){
		include '../../../includes/connection.php';
		$rutaFinal = '../../../img/contenido/'.$modulo.'/';

		$id=$_GET['id'];
		$sql = "INSERT INTO $modulopic (seccion) VALUES ($id)";
		if($insertar = $CONEXION->query($sql)){
			$picId=$CONEXION->insert_id;

			$ret = array();
			
			$error = $_FILES["uploadedfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES["uploadedfile"]["name"])) //single file
			{
		 	 	$archivoInicial = $_FILES["uploadedfile"]["name"];
				$i = strrpos($archivoInicial,'.');
				$l = strlen($archivoInicial) - $i;
				$ext = strtolower(substr($archivoInicial,$i+1,$l));
				$ext = ($ext=='jpeg')?'jpg':$ext;

		 	 	$archivoFinal  =$picId.'.'.$ext;
		 		move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],$rutaFinal.$archivoFinal);
		    	$ret[]= $archivoFinal;
			}
			else  //Multiple files, file[]
			{
			  $fileCount = count($_FILES["uploadedfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
			  	$archivoInicial = $_FILES["uploadedfile"]["name"][$i];
				$i = strrpos($archivoInicial,'.');
				$l = strlen($archivoInicial) - $i;
				$ext = strtolower(substr($archivoInicial,$i+1,$l));
				$ext = ($ext=='jpeg')?'jpg':$ext;

			  	$archivoFinal  =$picId.'.'.$ext;
				move_uploaded_file($_FILES["uploadedfile"]["tmp_name"][$i],$rutaFinal.$archivoFinal);
			  	$ret[]= $archivoFinal;
			  }
			}
			//$actualizar = $CONEXION->query("UPDATE $modulopic SET file = '$archivoFinal' WHERE id = $picId");
			echo json_encode($ret);



		    // %%%%%%%%%%%%%%%%%%%
		    //    MINIATURAS
		    // %%%%%%%%%%%%%%%%%%%
				$xs=1;
				$sm=1;
				$lg=1;

				// Leer el archivo para hacer la nueva imagen
				$original = imagecreatefromjpeg($rutaFinal.$archivoFinal);

				// Tomamos las dimensiones de la imagen original
				$ancho  = imagesx($original);
				$alto   = imagesy($original);


				if ($xs==1) {
					//  Imagen xs
					$miniaturaName=$rutaFinal.$picId."-xs.jpg";
					$anchoNuevo = 80;
					$altoNuevo  = $anchoNuevo*$alto/$ancho;

					// Creamos la imagen
					$archivoFinal = imagecreatetruecolor($anchoNuevo,$altoNuevo); 
					// Copiamos el inicio de la original para pegarlo en el archivo nuevo
					imagecopyresampled($archivoFinal,$original,0,0,0,0,$anchoNuevo,$altoNuevo,$ancho,$alto);
					// Pegamos el inicio de la imagen
					if(imagejpeg($archivoFinal,$miniaturaName,90)){ // 90 es la calidad de compresión
						$exito=1;
					}
				}

				if ($sm==1) {
					//  Imagen sm
					$miniaturaName=$rutaFinal.$picId."-sm.jpg";
					$anchoNuevo = 400;
					$altoNuevo  = $anchoNuevo*$alto/$ancho;

					// Creamos la imagen
					$archivoFinal = imagecreatetruecolor($anchoNuevo,$altoNuevo); 
					// Copiamos el inicio de la original para pegarlo en el archivo nuevo
					imagecopyresampled($archivoFinal,$original,0,0,0,0,$anchoNuevo,$altoNuevo,$ancho,$alto);
					// Pegamos el inicio de la imagen
					if(imagejpeg($archivoFinal,$miniaturaName,90)){ // 90 es la calidad de compresión
						$exito=1;
					}
				}

				if ($lg==1) {
					//  Imagen lg
					$miniaturaName=$rutaFinal.$picId."-lg.jpg";
					if ($ancho>$alto) {
						$anchoNuevo = 1000;
						$altoNuevo  = $anchoNuevo*$alto/$ancho;
					}else{
						$altoNuevo  = 1000;
						$anchoNuevo = $altoNuevo*$ancho/$alto;
					}

					// Creamos la imagen
					$archivoFinal = imagecreatetruecolor($anchoNuevo,$altoNuevo); 
					// Copiamos el inicio de la original para pegarlo en el archivo nuevo
					imagecopyresampled($archivoFinal,$original,0,0,0,0,$anchoNuevo,$altoNuevo,$ancho,$alto);
					// Pegamos el inicio de la imagen
					if(imagejpeg($archivoFinal,$miniaturaName,90)){ // 90 es la calidad de compresión
						$exito=1;
					}
				}

		}
	}

//    Borrar foto galería               
	if(isset($_POST['borrarfoto'])){
		include '../../../includes/connection.php';
		$rutaFinal='../../../img/contenido/'.$modulo.'/';
		$id=$_POST['id'];
		// Borramos el archivo de imagen
		$filehandle = opendir($rutaFinal); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != "..") {
				// Id de la imagen
				if (strpos($file,'-')===false) {
					$imagenID = strstr($file,'.',TRUE);
				}else{
					$imagenID = strstr($file,'-',TRUE);
				}
				// Comprobamos que sean iguales
				if($imagenID==$id){
					$pic=$rutaFinal.$file;
					$exito=1;
					unlink($pic);
				}
			}
		}

		$borrar = $CONEXION->query("DELETE FROM $modulopic WHERE id = $id");
		if(isset($exito)){
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; No se pudo borrar</div>";
		}
	}

//    Borrar Foto Redes                 
	if(isset($_REQUEST['borrarpicredes'])){
		$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
		$row_CONSULTA = $CONSULTA -> fetch_assoc();
		if (strlen($row_CONSULTA['imagen'])>0) {
			unlink($rutaFinal.$row_CONSULTA['imagen']);
			$actualizar = $CONEXION->query("UPDATE $modulo SET imagen = '' WHERE id = $id");
			$exito=1;
			$legendSuccess.='<br>Foto eliminada';
		}else{
			$legendFail .= "<br>No se encontró la imagen en la base de datos";
			$fallo=1;
		}
	}

//    Borrar Videos                 
	if(isset($_REQUEST['borrarvideos'])){
		$id = $_POST['id'];
		if($borrar = $CONEXION->query("DELETE FROM $modulovideos WHERE id = $id")){
			$exito = 1;
			$legendSuccess .= "<br>Video Eliminado";
		}else{
			$legendFail .= "<br>No se pudo borrar de la base de datos";
			$fallo = 1;  
		}
	}

//    Subir varios tipos de imagen      
	if(isset($_GET['filename'])){
		$imagenName  = $_REQUEST['filename'];
		$position    = $_GET['position'];
		$rutaInicial = '../library/upload-file/php/uploads/';
		$fallo       = 1;

		//Obtenemos la extensión de la imagen
		$i = strrpos($imagenName,'.');
		$l = strlen($imagenName) - $i;
		$ext = strtolower(substr($imagenName,$i+1,$l));


		if(file_exists($rutaInicial.$imagenName)){
			if ($position=='gallery') { // Imágenes de la galería
				$sql = "INSERT INTO $modulopic (seccion) VALUES ($id)";
				$insertar = $CONEXION->query($sql);
				$pic=$CONEXION->insert_id;
				$imgAux=$rutaFinal.$pic.'.jpg';
				copy($rutaInicial.$imagenName, $imgAux);

				$original = imagecreatefromjpeg($imgAux);
				$ancho  = imagesx($original);
				$alto   = imagesy($original);

				$newName=$pic."-sm.jpg";
				$anchoNuevo = 300;
				$altoNuevo  = $anchoNuevo*$alto/$ancho;

				// Creamos la imagen
				$imagenAux = imagecreatetruecolor($anchoNuevo,$altoNuevo); 
				// Copiamos el inicio de la original para pegarlo en el archivo nuevo
				imagecopyresampled($imagenAux,$original,0,0,0,0,$anchoNuevo,$altoNuevo,$ancho,$alto);
				// Pegamos el inicio de la imagen
				if(imagejpeg($imagenAux,$rutaFinal.$newName,90)){ // 90 es la calidad de compresión
					$exito=1;
					unset($fallo);
				}
				
			}elseif($position=='main'){ // Imagen para compartir
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen']);
				}
				$legendFail.='<br>Fail - '.$position;

				if (copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal)) {
					$sigue=1;
				}
		
				if (isset($sigue)) {
					if ($actualizar = $CONEXION->query("UPDATE $modulo SET imagen = '$imgFinal' WHERE id = $id")) {
						unset($fallo);
						$exito=1;
					}
				}

			}
		}else{
			$fallo=1;
			$legendFail='<br>No se permite refrescar la página.';
		}


		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// Borramos las imágenes que estén remanentes en el directorio files
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		$filehandle = opendir($rutaInicial); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != ".." && $file != ".gitignore" && $file != ".htaccess" && $file != "thumbnail") {
				if(file_exists($rutaInicial.$file)){
					//echo $ruta.$file.'<br>';
					unlink($rutaInicial.$file);
				}
			}
		} 
		closedir($filehandle); 
	}

