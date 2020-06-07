<form method="post">
    <h1>My blog</h1>
    <h2>New article</h2>
    <?php if(!empty($article->errors)):?>
    <ul>
    <?php foreach($article->errors as $error):?>
    <li><?= $error;?></li>
    <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div>
        <label for="title">title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article->title) ;?>" />
    </div>
    <div>
        <label for="content">content</label>
        <textarea name="content" id="content" cols="30" rows="10">
            <?= htmlspecialchars($article->content) ;?>
        </textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?= $article->published_at;?>" />
    </div>
    <fieldset>
        <legend>category</legend>
        <?php foreach($categories as $category):?>
            <div>
            <input type="checkbox" name="category[]" id="" value="<?=$category['id']?>"
                id="<?=$categories['id']?>" <?php 
                if(in_array($category['id'], $category_ids)):?> checked
                <?php endif;?> />
            <label for="<?=$categories['id']?>"><?=$category['name']?></label>
            </div>
        <?php endforeach;?>
        
    </fieldset>
    <button>Add</button>
</form>