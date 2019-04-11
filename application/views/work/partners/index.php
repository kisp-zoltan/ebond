<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>
    <p><a href="<?php echo site_url('partners/create'); ?>" class="btn btn-primary" role="button">Új hozzáadása</a></p>
    <table class="table">
        <tr>
            <thead>
            <th>Név</th>
            <th>E-mail</th>
            </thead>
        </tr>
        <?php foreach ($partners as $partner): ?>

            <tr>
                <td><a href="<?php echo site_url('partners/' . $partner['id']); ?>"><?php echo $partner['nev']; ?></a>
                </td>
                <td><?php echo $partner['email']; ?></td>
            </tr>

        <?php
        endforeach; ?>
    </table>
</div>
