<?php
require("./classes/Database.php");
require("./classes/Article.php");
require("./includes/url.php");
$id = $_GET["id"];
if (isset($id)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new Database();
        $dbc = $db->getConn();
        $article = Article::getById($id, $dbc, "id");
        //var_dump($article); false
        if ($article->delete($dbc)) {
            redirect("08/index.php");
        }

        
        
   
        
      
    } else {
        require("./includes/header.php");
    ?>
        <h2>delete</h2>
        <form method="post">
            <button>delete</button>
            <a href="./article.php?id=<?=$article->id;?>">cancel</a>
        </form>
    <?php
        require("./includes/footer.php");
    }
}else {
    die("there is no id");
}
