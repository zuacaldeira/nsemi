<article class="container">
    <h2 class="my-5">Nsemi Image Processing Tool</h2>

    <?php echo form_open_multipart('gallery/create'); ?>

    <div class="clearfix my-1">
        <input id="data" type="file" name="data" class="" />
        <button type="submit" id="btn-upload" value="Upload" class="btn btn-sm btn-primary float-right" title="Upload Image" disabled>Upload</button>
    </div>

    <div id="previewer" class="border border-secondary my-2 w-100 overflow-auto position-relative" style="width: 100%;">
        <img src="" />
    </div>


    </form>

</article>


<script src="<?php echo base_url(); ?>assets/js/upload.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/previewer.js">
</script>

