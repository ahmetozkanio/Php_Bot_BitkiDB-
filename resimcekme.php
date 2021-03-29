<?php
include 'fonksiyon.php';
include 'main.php';

/* Diziyi yazdirir
echo "<pre>";
print_r($sonuc[1]);
echo "</pre>";
*/
//Fotograflar Tablosu

//resmin adresi
$foto1 = '@<img src="(.*?)"@si';
//resmin uzantisi
$fotoid = '@<img src="http://www.bitkivt.itu.edu.tr/foto/(.*?)"@si';

preg_match_all($foto1,$botLink,$satir1);
$sayi = count($satir1[1]);
$resim1 = addslashes($satir1[1][2]);



trim($resim1);
    $resimyeni =SeoYap($resim1);

  preg_match_all($fotoid,$botLink,$foto);
   $resimuzanti = addslashes($foto[1][0]);


  $dosya ='image/'.$resimuzanti;

  $veri = file_get_contents($resimyeni);
  $kayit = fopen($dosya,"w+");
  fwrite($kayit,$veri);
  fclose($kayit);








for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);



}




?>