<h2 class="my-5">
    <?php echo $title; ?>
</h2>

<div class="container-fluid">
    <div class="row">
        <div id="previewer" class="col-md-8 border border-secondary p-0 overflow-auto" data-name="<?php echo $name; ?>">
            <img src="<?php echo $data_url; ?>" />
        </div>

        <aside class="col-md-4">
            <?php echo form_open('tools/resize_one'); ?>
                <div class="px-1 container">
                    <div id="single-dimension" class="mb-2">
                        <input 
                           name="width" 
                           class="w-100 border-0 shadow  bg-transparent text-light mb-1" 
                           type="number" 
                           placeholder="Width: "
                           value="<?php echo set_value('width'); ?>" />
                        <small class="text-danger"><?php echo form_error('width'); ?></small>   
                        <input 
                            name="height" 
                            class="w-100 border-0 shadow  bg-transparent text-light" 
                            type="number" 
                            placeholder="Height: "
                            value="<?php echo set_value('height'); ?>" />
                        <small class="text-danger"><?php echo form_error('height'); ?></small>   
                    </div>
                    <div class="my-2 p-2">
                        <label for="select-filter">Filter</label>
                        <select id="select-filter" class="w-100 height" multiple>
                            <option>FILTER_UNDEFINED</option>
                            <option>FILTER_POINT</option>
                            <option>FILTER_BOX</option>
                            <option>FILTER_TRIANGLE</option>
                            <option>FILTER_HERMITE</option>
                            <option>FILTER_HANNING</option>
                            <option>FILTER_HAMMING</option>
                            <option>FILTER_BLACKMAN</option>
                            <option>FILTER_GAUSSIAN</option>
                            <option>FILTER_QUADRATIC</option>
                            <option>FILTER_CUBIC</option>
                            <option>FILTER_CATROM</option>
                            <option>FILTER_MITCHELL</option>
                            <option>FILTER_LANCZOS</option>
                            <option>FILTER_BESSEL</option>
                            <option>FILTER_SINC</option>
                        </select>
                    </div>
                    <div class="my-2 p-2">
                        <input type="submit" class="btn btn-sm btn-success w-100" value="Resize" />
                    </div>
                </div>
            </form>
        </aside>
    </div>
</div>
<?php if(isset($resized)): ?>
    <div 
        id="resized"
        class="container-fluid m-0 p-0 my-5" 
        data-width="<?php echo $width; ?>"
        data-height="<?php echo $height; ?>"
    >
        <img src="<?php echo $resized; ?>">
    </div>
<?php endif; ?>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/js/previewer.js"></script>
<script>
$(document).ready(function() {
    $resized = $('#resized');
    $resized.innerWidth($resized.data('width'));
    $resized.innerHeight($resized.data('height'));
    updateImage($('#resized'));
});    
</script>