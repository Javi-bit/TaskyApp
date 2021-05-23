<aside class="navbar navbar-expand-lg navbar-light bg-light aside col-2">
    <ul class="navbar-nav nav-aside">
        <?php 

        if(isset($_SESSION['is_logged'])){echo '<h2 style="text-align:center;">¡Hola '.$_SESSION['username'].'!</h2>';}

        foreach ($menu as $item) { ?>
        
            <li class="nav-item">
                <a class="btn btn-warning" href="<?= $item['url'] ?>">
                    <?= $item['name'] ?>
                </a>
            </li>
        
        <?php } ?>
    </ul>
</aside>