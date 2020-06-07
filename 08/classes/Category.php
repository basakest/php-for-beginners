<?php
class Category
{
    /**
     * get all categories
     *
     * @param [object] $dbc the connection of mysql
     * @return [array]
     */
    public static function getAll($dbc) {
        $sql = "select * from category;";
        $result = $dbc->query($sql);
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }
}