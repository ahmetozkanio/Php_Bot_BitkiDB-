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
$botLink =file_get_contents("https://www.bitkivt.itu.edu.tr/vt/report.php?sor=122");


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
/*
preg_match_all($foto1,$botLink,$satir1);

  $resim1 =$satir1[1][9];echo "<pre>";
        print_r($resim1) ;echo "</pre>";
          preg_match_all($fotoid,$botLink,$foto);
           $resimuzanti = $foto[1][0];

           
        
          $dosya ='image/'.$resimuzanti;
           //fotograf indirme fonksiyonu
    
          
           function curl_put_contents($resimlink,$saveto){
            $ch = curl_init ($resimlink);
            curl_setopt($ch, CURLOPT_HEADER, 0);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                 $raw=curl_exec($ch);
               curl_close ($ch);
              if(file_exists($saveto)){
                 unlink($saveto);
                   }
                   $fp = fopen($saveto,'x','w+');
                   fwrite($fp, $raw);
                   fclose($fp);
        }$res ="https://www.bitkivt.itu.edu.tr/foto/Aesculus_hippocastanum_yaprak3.jpg";
           curl_put_contents("$res",$dosya);
        

*/
for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);
    preg_match_all($foto1,$botLink,$satir1);
    $sayi = count($satir1[1]);
    
    for($j=0;$j<$sayi;$j++){
        
         $resim1 = addslashes($satir1[1][$j]);
        trim($resim1);
          preg_match_all($fotoid,$botLink,$foto);
           $resimuzanti = addslashes($foto[1][$j]);


          $dosya ='image/'.$id.'/'.$resimuzanti;
         
    
          $resimyeni =SeoYap($resim1);

       

      $sql = "INSERT INTO fotograflar (bitki_id,resim_uzanti) 
      VALUES ('$id','$resimyeni')";
      

                echo "</br>";
                if ($baglanti->query($sql) === TRUE) 
                {
                     echo "Veritabanına veri eklendi";
    
                } 
                else 
                 {
                        echo "Hata: " . $sql. "<br>" . $baglanti->error;
                  }

    }
}



/*

for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);
  

//10 tane resme kadar cekecek veritabanina yoksa null atanacak
preg_match_all($foto1,$botLink,$satir1);
$resim1 = addslashes($satir1[1][0]);
$resim2 = addslashes($satir1[1][1]);
$resim3 = addslashes($satir1[1][2]);
$resim4 = addslashes($satir1[1][3]);
$resim5 = addslashes($satir1[1][4]);
$resim6 = addslashes($satir1[1][5]);
$resim7 = addslashes($satir1[1][6]);
$resim8 = addslashes($satir1[1][7]);
$resim9 = addslashes($satir1[1][8]);
$resim10 = addslashes($satir1[1][9]);



}*/








/*
//Diger Bilgiler Tablosu
$digerbilgiler1 = '@<tr><th width="100">Büyüme Hızı</th><td width="150">
(.*?)</td><th width="100">Bakım İhtiyacı</th><td>
(.*?)</td></tr>@si';

$digerbilgiler2 = '@<tr><th width="100">Zehirlilik</th><td>
(.*?)</td><th width="100">Üretimi</th>

<td>
(.*?)</td></tr></td></tr>@si';


for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($digerbilgiler1,$botLink,$satir1);
$buyumehizi = addslashes($satir1[1][0]);
$bakimihtiyaci = addslashes($satir1[2][0]);

preg_match_all($digerbilgiler2,$botLink,$satir2);
$zehirlilik = addslashes($satir2[1][0]);
$uretimi = addslashes($satir2[2][0]);

$sql = "INSERT INTO diger_bilgiler (	diger_bilgiler_id	,buyume_hizi,	bakim_ihtiyaci,	zehirlilik,	uretimi	) 
                     VALUES ('$id','$buyumehizi','$bakimihtiyaci','$zehirlilik','$uretimi')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}
}

*/


