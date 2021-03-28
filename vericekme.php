<?php
/*include ('fonksiyon.php');
$bag = Baglan("https://www.bitkivt.itu.edu.tr/vt/report.php?sor=513");
//print_r($bag);
preg_match_all('@<div id="ma_table">(.*?)</div>@',$bag,$diziler_list);
print_r($diziler_list);
*/


/*
$veri = file_get_contents("https://www.bitkivt.itu.edu.tr/en");
preg_match_all('@<a target="_blank" href="(.*?)"><font color="000">.*?</font></a>@si',$veri,$link_cek);

print_r($link_cek);
*/



$icerik = file_get_contents("https://www.bitkivt.itu.edu.tr/en");

$ust_sicaklik = ara('<a target="_blank" href="', '><font', $icerik);
print_r($m);

function ara($bas, $son, $yazi)
{
    preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
    return $m[1];
}







http://www.bitkivt.itu.edu.tr/foto/abies_born_kozalak.jpg

// seo link fonksiyonu
function SeoYap($baslik){
    $onceki = array(' ');
    $sonraki = array('%20');
    $yeni = str_replace( $onceki, $sonraki, $baslik);
    $yeni = preg_replace("@[^A-Za-z0-9\.%\-_]@i", '', $yeni);
    $yeni = strtolower($yeni);
    return $yeni;
    }
    
    $baslik = "Php ile Seo Link Fonksiyonu Yapımı"; // seosuz başlık
    
    echo "Seosuz hali: <strong>".$baslik."</strong>";
    echo "\n 
    
    Seolu hali: <strong>".SeoYap($baslik)."</strong>";














/* calisiyor %100
class mbot{
    public function __construct($url){
        $this->document = new DOMDocument();
        $this->document->loadHTML(file_get_contents($url,false));

    }
    public function fetch(){
        $links = $this->document->getElementsByTagName('a');
        
            print_r($links->getAttribute('href')."<br/>");
        
    }
}

$mBot = new mbot('https://www.bitkivt.itu.edu.tr/en');
    $mBot->fetch();


*/
?>
