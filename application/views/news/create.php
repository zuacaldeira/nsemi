<section id="news" class="container my-5">
    <h2>
        <?php echo $title; ?>
    </h2>
    <article class="container news-article">
        <?php echo form_open('news/create'); ?>
            <div class="wrapper">
                <label for="title" class="w-100">Title</label>
                <h2>
                    <input class="w-100" type="text" name="title" value="<?php echo set_value('title'); ?>" />
                    <?php echo '<small>'.form_error('title').'</small>'; ?>
                </h2>
            </div>
            <div class="wrapper">
                <label for="summary" class="w-100">Abstract</label>
                <textarea class="w-100" name="summary" rows="5"><?php echo set_value('summary'); ?></textarea>
                <?php echo '<small>'.form_error('summary').'</small>'; ?>
            </div>
            <div class="wrapper">
                <label for="text" class="w-100">Text</label>
                <textarea name="text" class="w-100 content" rows="10"><?php echo set_value('text'); ?></textarea>
                <?php echo form_error('text'); ?>
            </div>
            <div class="wrapper">
                <input class="w-100" type="text" name="slug" value="<?php echo set_value('slug'); ?>" hidden/>
            </div>
            <div class="wrapper">
                <input class="w-100" type="text" name="id" value="<?php echo set_value('id'); ?>" hidden/>
            </div>
            <div class="wrapper">
                <input class="w-100" type="text" name="createdAt" value="<?php echo set_value('createdAt'); ?>" hidden/>
            </div>
            <div class="wrapper">
                <input type="reset" name="cancel" value="Clear" class="btn btn-small btn-danger" />
                <input type="submit" name="submit" value="Save" class="btn btn-small btn-success" />
            </div>
        </form>

    </article>
</section>

<script src="<?php echo base_url(); ?>assets/plugins/jquery.richtext.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/embedded_image.js"></script>

<script src="<?php echo base_url(); ?>assets/js/news-editor.js"></script>
