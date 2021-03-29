<?php

include 'main.php';


//Genel tablosu

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
?>