<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <ul class="navbar-nav mr-auto">
        <?php 
            $menu = main_menu();
            
            foreach ($menu as $item) { ?>
            
            <li class="nav-item">
                <a class="nav-link" href="<?= $item['url'] ?>">
                    <?= $item['name'] ?>
                </a>
            </li>

        <?php } ?>
    </ul>
</nav>