<section class="container my-5 pt-5">

    <h2>
        <?php echo $title; ?>
    </h2>

    <article class="container news-article">
        <?php echo form_open('news/update'); ?>
            <div class="wrapper">
                <label for="title" class="w-100">Title</label>
                <h2>
                    <input 
                        class="w-100" 
                        type="input" 
                        name="title" 
                        value="<?php echo set_value('title'); ?>"/>
                    <?php echo '<small>'.form_error('title').'</small>'; ?>         
                </h2>
            </div>
            <div class="wrapper">
                <label for="text" class="w-100">Text</label>
                <textarea name="text" class="w-100 content" rows="10"><?php echo set_value('text'); ?></textarea>
                <?php echo form_error('text'); ?>         
            </div>
            <div class="wrapper">
               <input type="reset" name="cancel" value="Clear" class="btn btn-small btn-danger" />
               <input type="submit" name="submit" value="Update article" class="btn btn-small btn-success" />
            </div>
        </form>
   </article>
</section>

<script src="<?php echo base_url(); ?>assets/plugins/jquery.richtext.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/embedded_image.js"></script>
<script src="<?php echo base_url(); ?>assets/js/news-editor.js"></script>
