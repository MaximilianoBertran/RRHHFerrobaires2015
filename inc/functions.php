<?php
function getPlatform($user_agent) {
   $plataformas = array(
      'Windows 10' => 'Windows NT 10.0+',
      'Windows 8.1' => 'Windows NT 6.3+',
      'Windows 8' => 'Windows NT 6.2+',
      'Windows 7' => 'Windows NT 6.1+',
      'Windows Vista' => 'Windows NT 6.0+',
      'Windows XP' => 'Windows NT 5.1+',
      'Windows 2003' => 'Windows NT 5.2+',
      'Windows' => 'Windows otros',
      'iPhone' => 'iPhone',
      'iPad' => 'iPad',
      'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
      'Mac otros' => 'Macintosh',
      'Android' => 'Android',
      'BlackBerry' => 'BlackBerry',
      'Linux' => 'Linux',
   );
   foreach($plataformas as $plataforma=>$pattern){
      if (@ eregi($pattern, $user_agent))
         return $plataforma;
   }
   return 'Otras';
}

function traerDecreto($fecha){
  if($fecha == "0000-00-00"){
    $resp = "";
    return $resp;
  } else {
    if($fecha < "1994-01-01"){
      $fecha = '1995-12-29';
    }
    $rs = consultaSql("SELECT decreto FROM decretos_personal WHERE fecha = '$fecha'");
    $aux = mysqli_fetch_assoc($rs);
    
    $resp = "Dec. ".$aux['decreto'];

    return $resp;
  }
}
function convenio($esc, $cat){
  if($esc > 111 && $esc < 126){
    $gremio = "C.C.T. N° 21/75";
  } else if($esc > 200 && $esc < 224){
    $gremio = "C.C.T. N° 26/75";
  } else if($esc > 404 && $esc < 425){
    $gremio = "C.C.T. N° 27/75";
  } else if($esc == 0 && $cat > 0){
    $gremio = "";
  } else if($esc > 321 && $esc < 329 || $esc > 729 && $esc < 734){
    $gremio = "C.C.T. N° 433/75";
  } else {
    $gremio = "";
  }
  return $gremio;
}
function gremio($esc, $cat){
  if($esc > 111 && $esc < 126){
    $gremio = "UNION FERROVIARIA";
  } else if($esc > 200 && $esc < 224){
    $gremio = "LA FRATERNIDAD";
  } else if($esc > 404 && $esc < 425){
    $gremio = "ASFA";
  } else if($esc == 0 && $cat > 0){
    $gremio = "JERARQUICO";
  } else if($esc > 321 && $esc < 329 || $esc > 729 && $esc < 734){
    $gremio = "APDFA";
  } else {
    $gremio = "CONTRATADO";
  }
  return $gremio;
}
function usuedit($idusu){
	$rs = consultaSql("SELECT username FROM account WHERE id = '$idusu'");
	$aux = mysqli_fetch_assoc($rs);
	return $aux['username'];
}
function edad($fecha){
	list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
function antig_licencia($fecha){
  list($Y,$m,$d) = explode("-",$fecha);
    $m = 12;
    $d = 31;
    return( date("md") < $m.$d ? date("Y")-$Y : date("Y")-$Y );
}
function antig($fecha){
  list($Y,$m,$d) = explode("-",$fecha);
    return( 1231 < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
function verificarSqlInyect($value){
	$value = addslashes($value);
	return $value;
}
function cambioDate($fecha){
	return date("d/m/Y",strtotime($fecha));
}
function reCambioDate($fecha){
  $fecha = str_replace("/","-",$fecha);
  return date("Y-m-d",strtotime($fecha));
}
function consultaSql($sql){
	$link = @ mysqli_connect(SERVER, USER, PASSWORD, BASE);
	if(!$link){
		die(ERROR_CONEXION);	
	}
	$rs = @ mysqli_query($link, $sql);
	if(!$rs){
		die(ERROR_QUERY);	
  }
	mysqli_close($link);
	return $rs;
}
define('SEGURO', '2019-10-01');
function fechaCertLaboral(){
	$mes = date('m') - 1;
	$dia = date('d');
	/*if($dia <= 1){
		$mes = $mes -1; 
	}*/
	if($mes == 0){
		$mes = 12;
	}
	if($mes == -1){
		$mes = 11;
	}
	switch ($mes){
		case 1:
			$value = 'Enero';
			break;
		case 2:
			$value = 'Febrero';
			break;
		case 3:
			$value = 'Marzo';
			break;
		case 4:
			$value = 'Abril';
			break;
		case 5:
			$value = 'Mayo';
			break;
		case 6:
			$value = 'Junio';
			break;
		case 7:
			$value = 'Julio';
			break;
		case 8:
			$value = 'Agosto';
			break;
		case 9:
			$value = 'Septiembre';
			break;
		case 10:
			$value = 'Octubre';
			break;
		case 11:
			$value = 'Noviembre';
			break;
		case 12:
			$value = 'Diciembre';
			break;
	}
	return $value;
}
function dameFecha($fecha,$dia)
{	list($year,$mon,$day) = explode('-',$fecha);
	return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));		
}
define('VENCIMIENTO', '2019-07-12');

function dias_transcurridos($fecha_i,$fecha_f)
{

	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); 
  $dias = round($dias, 0);
  //$dias = floor($dias);	
	return $dias+1;
}

