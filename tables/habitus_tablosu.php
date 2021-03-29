<?php

include 'main.php';

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

?>