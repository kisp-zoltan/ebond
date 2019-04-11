<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>

    <?php echo validation_errors(); ?>

    <?php echo form_open('jobs/update/' . $jobs['id'], 'class="w-50"'); ?>

    <div class="form-group">
        <label for="megnevezes">Megnevezés</label>
        <input type="input" name="megnevezes" value="<?php echo $jobs['megnevezes'] ?>" maxlength="128"
               class="form-control" required/><br/>

        <label for="leiras">Leírás</label>
        <textarea name="leiras" class="form-control"><?php echo $jobs['leiras'] ?></textarea><br/>

        <label for="partner">Partner</label>
        <select name="partner" class="form-control w-50">
            <?php foreach ($partners as $partner): ?>
                <option
                        value="<?php echo $partner['id'] ?>"
                        name="partner-<?php echo $partner['id']; ?>"
                    <?php if ($partner['id'] == $jobs['partner']) echo 'selected="selected"' ?>>
                    <?php echo $partner['nev']; ?>
                </option>
            <?php endforeach; ?>
        </select><br/>

        <label for="statusz">Státusz</label>
        <select name="statusz" <?php if ($jobs['statusz'] == 'kész') echo ' disabled="disabled"' ?>
                class="form-control w-50">
            <option
                    name="inaktiv"
                    value="inaktív"
                <?php if ($jobs['statusz'] == 'inaktív') echo ' selected="selected"' ?>>
                Inaktív
            </option>
            <option
                    name="folyamatban"
                    value="folyamatban"
                <?php if ($jobs['statusz'] == 'folyamatban') echo ' selected="selected"' ?>>
                Folyamatban
            </option>
            <option
                    name="kesz"
                    value="kész"
                    hidden="hidden"
                <?php if ($jobs['statusz'] == 'kész') echo ' selected="selected"' ?>>
                Kész
            </option>
        </select><br/>

        <input type="submit" name="submit" value="Módosítás" class="btn btn-primary"/>
    </div>

    </form>
</div>