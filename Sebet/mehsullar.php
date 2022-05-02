<?php


class mehsullar extends baglanti
{
    public function control($id)
    {
        $sorgu = $this->db->prepare("SELECT * FROM mehsullar WHERE id = ?");
        $sorgu->execute(array($id));
        return $sorgu->rowCount();
    }


    public function melumat($id)
    {
        $sorgu = $this->db->prepare("SELECT * FROM mehsullar WHERE id = ?");
        $sorgu->execute(array($id));
        return $sorgu->fetch(PDO::FETCH_ASSOC);
    }
}