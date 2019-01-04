<div id="gallery" class="container-fluid">
    <h2 class="my-5 clearfix">
        <?php echo $title; ?>
        <a class="btn btn-sm btn-primary d-inline float-right" href="gallery/create">Upload Image</a>
    </h2>
    <div class="">
        <?php foreach($images as $item): ?>
            <img src="<?php echo $item['data']; ?>" class="card shadow d-inline" />
        <?php endforeach; ?>
    </div>
</div>
