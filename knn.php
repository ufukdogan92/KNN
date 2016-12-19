<?php
include("readCSV.php");
 
//unset($rows[0]); // title elamanları diziden silindi

function elemanEkle($file,$x,$y,$k){
    $rows = readCSV($file);
    $eleman[0]=$x;
    $eleman[1]=$y;
     
    $uzakliklar=array();
    foreach($rows as $key => $row){ 
        if($key==0) continue;

        $x= $row[0]-$eleman[0];
        $y= $row[1]-$eleman[1];

        $sonuc = sqrt($x*$x+$y*$y); 

        $uzakliklar[$key][0]=$sonuc ;
        $uzakliklar[$key]["cluster"]=$row[2] ;

    }
 
    sort($uzakliklar); 
    $iyi=0;
    $kotu=0;
    $orta=0;
    for($i=0;$i<$k;$i++){
        if($uzakliklar[$i]["cluster"]=="iyi")
            $iyi=$iyi+1; 
        else if($uzakliklar[$i]["cluster"]=="kötü")
            $kotu=$kotu+1;
        else
            $orta=$orta+1;   
    }
    
    if($iyi>$kotu && $iyi>$orta)
        $kume = "iyi";

    else if($kotu>$iyi && $kotu>$orta)
        $kume = "kötü";
    else $kume = "orta";

    $eleman[2]= $kume; 

    $rows[count($rows)]=$eleman; 

    addCSV($rows,"file.csv");
    return $kume;
}
$x=2;
$y=1;
$k=3;
echo "eleman ".elemanEkle("file.csv",$x,$y,$k)." kümesine eklendi";


 


