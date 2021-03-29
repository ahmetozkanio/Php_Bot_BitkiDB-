<?php

include 'main.php';

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
?>