<?php
/**
 * Article 
 */
class Article
{
    /**
     * articl id
     *
     * @var [int]
     */
    public $id;
    /**
     * article title
     *
     * @var [string]
     */
    public $title;
    /**
     * article content
     *
     * @var [string]
     */
    public $content;
    /**
     * article published time
     *
     * @var [string or timestamp in mysql]
     */
    public $published_at;
    /**
     * the errors about article
     *
     * @var array
     */
    public $errors = [];
    /**
     * get all articles
     *
     * @param [object] $dbc the connection of mysql
     * @return a two deminisions array about array
     */
    public static function getAll($dbc) {
        $sql = "select * from article;";
        $result = $dbc->query($sql);
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    /**
     * get the article base on the id
     *
     * @param [id] $id
     * @param [object] $dbc
     * @param [string] $column
     * @return object
     */
    public static function getById($id, $dbc, $column="*") {
        $sql = "select $column from article where id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Article");
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }
    /**
     * update the article
     *
     * @param [project] $dbc
     * @return [boolean] the result of sql
     */
    public function update($dbc) {
        if ($this->validate()) {
            $sql = "update article set title=:title, content=:content, published_at=:published_at where id=:id";
            $stmt = $dbc->prepare($sql);
            $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
            $stmt->bindValue(":content", $this->content, PDO::PARAM_STR);
            //change $article to $this
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            if ($this->published_at === NULL) {
                $stmt->bindValue(":published_at", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":published_at", $this->published_at, PDO::PARAM_STR);
            }
            return $stmt->execute();
        } else {
            return false;
        }
        
    }

    /**
     * validate the data aboute the article
     *
     * @return boolean
     */
    public function validate() {
        if (empty($this->title)) {
            $this->errors[] = "please fill the title";
        }
        if (empty($this->content)) {
            $this->errors[] = "please fill the content";
        }
        if (isset($this->published_at)) {
            var_dump($this->published_at);
            $this->published_at = date_create_from_format("Y-m-d H:i", $this->published_at);
            var_dump($this->published_at);
            exit();
            if ($this->published_at === false) {
                $this->errors[] = "invalid date and time(format wrong)";
            } else {
                $date_errors = date_get_last_errors();
                if ($date_errors["warnning_count"] > 0) {
                    $this->errors[] = "invalid date and time(this datetime doesn't exists)";
                }
            }
        }
        return empty($this->errors);
    }
    /**
     * delete the article
     *
     * @param [object] $dbc
     * @return boolean
     */
    public function delete($dbc) {
        $sql = "delete from article where id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt -> bindValue(":id", $this->id, PDO::PARAM_INT );
        return $stmt->execute();
    }

    public function create($dbc) {
        $sql = "insert into article(title, content, published_at) values (:title, :content, :published_at)";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindValue(":content", $this->content, PDO::PARAM_STR);
        if (isset($this->published_at)) {
            $stmt->bindValue(":published_at", $this->published_at, PDO::PARAM_STR);
        } else {
            $stmt->bindValue(":published_at", null, PDO::PARAM_NULL);
        }
        if ($stmt->execute()) {
            //echo 1233;exit();
            return $dbc->lastInsertId();
        } else {
            return false;
        }
    }
}