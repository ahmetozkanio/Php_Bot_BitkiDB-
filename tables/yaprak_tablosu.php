<?php

include 'main.php';


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
?>