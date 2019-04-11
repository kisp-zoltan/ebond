<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2><br/>
    <table class="table w-50">
        <tr>
            <th>Megnevezés:</th>
            <td><?php echo $jobs['megnevezes'] ?></td>
        </tr>
        <tr>
            <th>Leírás:</th>
            <td><?php echo $jobs['leiras'] ?></td>
        </tr>
        <tr>
            <th>Partner:</th>
            <td><a href="<?php echo site_url('partners/' . $partners['id']) ?>"><?php echo $partners['nev'] ?></a></td>
        </tr>
        <tr>
            <th>Státusz:</th>
            <td><?php echo $jobs['statusz'] ?></td>
        </tr>
    </table>
    <a href="<?php echo site_url('jobs/update/' . $jobs['id']); ?>" class="btn btn-primary" role="button">Módosítás</a>
    <?php if ($jobs['statusz'] != 'kész') echo ' <a class="btn btn-primary" role="button" href="' . site_url('jobs/finalize/' . $jobs['id'] . '">Véglegesítés</a>'); ?>
</div>