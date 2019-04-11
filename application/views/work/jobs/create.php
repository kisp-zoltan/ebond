<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>

    <?php echo validation_errors(); ?>

    <?php echo form_open('jobs/create', 'class="w-50"'); ?>

    <div class="form-group">
        <label for="megnevezes">Megnevezés</label>
        <input type="input" name="megnevezes" maxlength="128" class="form-control" required/><br/>

        <label for="leiras">Leírás</label>
        <textarea name="leiras" class="form-control"></textarea><br/>

        <label for="partner">Partner</label>
        <select name="partner" class="form-control w-50">
            <?php foreach ($partners as $partner): ?>
                <option
                        value="<?php echo $partner['id'] ?>"
                        name="partner-<?php echo $partner['id']; ?>">
                    <?php echo $partner['nev']; ?>
                </option>
            <?php endforeach; ?>
        </select><br/>

        <label for="statusz">Státusz</label>
        <select name="statusz" class="form-control w-50">
            <option value="inaktiv">Inaktív</option>
            <option value="folyamatban">Folyamatban</option>
        </select><br/>

        <input type="submit" name="submit" value="Hozzáadás" class="btn btn-primary"/>
    </div>

    </form>
</div>