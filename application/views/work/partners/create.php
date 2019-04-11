<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>

    <?php echo validation_errors(); ?>

    <?php echo form_open('partners/create', 'class="w-50"'); ?>

    <div class="form-group">
        <label for="nev">Név</label>
        <input type="input" name="nev" maxlength="56" class="form-control" required/><br/>

        <label for="cim">Cím</label>
        <input type="input" name="cim" maxlength="56" class="form-control" required/><br/>

        <label for="email">E-mail</label>
        <input type="input" name="email" maxlength="56" class="form-control" required/><br/>

        <label for="telefon">Telefon</label>
        <input type="input" name="telefon" maxlength="12" class="form-control" required/><br/>

        <input type="submit" name="submit" value="Hozzáadás" class="btn btn-primary"/>
    </div>

    </form>
</div>
