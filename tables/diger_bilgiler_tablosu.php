<?php

include 'main.php';

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

?>
