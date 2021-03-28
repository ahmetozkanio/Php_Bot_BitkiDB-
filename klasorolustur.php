<?php
for($i=0;$i<$say;$i++)
{
   echo  $link = $sonuc[1][$i];
    $id = $sorid[1][$i]; 

if (file_exists('image/'.$id)){
	echo 'Klasör zaten var';
}else{
	$sonuc = mkdir('image/'.$id,'0777');
	if ($sonuc){
		echo 'Klasör başarıyla oluşturuldu';
	}else{
		echo 'Bir hata oluştu';
	}
}}
?>