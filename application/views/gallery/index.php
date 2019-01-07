<?php 
    $username = $this->session->userdata('username'); 
?>  
<div id="gallery" class="container-fluid">
    <h2 class="my-5 clearfix sticky-top py-3 px-2">
        <?php echo $title; ?>
        <?php if($username != null): ?>
            <a class="btn btn-sm btn-primary d-inline float-right" href="gallery/create">Upload Image</a>
        <?php endif; ?>
        <small class="text-muted">(<?php echo count($images); ?> images)</small>
    </h2>
    <div class="">
        <?php foreach($images as $item): ?>
            <img src="<?php echo $item['data']; ?>" class="mb-1" style="height: 150px;"/>
        <?php endforeach; ?>
    </div>
</div>