/*
//Yetisme Istegi Tablosu
$yetismeistegi1 = '@<tr><th width="100">Günışığı İsteği</th><td width="150">
(.*?)</td><th width="100">Su İsteği</th><td>
(.*?)</td></tr>@si'; 

$yetismeistegi2 = '@<tr>
<th width="100">Besin Gereksinimi</th><td>
(.*?)</td></tr>@si'; 

$yetismeistegi3 = '@<tr><th width="100">Toprak İsteği</th><td>
(.*?)</td>
<th width="100">Toprak Drenajı</th><td>
(.*?)</td></tr>@si'; 

for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($yetismeistegi1,$botLink,$satir1);
$gunisigi = addslashes($satir1[1][0]);
$suistegi = addslashes($satir1[2][0]);

preg_match_all($yetismeistegi2,$botLink,$satir2);
$besin = addslashes($satir2[1][0]);

preg_match_all($yetismeistegi3,$botLink,$satir3);
$toprakistegi = addslashes($satir3[1][0]);
$toprakdrenaji = addslashes($satir3[2][0]);

$sql = "INSERT INTO yetisme_istegi (
  yetisme_istegi_id	,gunisigi_istegi,	su_istegi,	besin_gereksinimi,	toprak_istegi,	toprak_drenaji	) 
                     VALUES ('$id','$gunisigi','$suistegi','$besin','$toprakistegi','$toprakdrenaji')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}
}
*/
/*
//Kullanim Amaci Tablosu
$kullanimamaci1 = '@<tr>
<th width="100">Mühendislik İşlevleri</th><td>
(.*?)</td>
</tr>@si'; 

$kullanimamaci2 = '@<tr>
<th width="100">Mimarlık İşlevleri</th><td>
(.*?)</td>
</tr>@si'; 

$kullanimamaci3 = '@<tr>
<th width="100">Ek Özellikler</th><td>
(.*?)</td>
</tr>@si';

for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);

preg_match_all($kullanimamaci1,$botLink,$satir1);
$muhendislikislevleri = addslashes($satir1[1][0]);

preg_match_all($kullanimamaci2,$botLink,$satir2);
$mimarlikislevleri = addslashes($satir2[1][0]);

preg_match_all($kullanimamaci3,$botLink,$satir3);
$ekozellikler = addslashes($satir3[1][0]);

$sql = "INSERT INTO kullanim_amaci (kullanim_amaci_id,	muhendislik_islevleri,	mimarlik_islevleri,	ek_ozellikler	) 
                     VALUES ('$id','$muhendislikislevleri','$mimarlikislevleri','$ekozellikler')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}
}

*/


/*
//Kullanim Alanlari Tablosu
$kullanimalanlari1 = '@<tr><th width="100">Kırsal Kullanım Alanları</th><td>
(.*?)</td></tr><tr>
<th width="100">Kentsel Kullanım Alanları</th><td>
(.*?)</td></tr>
@si'; 

$kullanimalanlari2 = '@<tr><th width="100">Diğer Kullanım Alanları</th><td>
(.*?)</td></tr><tr><th width="100">Peyzaj Tarzı</th><td>
(.*?)</td></tr>@si';

$kullanimalanlari3 = '@<tr><th>Kullanıma İlişkin Notlar</th><td colspan=\'1\'>(.*?)</td></tr>@si';

for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($kullanimalanlari1,$botLink,$satir1);
$kirsalkullanim = addslashes($satir1[1][0]);
$kentselkullanim = addslashes($satir1[2][0]);

preg_match_all($kullanimalanlari2,$botLink,$satir2);
$digerkullanim =addslashes($satir2[1][0]);
$peyzajtarzi =addslashes($satir2[2][0]);

preg_match_all($kullanimalanlari3,$botLink,$satir3);
$kullanimailiskinnotlar =addslashes($satir3[1][0]);

$sql = "INSERT INTO kullanim_alanlari (	kullanimalanlari_id,	kirsal_kullanim_alanlari,
	kentsel_kullanim_alanlari	,diger_kullanim_alanlari	,peyzaj_tarzi,	kullanima_iliskin_notlar	 ) 
                     VALUES ('$id','$kirsalkullanim','$kentselkullanim','$digerkullanim','$peyzajtarzi',
                    '$kullanimailiskinnotlar')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}


}
*/



