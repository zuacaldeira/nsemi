<div id="gallery" class="container-fluid">
    <h2 class="my-5 clearfix sticky-top bg-light py-3 shadow px-2">
        <?php echo $title; ?>
        <a class="btn btn-sm btn-primary d-inline float-right" href="gallery/create">Upload Image</a>
        <small class="text-muted">(<?php echo count($images); ?> images)</small>
    </h2>
    <div class="">
        <?php foreach($images as $item): ?>
            <img src="<?php echo $item['data']; ?>" class="shadow mb-1 bg-transparent d-inline-block" style="min-height:150px;"/>
        <?php endforeach; ?>
    </div>
</div>
