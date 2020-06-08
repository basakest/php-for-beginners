<form method="post" id="formArticle">
    <h1>My blog</h1>
    <h2>New article</h2>
    <?php if(!empty($article->errors)):?>
    <ul>
    <?php foreach($article->errors as $error):?>
    <li><?= $error;?></li>
    <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div class="form-group">
        <label for="title">title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article->title) ;?>" class="form-control" />
    </div>
    <div class="form-group">
        <label for="content">content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?= htmlspecialchars($article->content);?></textarea>
    </div>
    <div class="form-group">
        <label for="published_at">Publication date and time</label>
        <input type="text" name="published_at" id="published_at" value="<?= $article->published_at;?>" class="form-control" />
    </div>
    <fieldset>
        <legend>category</legend>
        <?php foreach($categories as $category):?>
            <div class="form-check form-check-inline">
            <input type="checkbox" name="category[]" id="" value="<?=$category['id']?>"
                id="<?=$categories['id']?>" <?php 
                if(in_array($category['id'], $category_ids)):?> checked
                <?php endif;?> class="form-check-input" />
            <label for="<?=$categories['id']?>" class="form-check-label"><?=$category['name']?></label>
            </div>
        <?php endforeach;?>
        
    </fieldset>
    <button class="btn btn-primary">Add</button>
</form>