/*
//Meyve Tablosu
$meyve1 = '@<tr><th width="100">Meyve Durumu</th><td width="150">
(.*?)</td> <th width="100">Meyve Tipi</th><td width="150">
(.*?)</td><th width="100">Meyve Büyüklüğü</th><td>
(.*?)</td>@si';

$meyve2 = '@
<tr>
<th width="100">Meyve Rengi</th><td>
(.*?)</td>

<th width="100">Meyve Yenilebilirliği</th><td>
(.*?)</td>

<th width="100">Meyve Zamanı</th><td>
(.*?)</td></tr>@si';


for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($meyve1,$botLink,$satir1);
$meyvedurumu = addslashes($satir1[1][0]);
$meyvetipi = addslashes($satir1[2][0]);
$meyvebuyuklugu = addslashes($satir1[3][0]);

preg_match_all($meyve2,$botLink,$satir2);
$meyverengi = addslashes($satir2[1][0]);
$meyveyenilebilirligi = addslashes($satir2[2][0]);
$meyvezamani = addslashes($satir2[3][0]);


$sql = "INSERT INTO meyve ( meyve_id,	meyve_durumu,	meyve_tipi,	meyve_buyuklugu,	meyve_rengi,	meyve_yenilebilirligi,	meyve_zamani	) 
                     VALUES ('$id','$meyvedurumu','$meyvetipi','$meyvebuyuklugu','$meyverengi',
                     '$meyveyenilebilirligi'
                     ,'$meyvezamani')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}

}
*/













/*
//Cicek tablosu
$cicek1 = '@<tr> <th width="100">Çiçek Durumu</th><td width="150">(.*?)</td><th width="100">Çiçek Büyüklüğü</th><td width="150">(.*?)</td>


<th width="100">Çiçek Kokusu</th><td>(.*?)</td>

</tr>@si';
$cicek2 = '@<tr><th width="100">Çiçek Rengi</th><td>(.*?)</td><th width="100">Çiçeklenme Zamanı</th><td colspan="3">(.*?)</td></tr>@si';

$cicek3 = '@<tr><th width=\'100\'>Çiçek Hakkında Notlar</th><td colspan=\'5\'>(.*?)</td></tr>@si';

for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($cicek1,$botLink,$satir1);
$cicekdurumu = addslashes($satir1[1][0]);
$cicekbuyuklugu = addslashes($satir1[2][0]);
$cicekkokusu = addslashes($satir1[3][0]);

preg_match_all($cicek2,$botLink,$satir2);
$cicekrengi = addslashes($satir2[1][0]);
$ciceklenmezamani = addslashes($satir2[2][0]);

preg_match_all($cicek3,$botLink,$satir3);
$cicekhakkindanotlar = addslashes($satir3[1][0]);

$sql = "INSERT INTO cicek (cicek_id	,cicek_durumu,	cicek_buyuklugu,	cicek_kokusu,	cicek_rengi	,ciceklenme_zamani,	cicek_hakkinda_notlar	) 
                     VALUES ('$id','$cicekdurumu','$cicekbuyuklugu','$cicekkokusu','$cicekrengi','$ciceklenmezamani'
                     ,'$cicekhakkindanotlar')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}

}
*/















/*
//Yaprak tablosu
$yaprak1 = '@<tr>
<th width="100">Yaprak Dökme</th><td width="150">(.*?)</td>

<th width="100">Yaprak Tipi</th><td width="150">(.*?)</td>

<th width="100">Yaprak Şekli</th><td>(.*?)</td>
</tr>@si';

$yaprak2 = '@<tr>

<th width="100">Yaprak Büyüklüğü</th><td>(.*?)</td>

<th width="100">Yaprak Kokusu</th><td>(.*?)</td>

<th width="100">Yaprak Dokusu</th><td>(.*?)</td>

</tr>@si';

$yaprak3 = '@<tr>
<th width="100">Yaprak Rengi</th><td>(.*?)</td>
<th width="100">Yaprak Güz Rengi</th><td>(.*?)</td></tr>@si';

$yaprak4 = '@<tr><th>Yaprak Hakkında Notlar</th><td colspan=\'5\'>(.*?)</td></tr>@si';


for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);


preg_match_all($yaprak1,$botLink,$satir1);
$yaprakdokme = addslashes($satir1[1][0]);
$yapraktipi = addslashes($satir1[2][0]);
$yapraksekli = addslashes($satir1[3][0]);




preg_match_all($yaprak2,$botLink,$satir2);
$yaprakbuyuklugu = addslashes($satir2[1][0]);
$yaprakkokusu = addslashes($satir2[2][0]);
$yaprakdokusu = addslashes($satir2[3][0]);


preg_match_all($yaprak3,$botLink,$satir3);
$yaprakrengi= addslashes($satir3[1][0]);
$yaprakguzrengi= addslashes($satir3[2][0]);



preg_match_all($yaprak4,$botLink,$satir4);
$yaprakhakkindanotlar= addslashes($satir4[1][0]);


$sql = "INSERT INTO yaprak (yaprak_id	,yaprak_dokme,	yaprak_tipi	,yaprak_sekli,	yaprak_buyuklugu,	yaprak_kokusu	,
yaprak_dokusu,	yaprak_rengi,	yaprak_guz_rengi,	yaprak_hakkinda_notlar	) 
                     VALUES ('$id','$yaprakdokme','$yapraktipi','$yapraksekli','$yaprakbuyuklugu','$yaprakkokusu'
                     ,'$yaprakdokusu','$yaprakrengi','$yaprakguzrengi','$yaprakhakkindanotlar')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}

}
*/













