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
    try{
        $veritabaniBaglantisi   =   new PDO("mysql:host=localhost;dbname=uskumru;charset=UTF8", "root", "");
    }catch(PDOException $hata){
        echo "Bağlantı hatası! <br />" . $hata->getMessage();
        die();
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

                    echo str_repeat("&nbsp;", $BoslukDegeri);
                    echo $MenuID . " | " . $MenuUstID . " | " . $MenuAdi . "<br />";
                    MenuYaz($MenuID, $BoslukDegeri+5);
                }
            }
    }

    MenuYaz();

    $veritabaniBaglantisi   =   null;
    ?>
</body>
</html>