class EnLetras 
{ 
  var $Void = ""; 
  var $SP = " "; 
  var $Dot = "."; 
  var $Zero = "0"; 
  var $Neg = "Menos"; 

  
function ValorEnLetras($x, $Moneda )  
{ 
    $s=""; 
    $Ent=""; 
    $Frc=""; 
    $Signo=""; 
         
    if(floatVal($x) < 0) 
     $Signo = $this->Neg . " "; 
    else 
     $Signo = ""; 
     
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales 
      $s = number_format($x,2,'.',''); 
    else 
      $s = number_format($x,2,'.',''); 
        
    $Pto = strpos($s, $this->Dot); 
         
    if ($Pto === false) 
    { 
      $Ent = $s; 
      $Frc = $this->Void; 
    } 
    else 
    { 
      $Ent = substr($s, 0, $Pto ); 
      $Frc =  substr($s, $Pto+1); 
    } 

    if($Ent == $this->Zero || $Ent == $this->Void) 
       $s = "Cero "; 
    elseif( strlen($Ent) > 7) 
    { 
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) .  
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6))); 
    } 
    else 
    { 
      $s = $this->SubValLetra(intval($Ent)); 
    } 

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ") 
       $s = $s . "de "; 

    $s = $s . $Moneda; 

    if($Frc != $this->Void) 
    { 
       $s = $s . " " . $Frc. "/100"; 
       //$s = $s . " " . $Frc . "/100"; 
    } 
    $letrass=$Signo . $s ; 
    return ($Signo . $s ); 
    
} 

function SubValLetra($numero)  
{ 
    $Ptr=""; 
    $n=0; 
    $i=0; 
    $x =""; 
    $Rtn =""; 
    $Tem =""; 

    $x = trim("$numero"); 
    $n = strlen($x); 

    $Tem = $this->Void; 
    $i = $n; 
     
    while( $i > 0) 
    { 
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1).  
                           str_repeat($this->Zero, $i - 1 ))); 
       If( $Tem != "Cero" ) 
          $Rtn .= $Tem . $this->SP; 
       $i = $i - 1; 
    } 

     
    //--------------------- GoSub FiltroMil ------------------------------ 
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn ); 
    while(1) 
    { 
       $Ptr = strpos($Rtn, "Mil ");        
       If(!($Ptr===false)) 
       { 
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false )) 
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr); 
          Else 
           break; 
       } 
       else break; 
    } 

    //--------------------- GoSub FiltroCiento ------------------------------ 
    $Ptr = -1; 
    do{ 
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1); 
       if(!($Ptr===false)) 
       { 
          $Tem = substr($Rtn, $Ptr + 5 ,1); 
          if( $Tem == "M" || $Tem == $this->Void) 
             ; 
          else           
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr); 
       } 
    }while(!($Ptr === false)); 

    //--------------------- FiltroEspeciales ------------------------------ 
    $Rtn=str_replace("Diez Un", "Once", $Rtn ); 
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn ); 
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn ); 
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn ); 
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn ); 
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn ); 
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn ); 
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn ); 
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn ); 
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn ); 
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn ); 
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn ); 
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn ); 
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn ); 
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn ); 
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn ); 
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn ); 
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn ); 

    //--------------------- FiltroUn ------------------------------ 
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn; 
    //--------------------- Adicionar Y ------------------------------ 
    for($i=65; $i<=88; $i++) 
    { 
      If($i != 77) 
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn); 
    } 
    $Rtn=str_replace("*", "a" , $Rtn); 
    return($Rtn); 
} 


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr) 
{ 
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr); 
} 


function Parte($x) 
{ 
    $Rtn=''; 
    $t=''; 
    $i=''; 
    Do 
    { 
      switch($x) 
      { 
         Case 0:  $t = "Cero";break; 
         Case 1:  $t = "Uno";break; 
         Case 2:  $t = "Dos";break; 
         Case 3:  $t = "Tres";break; 
         Case 4:  $t = "Cuatro";break; 
         Case 5:  $t = "Cinco";break; 
         Case 6:  $t = "Seis";break; 
         Case 7:  $t = "Siete";break; 
         Case 8:  $t = "Ocho";break; 
         Case 9:  $t = "Nueve";break; 
         Case 10: $t = "Diez";break; 
         Case 20: $t = "Veinte";break; 
         Case 30: $t = "Treinta";break; 
         Case 40: $t = "Cuarenta";break; 
         Case 50: $t = "Cincuenta";break; 
         Case 60: $t = "Sesenta";break; 
         Case 70: $t = "Setenta";break; 
         Case 80: $t = "Ochenta";break; 
         Case 90: $t = "Noventa";break; 
         Case 100: $t = "Cien";break; 
         Case 200: $t = "Doscientos";break; 
         Case 300: $t = "Trescientos";break; 
         Case 400: $t = "Cuatrocientos";break; 
         Case 500: $t = "Quinientos";break; 
         Case 600: $t = "Seiscientos";break; 
         Case 700: $t = "Setecientos";break; 
         Case 800: $t = "Ochocientos";break; 
         Case 900: $t = "Novecientos";break; 
         Case 1000: $t = "Mil";break; 
         Case 1000000: $t = "Millón";break; 
      } 

      If($t == $this->Void) 
      { 
        $i = $i + 1; 
        $x = $x / 1000; 
        If($x== 0) $i = 0; 
      } 
      else 
         break; 
            
    }while($i != 0); 
    
    $Rtn = $t; 
    Switch($i) 
    { 
       Case 0: $t = $this->Void;break; 
       Case 1: $t = " Mil";break; 
       Case 2: $t = " Millones";break; 
       Case 3: $t = " Billones";break; 
    } 
    return($Rtn . $t); 
} 

} 
?>