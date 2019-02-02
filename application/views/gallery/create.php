<article class="container">
    <h2 class="my-5">Nsemi Image Processing Tool</h2>

    <?php echo form_open_multipart('gallery/create'); ?>

   <?php if(count($error) > 0): ?>
       <div class="error"><?php echo $error['error']; ?></div>
   <?php endif; ?>
   
    <div class="row">
        <!-- IMage wrapper -->
        <div id="image-wrapper" class="col-md-8">
            <input id="data" type="file" name="data" class="" />
            <div id="previewer" class="border border-secondary my-2 w-100 overflow-auto position-relative" style="width: 100%;">
                <img src="" />
            </div>
        </div>

        <!-- Image details -->
        <div id="image-details" class="col-md-4">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="w-100">Name</label>
                <input id="name" name="name" type="text" class="w-100" />
            </div>
            <!-- Owner -->
            <div class="mb-3">
                <label for="owner" class="w-100">Owner (auto)</label>
                <input id="owner" name="owner" type="text" class="w-100" disabled value="<?php echo $this->session->userdata('username'); ?>" />
            </div>
            <!-- Width -->
            <div class="mb-3">
                <label for="width" class="w-100">Width (auto)</label>
                <input id="width" name="width" type="text" class="w-100" disabled/>
            </div>
            <!-- Height -->
            <div class="mb-3">
                <label for="height" class="w-100">Height (auto)</label>
                <input id="height" name="height" type="text" class="w-100" disabled/>
            </div>
            <!-- Conversion Method -->
            <div class="mb-3">
                <label for="conversion_method" class="w-100">Conversion Method</label>
                <select id="conversion_method" name="conversion_method" class="w-100">
                    <option>Free</option>
                    <option>Donation</option>
                    <option>Decimal</option>
                    <option>Centesimal</option>
                </select>
            </div>
            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="w-100">Description</label>
                <textarea name="description" class="w-100"></textarea>
            </div>
            <!-- Keywords -->
            <div class="mb-3">
                <label for="keywords" class="w-100">Keywords (Comma-separated list)</label>
                <input name="keywords" class="w-100" />
            </div>
            <!-- Colors -->
            <div class="mb-3">
                <label for="colors" class="w-100">Colors (Comma-separated list)</label>
                <input name="colors" class="w-100"/>
            </div>
            <!-- Submit -->
            <div class="my-1">
                <button type="submit" id="btn-upload" value="Upload" class="btn btn-sm btn-primary" title="Upload Image" disabled>Upload</button>
            </div>
        </div>
    </div>




    </form>

</article>


<script src="<?php echo base_url(); ?>assets/js/upload.js">


</script>
<script src="<?php echo base_url(); ?>assets/js/previewer.js">


</script>
<script>
    $(function() {
        $('form #image-details').addClass('shadow');
    });

</script>
