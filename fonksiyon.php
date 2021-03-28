<?php
// seo link fonksiyonu
function SeoYap($baslik){
    $onceki = array(' ');
    $sonraki = array('%20');
    $yeni = str_replace( $onceki, $sonraki, $baslik);
    $yeni = preg_replace("@[^A-Za-z0-9\.%:\/-_]@i", '', $yeni);
    $yeni = strtolower($yeni);
    return $yeni;
    }
    


?>