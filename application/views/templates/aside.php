<aside class="navbar navbar-expand-lg navbar-light bg-light aside col-2">
    <ul class="navbar-nav nav-aside">
        <?php 

        foreach ($menu as $item) { ?>
        
            <li class="nav-item">
                <a class="btn btn-warning" href="<?= $item['url'] ?>">
                    <?= $item['name'] ?>
                </a>
            </li>
        
        <?php } ?>
    </ul>
</aside>