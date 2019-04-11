<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2><br/>
    <table class="table">
        <tr>
            <thead>
            <th>Feladat</th>
            <th>Dolgozó</th>
            <th>Óraszám</th>
            <th></th>
            </thead>
        </tr>
        <?php foreach ($jobs as $job): ?>
            <tr>
                <td><a href="<?php echo site_url('jobs/' . $job['feladat']); ?>"><?php echo $job['megnevezes']; ?></a>
                </td>
                <td><a href="<?php echo site_url('employees/' . $job['id']); ?>"><?php echo $job['nev']; ?></a></td>
                <td><?php echo $job['oraszam']; ?></td>
                <td><a href="<?php echo site_url('jobs/update_finished/' . $job['id']); ?>" class="btn-sm btn-primary"
                       role="button">Módosítás</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>