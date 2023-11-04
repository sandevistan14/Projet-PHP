<?php

require '/home/yuta/www/_assets/includes/autoloader.php';
class CategoryRepository
{
    /**
     * @return array
     */
    public static function getCat(){
        $listCat = [];
        $reqCat = 'SELECT * FROM CATEGORY';
        $tableResCat = _assets\includes\Database::getInstance()->query($reqCat);
        $res = $tableResCat->fetchAll();
        for ($i = 0; $i < count($res); $i = $i+1){
            $idCat = $res[$i]['ID_CATEGORY'];
            $NameCat = $res[$i]['CATEGORY_NAME'];
            $DescCat = $res[$i]['CATEGORY_DESCRIPTION'];
            $tmpCat = new modules\blog\models\Category($idCat, $NameCat, $DescCat);
            array_push($listCat, $tmpCat);
        }
        return $listCat;
    }

    /**
     * @param int $ID_POST
     * @return mixed
     */
    public static function getCatOfPost(int $ID_POST){
        $reqCat = 'SELECT P.ID_CATEGORY, C.CATEGORY_NAME FROM POSTS_CATEGORY P , CATEGORY C
                                           WHERE ID_POST= ? AND P.ID_CATEGORY = C.ID_CATEGORY';
        $tableResCat = _assets\includes\Database::getInstance()->prepare($reqCat);
        $tableResCat->execute([$ID_POST]);
        $resCat = $tableResCat->fetchAll();
        return $resCat;
    }
}