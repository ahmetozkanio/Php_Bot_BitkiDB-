<?php
include 'fonksiyon.php';
set_time_limit(0);
//MySql baglantisi
$baglanti = mysqli_connect("localhost", "root", "ozkan", "bitkivt");


if (!$baglanti) {
    die("Veri Tabanı Bağlantısı Başarısız: " . mysqli_connect_error());
  }



$url = "https://www.bitkivt.itu.edu.tr/en/";//genel link sayfasi
$parcala = '@<a  target="_blank" href=(.*?)>@si';// hedef linklerin hepsini aldigimiz bolum
$botUrl = file_get_contents($url);
preg_match_all($parcala,$botUrl,$sonuc);

$say=count($sonuc[1]);//link sayisini aliyoruz for dongusu icin


//https://www.bitkivt.itu.edu.tr/vt/report.php?sor=510
//linkteki sor id'lerini alip id olarak veritabanina eklenecek dongude
$sor = '@sor=(.*?)>@si';
preg_match_all($sor,$botUrl,$sorid);

//1 kerelik deneme icin tek link halinde kullaniyoruz
//for dongusu icinde $botlink degeri degisiyor  
$botLink =file_get_contents("https://www.bitkivt.itu.edu.tr/vt/report.php?sor=510");


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