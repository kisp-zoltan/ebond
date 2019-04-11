<div class="p-2 align-items-start w-50"  >
    <h2><?php echo $title; ?></h2><br />
    <table class="table w-50">
        <tr>
            <th>Név:</th>
            <td><?php echo $employees['nev'] ?></td>
        </tr>
        <tr>
            <th>Beosztás:</th>
            <td><?php echo $employees['beosztas'] ?></td>
        </tr>
        <tr>
            <th>E-mail cím:</th>
            <td><?php echo $employees['email'] ?></td>
        </tr>
        <tr>
            <th>Telefonszám:</th>
            <td><?php echo $employees['telefon'] ?></td>
        </tr>
        <tr>
            <th>Munkaidő (órák):</th>
            <td><?php if(is_null($hours['oraszam'])) echo "0"; else echo $hours['oraszam']; ?></td>
        </tr>
        <tr>
            <th>Elvégzett feladatok száma:</th>
            <td><?php echo $jobs ?></td>
        </tr>
    </table>
    <a href="<?php echo site_url('employees/update/'.$employees['id']); ?>" class="btn btn-primary" role="button" >Módosítás</a>
</div>