<?php
try{
    $veritabaniBaglantisi   =   new PDO("mysql:host=localhost;dbname=uskumru;charset=UTF8", "root", "");
}catch(PDOException $hata){
    echo "Bağlantı hatası! <br />" . $hata->getMessage();
    die();
}

function Filtrele($Deger){
    $Bir    =   trim($Deger);
    $iki    =   strip_tags($Bir);
    $uc     =   htmlspecialchars($iki);
    $sonuc  =   $uc;
    return $sonuc;
}
?>
