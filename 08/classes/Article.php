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
     * the path of article image
     *
     * @var [string]
     */
    public $image_file;
    /**
     * get all articles
     *
     * @param [object] $dbc the connection of mysql
     * @return a two deminisions array about array
     */
    public static function getAll($dbc)
    {
        $sql = "select * from article;";
        $result = $dbc->query($sql);
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }


    /**
     * get an article and its category base on the id
     *
     * @param [object] $dbc
     * @param [int] $id
     * @return array
     */
    public static function getWithCategory($dbc, $id, $only_published = false)
    {
        $sql = "select article.*, category.name as category_name from article
                left join article_category
                on article.id = article_category.article_id
                left join category
                on category.id = article_category.category_id
                where article.id = :id";
        if ($only_published) {
            $sql .= " and article.published_at is not null";
        }
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * get the category about an article base on the id
     *
     * @param [object] $dbc
     * @return array
     */
    public function getCategories($dbc)
    {
        $sql = "select category.* from category
                left join article_category
                on category.id = article_category.category_id
                where article_category.article_id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * update the category when upadte article
     *
     * @param [object] $dbc
     * @param [array] $ids
     * @return void
     */
    public function setCategories($dbc, $ids)
    {
        $sql = "insert ignore into article_category(article_id, category_id) values ";
        $values = [];
        foreach ($ids as $id) {
            $values[] = "({$this->id}, ?)";
        }
        $sql .= implode(", ", $values);

        $stmt = $dbc->prepare($sql);
        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $sql = "delete from article_category where article_id = {$this->id} ";
        if ($ids) {
            $placeholders = array_fill(0, count($ids), '?');
            $sql .= "and category_id not in (" . implode(', ', $placeholders) . ')';
        }
        $stmt = $dbc->prepare($sql);
        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

    /**
     * get article by the arguments
     *
     * @param [object] $dbc
     * @param [int] $offset
     * @param [int] $limit
     * @return array
     */
    public static function getPage($dbc, $limit, $offset, $only_published = false)
    {
        $condition = $only_published? " where article.published_at is not null " :'';
        $sql = "select a.*,category.name as category_name from
                (select * from article $condition order by id limit :limit offset :offset) as a
                left join article_category on article_category.article_id = a.id
                left join category on article_category.category_id = category.id";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $previous_id = null;
        $articles = [];
        // the purpose of this foreach: get an array about the article include the category
        // foreach the array, one article may occur more than once
        foreach ($results as $row) {
            $article_id = $row["id"];
            if ($article_id != $previous_id) {
                $row["category_names"] = [];
                $articles[$article_id] = $row;
            }
            $articles[$article_id]["category_names"][] = $row["category_name"];
            $previous_id = $article_id;
        }
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
    public static function getById($id, $dbc, $column="*")
    {
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
     * @return boolean the result of sql
     */
    public function update($dbc)
    {
        if ($this->validate()) {
            $sql = "update article set title=:title, content=:content, published_at=:published_at where id=:id";
            $stmt = $dbc->prepare($sql);
            $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
            $stmt->bindValue(":content", $this->content, PDO::PARAM_STR);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            if ($this->published_at === null) {
                $stmt->bindValue(":published_at", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":published_at", $this->published_at, PDO::PARAM_STR);
            }
            return $stmt->execute();
        } else {
            //echo 123;exit();
            return false;
        }
    }

    /**
     * validate the data aboute the article
     *
     * @return boolean
     */
    public function validate()
    {
        if (empty($this->title)) {
            $this->errors[] = "please fill the title";
        }
        if (empty($this->content)) {
            $this->errors[] = "please fill the content";
        }
        if (isset($this->published_at)) {
            $this->published_at1 = date_create_from_format("Y-m-d H:i:s", $this->published_at);
            //var_dump($published_at1['date']);exit();
            if ($this->published_at1 === false) {
                $this->errors[] = "invalid date and time(format wrong)";
            } else {
                $date_errors = date_get_last_errors();
                if ($date_errors["warning_count"] > 0) {
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
    public function delete($dbc)
    {
        $sql = "delete from article where id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt -> bindValue(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function create($dbc)
    {
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

    /**
     * get the num of articles
     *
     * @param [object] $dbc
     * @param [boolean] $is_published
     * @return [int]
     */
    public static function getTotal($dbc, $is_published = false)
    {
        $condition = $is_published? " where article.published_at is not null " : "";
        return $dbc->query("select count(*) from article $condition")->fetchColumn();
    }

    /**
     * set the image file of an article
     *
     * @param [object] $dbc
     * @return [boolean]
     */
    public function setImageFile($dbc)
    {
        $sql = "update article set image_file = :image_file where id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":image_file", $this->image_file, isset($this->image_file)?PDO::PARAM_STR:PDO::PARAM_NULL);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * publish an article
     *
     * @param [object] $dbc
     * @return [string] the published datetime
     */
    public function publish($dbc)
    {
        $sql = "update article set published_at = :published_at where id = :id";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue("id", $this->id, PDO::PARAM_INT);
        $published_at = date("Y-m-d H:i:s");
        $stmt->bindValue(":published_at", $published_at, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $published_at;
        }
    }
}
