<?php
require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="tr-TR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-language" content="tr">
<meta charset="utf-8">
<title>Başlık</title>
</head>

<body>
    <?php
        function AcilirListeIcinMenuYaz($MenuUstID=0, $BoslukDegeri=0){
            global $veritabaniBaglantisi;
    
            $Sorgu  =   $veritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE ustid = ?");
            $Sorgu->execute([$MenuUstID]);
            $SorguKayitSayisi   =   $Sorgu->rowCount();
            $SorguKayitlari     =   $Sorgu->fetchAll(PDO::FETCH_ASSOC);
    
                if($SorguKayitSayisi>0){
                    foreach($SorguKayitlari as $kayitlar){
                        $MenuID         =   $kayitlar["id"];
                        $MenuUstID      =   $kayitlar["ustid"];
                        $MenuAdi        =   $kayitlar["menuadi"];

                        echo "<option value=' ". $MenuID . "'>". str_repeat("&nbsp;", $BoslukDegeri) . $MenuAdi ." </option>";
                        AcilirListeIcinMenuYaz($MenuID, $BoslukDegeri+5);
                    }
                }
        }

    function MenuYaz($MenuUstID=0, $BoslukDegeri=0){
        global $veritabaniBaglantisi;

        $Sorgu  =   $veritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE ustid = ?");
        $Sorgu->execute([$MenuUstID]);
        $SorguKayitSayisi   =   $Sorgu->rowCount();
        $SorguKayitlari     =   $Sorgu->fetchAll(PDO::FETCH_ASSOC);

            if($SorguKayitSayisi>0){
                foreach($SorguKayitlari as $kayitlar){
                    $MenuID         =   $kayitlar["id"];
                    $MenuUstID      =   $kayitlar["ustid"];
                    $MenuAdi        =   $kayitlar["menuadi"];

                    echo  str_repeat("&nbsp;", $BoslukDegeri) . $MenuAdi . "<a href='guncelle.php?id= ". $MenuID. "'> [Güncelle]</a>  <a href='sil.php?id= ". $MenuID. "'> [Sil]</a> <br/ >";
                    MenuYaz($MenuID, $BoslukDegeri+5);
                }
            }
    }
    ?>
    Menü Ekleme Formu <br />
    <form action="ekle.php" method="post">
        Üst Menü : <select name="UstMenuSecimi"> 
            <option value="0"> Ana menü yap </option>
            <?php echo AcilirListeIcinMenuYaz(); ?>
    </select> <br />
    Menü İsmi: <input type="text" name="MenuAdi"> <br />
    <input type="submit" value="Ekle">
    </form> <br/><br />
    <?php
    MenuYaz();
    $veritabaniBaglantisi   =   null;
    ?>
</body>
</html>