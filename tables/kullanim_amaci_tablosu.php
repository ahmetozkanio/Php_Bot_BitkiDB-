<?php

include 'main.php';



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

?>