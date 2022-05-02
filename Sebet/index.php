<?php
session_start();
require_once "baglanti.php";
require_once "mehsullar.php";
require_once "sebet.php";
$baglanti = new baglanti();
$mehsullar = new mehsullar();
$sebet = new sebet();


if(isset($_GET['sil'])) //Əgər sepetdən id məhsul istəyirsə
{
    $sebetId = intval($_GET['sil']);

    if(isset($_SESSION['sebet'][$sebetId])) //Əgər belə bir məhsul səbəttə varsa
    {
        $mehsulControl = $mehsullar->control($sebetId);
        if(!empty($mehsulControl)) //Əgər boş deyilsə
        {
            unset($_SESSION['sebet'][$sebetId]); //Bunu Səbətdən sil
        }
        else
        {
            echo "Bu məhsul ümumiyətlə yoxdur";
        }
    }
    else
    {
        echo "Səbətdə yoxdur";
    }
}


//Məhsulları list edək
if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    if(!empty($mehsullar->control($id))) //Əgər mehsullar`dan gələn İD boş deyilsə
    {

        if(isset($_POST['sebeteat'])) //Əgər Səbətə at seçilibsə
        {
            $sayi = intval($_POST['sayi']); //Sayını al
            $reng = strip_tags($_POST['reng']); //Rəngini al
            $sebet->sebeteAt($id,$sayi,$reng);

        }

        $melumat = $mehsullar->melumat($id);
        echo $melumat['isim'];
        echo "<br/>";
        echo $melumat['qiymet'];
        ?>

        <form action="" method="POST">
            <input type="number" name="sayi" value="1">
            <select name="reng" id="">
                <option value="ag">Ağ</option>
                <option value="qara">Qara</option>
            </select>
            <input type="submit" name="sebeteat" value="Səbətə At">
        </form>


<?php

        echo "Səbətiniz";
        echo "<hr>";

        if(!empty(count($_SESSION['sebet']))) //Əgər sebetin içindəki məhsulun sayı boş deyilsə
        {
            //Həmin məlumatları çək
            $toplam = []; //Cəminin massivini göstər
            foreach ($_SESSION['sebet'] as $key => $value) //$key burada məhsulların İDsidir
            {
                $mehsulInfo = $mehsullar->melumat($key); //Məhsulları çəkirik
                $qiymet = $mehsulInfo['qiymet']*$value['sayi']; //Qiymətini çəkirik və sayına vururuq
                $toplam[] = $qiymet; //Massivə qiymətini daxil et
                echo '<a href="?id='.$id.'&sil='.$key.'">'.$mehsulInfo['isim']." (".$value['reng'].") => ".$value['sayi'].": ".$qiymet." AZN </a><br/>";
            }
            echo 'Toplam Qiyməti: '.array_sum($toplam).' Azn';
        }
        else
        {
            echo "Səbət boş";
        }

    }
    else
    {
        echo "DB`də belə bir məhsul yoxdur";
    }
}