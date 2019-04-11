<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="<?php echo site_url('employees/'); ?>" class="nav-link">Dolgozók</a>
        </li>
        <li class="nav-item dropdown">
            <a href="<?php echo site_url('jobs/'); ?>" class="nav-link dropdown-toggle" id="navbardrop"
               data-toggle="dropdown">Feladatok</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo site_url('jobs/'); ?>">Összes</a>
                <a class="dropdown-item" href="<?php echo site_url('jobs/finished'); ?>">Elvégzett</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="<?php echo site_url('partners/'); ?>" class="nav-link">Partnerek</a>
        </li>
    </ul>
</nav>