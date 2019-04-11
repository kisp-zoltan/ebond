<div class="p-2 align-items-start w-50">
    <h2><?php echo $title; ?></h2>
    <hr>
    <?php echo validation_errors(); ?>

    <?php echo form_open('jobs/finalize/' . $jobs['id'], 'class="w-50" onsubmit="return confirm(' . "'A véglegesítés nem visszavonható! Megerősíti?'" . ')"'); ?>

    <input type="hidden" name="feladat" value="<?php echo $jobs['id'] ?>"/>

    <label for="dolgozo">Dolgozó</label>
    <select name="dolgozo" class="form-control w-50">
        <?php foreach ($employees as $employee): ?>
            <option
                    value="<?php echo $employee['id'] ?>"
                    name="employee-<?php echo $employee['id']; ?>">
                <?php echo $employee['nev']; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>

    <label for="oraszam">Óraszám</label>
    <input type="number" name="oraszam" value="1" min="1" max="999" class="form-control w-25"/><br/>

    <input type="submit" name="submit" value="Véglegesítés" class="btn btn-primary"/>

    </form>
</div>