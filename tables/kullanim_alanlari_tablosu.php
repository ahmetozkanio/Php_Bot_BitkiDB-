<?php

include 'main.php';

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
?>