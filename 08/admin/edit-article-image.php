<?php
    require '../includes/init.php';
    require '../includes/header.php';
    Auth::requireLogIn();
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require '../includes/db.php';
        $article = Article::getById($id, $dbc);
        if (!$article) {
            die("there is no article with this id");
        }
    } else {
        die("there is no id");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
          try {
              if (empty($_FILES)) {
                  throw new Exception("The file is bigger than post_max_size");
              }
              switch ($_FILES['file']['error']) {
                  case UPLOAD_ERR_OK:
                  break;
                  case UPLOAD_ERR_NO_FILE:
                    throw new Exception("No file is selected");
                  break;
                  case UPLOAD_ERR_INI_SIZE:
                    throw new Exception('The file is too big');
                  break;
                  default:
                    throw new Exception("there is an error about file");
                  break;
              }
              if ($_FILES['file']['size'] > 1000000) {
                  throw new Exception("The file is bigger than 1MB");
              }
              $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
              $finfo = finfo_open(FILEINFO_MIME_TYPE);
              $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
              if (!in_array($mime_type, $mime_types)) {
                  throw new Exception('Invalid file type');
              }

              $pathinfo = pathinfo($_FILES["file"]["name"]);
              $base = $pathinfo["filename"];
              $base = preg_replace("/[^a-zA-Z0-9_-]/", "_", $base);
              $base = mb_substr($base, 0, 200);//the value which was inserted into the database is the filename, but why use this function to $base?
              $filename = $base . "." . $pathinfo["extension"];
              $destination = "../uploades/" . $filename;

              $i = 1;
              while (file_exists($destination)) {
                $filename = $base . "-$i" . "." . $pathinfo["extension"];
                $destination = "../uploades/" . $filename;
                $i++;
              }
              if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
                  $previous_image = $article->image_file;
                  if (!empty($previous_image)) {
                      unlink("../uploades/$article->image_file");
                  }
                  echo "file uploaded success";
                  $article->image_file = $filename;
                  if ($article->setImageFile($dbc)) {
                      Url::redirect("/08/admin/article.php?id=$article->id");
                  }
              } else {
                  throw new Exception('move uploaded file fail');
              }
          } catch(Exception $e) {
              $error = $e->getMessage();
          }
    }
?>
<h2>edit article image</h2>
<?php if(isset($error)): ?>
<p><?=$error;?></p>
<?php endif;?>
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file">choose an image</label>
        <input type="file" name="file" id="file" />
    </div>
    <?php if (isset($article->image_file)): ?>
    <img src="/08/uploades/<?=$article->image_file;?>" alt="article image" /><br />
    <a class="delete" href="./delete-article-image?id=<?=$article->id;?>">delete</a>
    <?php endif;?>
    <button>Submit</button>
</form>
<?php
    require("../includes/footer.php");
?>