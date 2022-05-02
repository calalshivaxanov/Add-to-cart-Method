<?php


class sebet
{
    public function sebeteAt($id,$sayi,$reng)
    {
        $_SESSION['sebet'][$id]['id'] = $id;
        $_SESSION['sebet'][$id]['sayi'] = $sayi; //Sepet Sessionu yaradırıq, Sonra həmin sebetin id`sini göstəririk və bu İD dəki məhsuldan nəqədər səbətə yükləməy istədiyimizi göstəririk
        $_SESSION['sebet'][$id]['reng'] = $reng;

    }
}