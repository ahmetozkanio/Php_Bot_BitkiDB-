<?php

include 'main.php';


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
?>