<?php 
    $username = $this->session->userdata('username'); 
?>  
<?php if($username != null): ?>
    <a id="upload-button" class="btn btn-sm btn-warning mr-1" href="gallery/create"><i class="fas fa-upload"></i> Upload Image</a>
<?php endif; ?>

<div id="gallery" class="container-fluid">
    <h2 class="my-5 clearfix sticky-top py-3 px-2">
        <?php echo $title; ?>
        <small class="text-muted">(<?php echo count($images); ?> images)</small>
    </h2>
    <div class="">
        <?php foreach($images as $item): ?>
            <a href="gallery/<?php echo str_replace('_sm_', '_lg_',$item['name']); ?>">
                <img src="<?php echo $item['data']; ?>" class="mb-1" style="height: 150px;"/>
            </a>
        <?php endforeach; ?>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('#upload-button')
            .prependTo($('#actions'))
            .addClass('mr-1')
            .fadeIn(10000);
    });
</script>


