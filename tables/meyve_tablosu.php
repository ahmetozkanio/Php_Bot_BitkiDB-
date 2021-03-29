<?php

include 'main.php';

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
?>