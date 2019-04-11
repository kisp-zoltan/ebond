<div class="p-2 align-items-start w-50"  >
    <h2><?php echo $title; ?></h2>
    <hr>

    <?php echo validation_errors(); ?>

    <?php echo form_open('employees/update/'.$employees['id'], 'class="w-50"'); ?>

    <div class="form-group">
        <label for="nev">Név</label>
        <input type="input" name="nev" value="<?php echo $employees['nev'] ?>" maxlength="56" class="form-control" required /><br />

        <label for="beosztas">Beosztás</label>
        <input type="input" name="beosztas" value="<?php echo $employees['beosztas'] ?>" maxlength="56" class="form-control" required /><br />

        <label for="email">E-mail</label>
        <input type="input" name="email" value="<?php echo $employees['email'] ?>" maxlength="56" class="form-control" required /><br />

        <label for="telefon">Telefon</label>
        <input type="input" name="telefon" value="<?php echo $employees['telefon'] ?>" maxlength="12" class="form-control" required /><br />

        <input type="submit" name="submit" value="Módosítás" class="btn btn-primary"/>
    </div>

    </form>
</div>