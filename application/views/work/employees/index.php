<div class="p-2 align-items-start w-50"  >
    <h2><?php echo $title; ?></h2>
    <hr>
    <p><a href="<?php echo site_url('employees/create'); ?>" class="btn btn-primary" role="button" >Új hozzáadása</a></p>
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Beosztás</th>
            </tr>
        </thead>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><a href="<?php echo site_url('employees/'.$employee['id']); ?>"><?php echo $employee['nev']; ?></a></td>
                <td><?php echo $employee['beosztas']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>