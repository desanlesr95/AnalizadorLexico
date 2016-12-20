<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tabla de simbolos del lenguaje WE</title>
	<style>
		table, th, td {
			border: 1px solid black;
		}
		.centro {
			position: relative;
			left: 25%;
		}
	</style>
</head>
<body>
	<h1 class="centro">Analizador lexico de lenguaje WE</h1>
	<form action="" method="post">
		<input class="centro" name="boton" type="submit" value="Analizar">
	</form>
</body>
</html>
<?php

	/*
	------------------INTEGRANTES:-------------------------------------
	SAN JUAN AARON LOREDO RINCON
	YADIRA BLAS DAMIANO
	LUIS ENRIQUE SANCHEZ RAMIREZ
	SANDRA BEATRIZ MARTINEZ MEDINA
	-------------------------------------------------------------------
	*/






	
	error_reporting(0);
	$mysqli = new mysqli("localhost", "root", "", "lexicos");
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		else{
			
		}
	$codigo[]=array();
	$separado[]=array();
	$cont=0;
	$cont2=0;
	$ya=0;
	if(isset($_POST['boton'])){
		$fp=fopen('archivo.txt',"r");
		$i=0;
		while(!feof($fp)) {
			$codigo[$i] = fgets($fp);
			//echo $codigo[]."<br />";
			$i++;
		}
		fclose($fp);
		for($j=0;$j<$i;$j++){
			//echo $codigo[$j];
			for($k=0;$k<strlen($codigo[$j]);$k++){
				//echo $codigo[$j][$k]."</br>";
				if(strcmp($codigo[$j][$k]," ")==0||strcmp($codigo[$j][$k],"\n")==0){
					$cont2=0;
					$cont++;
				}
				else{ 
					switch($codigo[$j][$k]){
						case ";":case ".":case ",":case "-":case "{":case "}":case "[":case "]":case "^":case "+":case "*":case "(":case ")":case "<":case ">":case "=":
						case "\'":case "\"":{
							if($ya==1){
								if((strcmp($codigo[$j][$k],">")==0&&strcmp($separado[$cont][$cont2-1],"-")==0)||(strcmp($codigo[$j][$k],">")==0&&strcmp($separado[$cont][$cont2-1],"<")==0)
								||(strcmp($codigo[$j][$k],">")==0&&strcmp($separado[$cont][$cont2-1],"-")==0)){
									$separado[$cont][$cont2]=$codigo[$j][$k];
									$cont2=0;
									$cont++;
									$ya=0;
								}
								else{
									$cont++;
									$cont2=0;
									$separado[$cont][$cont2]=$codigo[$j][$k];
									$cont2++;
									$ya=0;
								}
							}
							else{
								$cont++;
								$cont2=0;
								$separado[$cont][$cont2]=$codigo[$j][$k];
								$cont2++;
								$ya=0;
								$cont++;
							}
						}
						break;
						break;
						default:{
							if($ya==1){
								$cont++;
								$cont2=0;
								$ya=0;
								$separado[$cont][$cont2]=$codigo[$j][$k];
								$cont2++;
							}
							else{
								$separado[$cont][$cont2]=$codigo[$j][$k];
								$cont2++;
							}
						}
					}
				}
			}
		}
		//var_dump($separado);
		//Conexion a la base de datos
		$username="root";
		$password="";
		$dbhost="localhost";
		$dbname="lexicos";
		$cont=0;
		try {
				$db = new PDO('mysql:host=localhost;dbname=lexicos',$username,$password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES UTF8');
				echo "<table class=\"centro\">
						<tr>
							<th>Componente lexico</th>
							<th>Clase</th>
							<th>Tipo</th>
						</tr>
					  ";
				for($i=0;$i<count($separado);$i++){
					$linea=implode($separado[$i]);
					$linea=trim($linea," ");
					//echo $linea."</br>";
					if(!empty($linea)){
						$query=$db->prepare("SELECT * FROM componentes WHERE componente=?");
						$query->setFetchMode(PDO::FETCH_OBJ);
						$query->execute(array($linea));
						$com = $query->fetch();
						if(empty($com)){
							//echo "no es compoente";
							if(is_numeric($linea)){
									$query2=$db->prepare("SELECT * FROM componentes WHERE componente='CONSTANTES ENTERAS'");
									$query2->setFetchMode(PDO::FETCH_OBJ);
									$query2->execute();
									$enteros = $query2->fetch();
									echo "<tr><td>".$enteros->componente.":".$linea."</td>"."<td>".$enteros->clase."</td>"."<td>".$enteros->tipo."</tr>";
							}
							else{
								$query3=$db->prepare("SELECT * FROM componentes WHERE componente='IDENTIFICADORES'");
								$query3->setFetchMode(PDO::FETCH_OBJ);
								$query3->execute();
								$iden = $query3->fetch();
								if(!strlen($linea)!=0){
										echo "<tr><td>".$linea."(IDENTIFICADORES)</td>"."<td>".$iden->clase."</td>"."<td>".$iden->tipo."</tr>";
								}
							}
						}
						else{
							if($com->clase==1){
									echo "<tr><td>".$com->componente." (PALABRAS RESERVADAS)</td>"."<td>".$com->clase."</td>"."<td>".$com->tipo."</tr>";
							}
							else{
									echo "<tr><td>".$linea."</td>"."<td>".$com->clase."</td>"."<td>".$com->tipo."</br>";
							}
						}
						$cont++;
					}
				}
				echo "</table>";
			}
		catch(PDOException $e){
				echo "Conexion fallida: " . $e->getMessage();
		}
	}
?>