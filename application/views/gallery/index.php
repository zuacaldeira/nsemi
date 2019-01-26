<article class="container">
    <?php 
    $username = $this->session->userdata('username'); 
?>
    <?php if($username != null): ?>
    <a id="upload-button" class="btn btn-sm btn-warning mr-1" href="gallery/create"><i class="fas fa-upload"></i> Upload Image</a>
    <?php endif; ?>

    <div class="row">
        <div id="gallery-wrapper" class="col-md-6 mx-auto">
            <h2 class="my-5 clearfix sticky-top py-3 text-center">
                <?php echo $title; ?>
                <small class="text-muted">(<?php echo count($images); ?> images)</small>
            </h2>

            <input type="text" name="search-gallery" class="w-100 px-2 text-light" placeholder="Search..." />
        </div>
    </div>
    <div class="my-5">
       <div class="thumbnails mx-auto">
            <?php foreach($images as $item): ?>
                    <a href="gallery/<?php echo $item['name']; ?>" class="mx-auto">
                        <img src="<?php echo $item['data']; ?>" style="width:150px; height:100px;"
                        class="mb-1"/>
                    </a>
            <?php endforeach; ?>
       </div>
    </div>
</article>

<script src="<?php echo base_url(); ?>assets/js/embedded_image.js"></script>
<script>
    $(document).ready(function() {
        $('#upload-button')
            .prependTo($('#actions'))
            .addClass('mr-1')
            .fadeIn(10000);
    });
    //updateImagesSrc();
    
    
</script>
