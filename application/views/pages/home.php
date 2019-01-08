<div class="home-content">
    <h2 class="mt-5 mb-3">Welcome to Nsemi</h2>
    <div>
        <p class="text-muted display-3">Image Transformation Tool for Image Lovers
        </p>
        <div>
            <a class="btn btn-sm btn-outline-secondary my-1 text-left" href="<?php echo base_url(); ?>tools">Resize images, Create thumbnails, Convert images, Monetize your Images</a>
            <a class="btn btn-sm btn-outline-secondary my-1 text-left" href="<?php echo base_url(); ?>gallery">Search our image gallery</a>
            <a class="btn btn-sm btn-outline-secondary my-1 text-left" href="<?php echo base_url(); ?>news">Development Blog and News</a>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.home-content').position({
        of: 'body main'
    });
});
</script>