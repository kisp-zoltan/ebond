<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>
    <p>
        <a href="<?php echo site_url('jobs/create'); ?>" class="btn btn-primary" role="button">Új hozzáadása</a>
        <button role="button" class="btn btn-primary" data-toggle="collapse" data-target="#statistics">Statisztika
        </button>
    </p>
    <table id="statistics" class="collapse table w-50">
        <tr>
            <thead>
            <th>Inaktív</th>
            <th>Aktív</th>
            <th>Kész</th>
            <th>Összes</th>
            <th>Elvégzett óraszám</th>
            </thead>
        </tr>
        <tr>
            <td><?php echo $jobs_inactive ?></td>
            <td><?php echo $jobs_active ?></td>
            <td><?php echo $jobs_finished ?></td>
            <td><?php echo $jobs_all ?></td>
            <td><?php echo array_sum(array_column($finished, 'oraszam')) ?></td>
        </tr>
        <tr>
        </tr>
    </table>

    <table class="table">
        <tr>
            <thead>
            <th>Megnevezés</th>
            <th>Státusz</th>
            </thead>
        </tr>
        <?php foreach ($jobs as $job): ?>
            <tr>
                <td><a href="<?php echo site_url('jobs/' . $job['id']); ?>"><?php echo $job['megnevezes']; ?></a></td>
                <td><?php echo $job['statusz']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
