<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2><br/>
    <table class="table w-50">
        <tr>
            <th>Név:</th>
            <td><?php echo $partners['nev'] ?></td>
        </tr>
        <tr>
            <th>Cím:</th>
            <td><?php echo $partners['cim'] ?></td>
        </tr>
        <tr>
            <th>E-mail cím:</th>
            <td><?php echo $partners['email'] ?></td>
        </tr>
        <tr>
            <th>Telefonszám:</th>
            <td><?php echo $partners['telefon'] ?></td>
        </tr>
        <tr>
            <th>Ráfordított munkaidő (óra):</th>
            <td><?php echo $hours['oraszam'] ?></td>
        </tr>
        <tr>
            <th>Feladatok száma (összes / inaktív / folyamatban / kész):</th>
            <td>
                <?php echo $jobs_all ?> /
                <?php echo $jobs_inactive ?> /
                <?php echo $jobs_active ?> /
                <?php echo $jobs_finished ?>
            </td>
        </tr>
    </table>
    <a href="<?php echo site_url('partners/update/' . $partners['id']); ?>" class="btn btn-primary" role="button">Módosítás</a>
</div>
