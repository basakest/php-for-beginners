<?php $base = strtok($_SERVER['REQUEST_URI'], '?');?>
<nav>
    <ul>
        <?php if ($paginator->previous):?>
            <li><a href="<?=$base;?>?page=<?=$paginator->previous;?>">previous</a></li>
        <?php else: ?>
            <li><p>previous</p></li>
        <?php endif;?>
        <?php if ($paginator->next):?>
            <li><a href="<?=$base;?>?page=<?=$paginator->next;?>">next</a></li>
        <?php else: ?>
            <li><p>next</p></li>
        <?php endif;?>
    </ul>
</nav>