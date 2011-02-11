<?php
	// Iniciamos el uso de variables de session
	session_start();
	
	// Librería para manipulación de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
		
//Guardar los insumos seleccionados en cargar-insumos-poa.php
	
	// Ordenamos el arreglo se $_SESSION por clave
	//krsort($_SESSION);
	//echo " guardar-insumos-poa.php<p>";
	
	// Mostramos todas las variables de session;
	/*do{
		echo "".key($_SESSION)."<br>";
	}while(next($_SESSION));
	echo "<br>";
	
	header("location: pruebacss/mvs.php");
	exit();*/
	
	
	//$_SESSION;
	
	// Inicializamos el indice de los arreglos además de estos
	$i=0;	
	
	$insumos=array();
	$cantidades=array();
	
	//echo "count session ".count($_SESSION)."<br>";
	//echo "session accion-cargar ".$_SESSION['accion-cargar']."<br>";
	
	/*krsort($_SESSION);
	
	do{
		echo "".key($_SESSION)."<br>";
	}while(next($_SESSION));
	echo "<br>";*/
	
	// Iniciamos ciclo
	do{ 
		// Inicializamos la bandera

		// Aquí solo guardaremos las variables de session que tengan el formato de Accion-Insumo-Cantidad
		//echo "Se compara esto [".key($_SESSION)."] con esto [".$_SESSION['accion-cargar']."]<br>";
		if(substr(key($_SESSION),0,strlen($_SESSION['accion-cargar']))==$_SESSION['accion-cargar']){
			$ban=true;
			//Si ban es igual a false significa que ya se habia guardado el insumo
			if(ban){
				$insumos[$i]=current($_SESSION);
				//echo "Se guardó la siguiente id_insumo correctamente = ".current($_SESSION)."<br>";
			}
next($_SESSION);
			$ban=true;
			
			$cantidades[$i][1]=current($_SESSION);
			//echo "Se guardó la siguiente cantidad individual correctamente = ".current($_SESSION)."<br>";
next($_SESSION);
			
			//Guardamos los primero digitos del insumo que se guardo al principio del if(sbrtr
			$comp=$_SESSION['accion-cargar'].$insumos[$i];
			
			//Si entra aquí significa que solo tiene una cantidad y por lo tanto current session actul tiene el siguiente insumo
			if($comp!=substr(key($_SESSION),0,strlen($comp))){
				//echo "Se guardó la siguiente id_insumo correctamente en el if = ".current($_SESSION)."<br>";
				$insumos[$i+1]=current($_SESSION);
				$ban=false;
prev($_SESSION);
			}else{
				$cantidades[$i][0]=current($_SESSION);
				//echo "Se guardó la siguiente cantidad mas la individual = ".current($_SESSION)."<br>";
			}
			$i++;
		}

	}while(next($_SESSION));
	
	
	/*for($i=0;$i<count($insumos);$i++)
		echo $insumos[$i]."=[".$cantidades[$i][0]."][".$cantidades[$i][1]."]<br>";*/
		
	
	// Ejecutamos el procedimiento para saber el Id_Insumo_Accion
	$error=$proc->guardarInsumosPOA($_SESSION['nick'],$_SESSION['accion-cargar'],$insumos,$cantidades);
	
	//echo $error;
	
	// Redireccionamos a poa.php
	header('location: poa.php#pe')

?>