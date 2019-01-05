<div class="my-5 pt-5">

    <h2>
        <?php echo $title; ?>
    </h2>

</div>

<div>
    <?php echo form_open('news/create'); ?>

    <div>
        <label for="title" class="w-100">Title</label>
        <h2>
            <input type="input" name="title" class="w-100" />
            <?php echo '<small>'.form_error('title').'</small>'; ?>         
        </h2>
    </div>

    <div>
        <label for="text" class="w-100">Text</label>
        <textarea name="text" class="w-100" rows="10"></textarea>
        <?php echo form_error('text'); ?>         
    </div>

    <div class="my-4">
        <input type="reset" name="cancel" value="Clear" class="btn btn-small btn-danger" />
        <input type="submit" name="submit" value="Create news item" class="btn btn-small btn-success" />
    </div>

    </form>

</div>
