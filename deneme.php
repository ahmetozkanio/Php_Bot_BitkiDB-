<?php

include 'main.php';

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










?>
