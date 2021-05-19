<?PHP

if(!function_exists("zeit_wandel")){
function zeit_wandel($welche){
	$dat = explode("-",$welche);
	$welche = $dat[2].".".$dat[1].".".$dat[0];
	return $welche;
}
}

if(!function_exists("bild_hochladen")){
function bild_hochladen($datei,$temp,$ordner="img")
{ 
				$datei = str_replace(" ","",$datei);
				$datei = str_replace("(","",$datei);
				$datei = str_replace(")","",$datei);
				$datei = str_replace("-","",$datei);
                $datei = str_replace("ä","ae",$datei);
                $datei = str_replace("ö","oe",$datei);
                $datei = str_replace("ü","ue",$datei);
                $datei = str_replace("ß","ss",$datei);
                $datei = str_replace("Ä","ae",$datei);
                $datei = str_replace("Ö","oe",$datei);
                $datei = str_replace("Ü","ue",$datei);
	
				$handel = opendir($ordner);
                $anzahl = 0;
                while($file = readdir($handel)){
                if($file != "." && $file != ".."){
                    $anzahl++;
                    break;
		          }
	           }
	           closedir($handel);
		
			
        	if($anzahl){
        		$imga = $ordner."/".$datei;
				
        		$anzahl=0;
        		while(file_exists($imga)){
        			$img = $datei;
                    $teile = pathinfo($img);
        			$img = $teile['filename'].$anzahl.".".$teile['extension'];
        			$anzahl++;
        			$imga = $ordner."/".$img;
        		}
        		unset($anzahl);
                
        		if(!empty($img)){
        			$datei = $img;
        		}
            }
    
            $datei = $ordner."/".$datei;
            move_uploaded_file($temp,$datei);

	return $datei;
}
}

if(!function_exists("no_spam")){
function no_spam($mail) {
	$str = "";
	$a = unpack("C*", $mail);
	
	foreach ($a as $b)
	 $str .= sprintf("%%%X", $b);
	
	return $str;
   }
}

if(!function_exists("VPassword")){
function VPassword($password, $salt)
{
     return hash('sha256', $password . $salt);
}
}



?>
