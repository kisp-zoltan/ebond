<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>
    <?php echo validation_errors(); ?>

    <?php echo form_open('jobs/update_finished/' . $jobs['id'], 'class="w-50"'); ?>

    <div class="form-group">
        <label for="dolgozo">Dolgozó</label>
        <select name="dolgozo" class="form-control w-50">
            <?php foreach ($employees as $employee): ?>
                <option
                        value="<?php echo $employee['id'] ?>"
                        name="employee-<?php echo $employee['id']; ?>"
                    <?php if ($employee['id'] == $jobs['dolgozo']) echo 'selected="selected"' ?>
                >
                    <?php echo $employee['nev']; ?>
                </option>
            <?php endforeach; ?>
        </select><br/>

        <label for="oraszam">Óraszám</label>
        <input type="number" name="oraszam" value="<?php echo $jobs['oraszam'] ?>" min="1" max="999"
               class="form-control w-25" required/><br/>

        <input type="submit" name="submit" value="Frissítés" class="btn btn-primary"/>
    </div>

    </form>
</div>