/*
//HABITUS Tablosu

$habitus1 = '@<tr>
<th width="100">Şekli</th><td width="300">(.*?)</td>
<th width="100">Boyu</th><td width="300">(.*?)</td>
<th width="100">Çapı</th><td width="300">(.*?)</td>
<th width="100">Dokusu</th><td width="300">(.*?)</td>
</tr>@si';

$habitus2= '@<tr><th>Habitus Hakkında Notlar</th><td colspan=\'3\'>(.*?)</td></tr>@si';


for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);

preg_match_all($habitus1,$botLink,$satir1);
$sekli = addslashes($satir1[1][0]);
$boyu = addslashes($satir1[2][0]);
$capi =addslashes( $satir1[3][0]);
$dokusu = addslashes($satir1[4][0]);

preg_match_all($habitus2,$botLink,$satir2);
$habitushakkindanotlar=addslashes($satir2[1][0]);



echo "<pre>";
print_r($satir1);
echo "</pre>";
echo "<pre>";
print_r($satir2);
echo "</pre>";


$sql = "INSERT INTO habitus (habitus_id	,sekli	,boyu	,capi	,dokusu	,habitus_hakkinda_notlar	) 
                     VALUES ('$id','$sekli','$boyu','$capi','$dokusu','$habitushakkindanotlar')";

echo "</br>";
if ($baglanti->query($sql) === TRUE) 
{
    echo "Veritabanına veri eklendi";
    
} 
else 
{
   echo "Hata: " . $sql. "<br>" . $baglanti->error;
}



}



*/

















//Genel tablosu
/*
$genel1 = '@<tr>
<th width="100">Latince İsmi</th><td width="150">(.*?)</td>
<th width="100">Türkçe İsimleri</th><td>(.*?)</td>
</tr>@si';
$genel2 = '@<tr>
<th width="100">Büyüme Formu</th><td>(.*?)</td>
<th width="100">Anavatanı</th><td >(.*?)</td>
</tr>@si';
$genel3 ='@<tr>
<th width="100">Yetiştiği Bölge</th>
<td >(.*?)</td>
<th width="100">Ailesi</th><td>(.*?)</td>
</tr>@si';
$genel4 ='@<tr><th width=\'100\'>Notlar</th><td colspan=\'3\'>(.*?)</td></tr>@si';


//her dongude dizideki sadece 1 sitenin adresini aliyor 
for($i=0;$i<$say;$i++){
 
  echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i];    
    $botLink = file_get_contents($link);
      
   
    

     preg_match_all($genel1,$botLink,$satir1);
     $latinceismi = addslashes($satir1[1][0]);
     $turkceismi = addslashes($satir1[2][0]);
     
     
     preg_match_all($genel2,$botLink,$satir2);
     $buyumeformu= addslashes($satir2[1][0]);
     $anavatani = addslashes($satir2[2][0]);
     
   
     preg_match_all($genel3,$botLink,$satir3);
     $yetistigibolge =addslashes($satir3[1][0]);
     $ailesi = addslashes($satir3[2][0]);

     
     preg_match_all($genel4,$botLink,$satir4);
     $notlar =addslashes($satir4[1][0]); 
     
    //GENEL tablosuna verileri ekliyoruz
     $sql = "INSERT INTO GENEL (genel_id, latince_ismi, turkce_isimleri, buyume_formu, anavatani, yetistigi_bolge, ailesi, notlar)
     VALUES ('$id','$latinceismi','$turkceismi', '$buyumeformu','$anavatani','$yetistigibolge','$ailesi','$notlar')";
    echo "</br>";
    if ($baglanti->query($sql) === TRUE) 
    {
        echo "Veritabanına veri eklendi";
        
    } 
    else 
    {
       echo "Hata: " . $sql. "<br>" . $baglanti->error;
    }
    echo "</br>";
}

*/





//link dizisini yazdirir
/*
echo "<pre>";
print_r($sonuc[1]);
echo "</pre>";
*/

?>
