<div class="p-2 align-items-start w-50"  >
    <h2><?php echo $title; ?></h2>
    <hr>

    <?php echo validation_errors(); ?>

    <?php echo form_open('partners/update/' . $partners['id'], 'class="w-50"'); ?>

    <div class="form-group">
        <label for="nev">Név</label>
        <input type="input" name="nev" value="<?php echo $partners['nev'] ?>" maxlength="56" class="form-control" required/><br/>

        <label for="beosztas">Cím</label>
        <input type="input" name="cim" value="<?php echo $partners['cim'] ?>" maxlength="56" class="form-control" required/><br/>

        <label for="email">E-mail</label>
        <input type="input" name="email" value="<?php echo $partners['email'] ?>" maxlength="56" class="form-control" required/><br/>

        <label for="telefon">Telefon</label>
        <input type="input" name="telefon" value="<?php echo $partners['telefon'] ?>" maxlength="12" class="form-control" required/><br/>

        <input type="submit" name="submit" value="Módosítás" class="btn btn-primary"/>
    </div>

    </form>
</div>