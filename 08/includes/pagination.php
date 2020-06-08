<?php $base = strtok($_SERVER['REQUEST_URI'], '?');?>
<nav>
    <ul class="pagination">
        <?php if ($paginator->previous):?>
            <li class="page-item">
                <a href="<?=$base;?>?page=<?=$paginator->previous;?>" class="page-link">previous</a>
            </li>
        <?php else: ?>
            <li class="page-item"><p class="page-link">previous</p></li>
        <?php endif;?>
        <?php if ($paginator->next):?>
            <li class="page-item">
                <a href="<?=$base;?>?page=<?=$paginator->next;?>" class="page-link">next</a>
            </li>
        <?php else: ?>
            <li class="page-item"><p class="page-link">next</p></li>
        <?php endif;?>
    </ul>
</nav>