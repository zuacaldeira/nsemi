<h2 class="my-5"><?php echo $title; ?>
    <button class="btn btn-sm btn-primary d-inline">Upload Image</button>
</h2>
<div id="gallery" class="container-fluid">
   <div class="card-columns">
    <?php foreach($images as $item): ?>
      <div class="card shadow">
           <img src="<?php echo $item['data'] ?>" class="w-100 p-1"/>
      </div>
    <?php endforeach; ?>
   </div>
</div>
