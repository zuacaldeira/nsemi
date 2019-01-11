<h2 class="my-5">
    <?php echo $title; ?>
</h2>

<div class="clearfix my-1py-3">
    <?php if($original == null): ?>
    <input id="upload" type="file" name="original" class="float-left" required />
    <?php endif; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Image Previewer -->
        <div id="previewer" class="col-md-9 border border-secondary p-0 overflow-auto" 
           data-name="<?php echo $original['name']; ?>"
           data-width="<?php echo $original['width']; ?>"   
           data-height="<?php echo $original['height']; ?>"   
        >
            <img src="<?php echo $original['data']; ?>" />
        </div>

        <aside class="col-md-3">
            <div class="my-1">
                <button class="btn btn-sm btn-success w-100">Resize 1</button>
            </div>
            <div class="my-1">
                <button class="btn btn-sm btn-success w-100">Resize *</button>
            </div>
            <div class="my-1">
                <button class="btn btn-sm btn-success w-100">Crop Thumbnail</button>
            </div>
            <div class="my-1">
                <button class="btn btn-sm btn-success w-100">Convert Formats</button>
            </div>
        </aside>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/js/tools.js">
</script>
<script>
    var image_data = null;
    
    $(document).ready(function(){
        
        $('#previewer img').on('load', function(event){
            updateImage($(this));
        });
        
        $(window).on('resize', function(event) {
            updateImage();
        })
    });
    
    function updateImage($image) {
            var image_width = getImageWidth();            
            var image_height = getImageHeight();
            var image_ratio = image_width/image_height;
            
            if($image) {
                $image.hide();
            }
            var width = $('#previewer').innerWidth();
            var height = width/image_ratio;
            
            
            $('#previewer').css({
                width: width,
                height: height,
               background: 'url(' + getImageData() + ')',
               backgroundRepeat: 'no-repeat',
               backgroundSize: 'cover'
            });
    }
    
    function getImageData() {
        if(image_data == null) {
            image_data =  $('#previewer img').attr('src');
        }
        return image_data;
    }
    
    function getImageWidth() {
        return $('#previewer img').innerWidth();
    }
    
    function getImageHeight() {
        return $('#previewer img').innerHeight();
    }
    
    
</script>
