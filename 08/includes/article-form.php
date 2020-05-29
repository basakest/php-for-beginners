<form method="post">
    <h1>My blog</h1>
    <h2>New article</h2>
    <?php if(!empty($errors)):?>
    <ul>
    <?php foreach($errors as $error):?>
    <li><?= $error;?></li>
    <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div>
        <label for="title">title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($title) ;?>" />
    </div>
    <div>
        <label for="content">content</label>
        <textarea name="content" id="content" cols="30" rows="10">
            <?= htmlspecialchars($content) ;?>
        </textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?= $published_at;?>" />
    </div>
    <button>Add</button>
</form>