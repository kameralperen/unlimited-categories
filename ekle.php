<?php
require_once("baglan.php");


$GelenUstMenuSecimi     =   Filtrele($_POST["UstMenuSecimi"]);
$GelenMenuAdi           =   Filtrele($_POST["MenuAdi"]);

if($GelenUstMenuSecimi!="" and $GelenMenuAdi!=""){
    
        $EklemeSorgusu = $veritabaniBaglantisi->prepare("INSERT INTO menuler (`ustid`, `menuadi`) VALUES (?, ?)");
        $EklemeSorgusu->execute([$GelenUstMenuSecimi, $GelenMenuAdi]);
        $KayitSayisi            =   $EklemeSorgusu->rowCount();
        $Kayitlar               =   $EklemeSorgusu->fetch(PDO::FETCH_ASSOC);

        if($KayitSayisi>0){
            header("Location:index.php");
            exit();
        }else{
            echo "İşlem sırasında bir hata oluştu! Lütfen daha sonra tekrar deneyiniz <br /> Ana sayfaya dönmek için buraya <a href='index.php'>tıklayınız</a>"; 
        }
    
}else{
    echo "Lütfen boş alan bırakmayınız! <br /> Yeniden ekleme ekranına dönmek için buraya <a href='index.php'>tıklayınız</a>";
    
}

?>
