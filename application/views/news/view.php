<article class="container my-5">

    <div class="header border-bottom">
        <h2>
            <?php echo $title; ?>
        </h2>
        <p class="author clearfix">
            <span>by <i><?php echo $author; ?></i></span> | <span class="date small"><?php echo $date; ?></span>
            <?php if($owner == $session_user): ?>
            <a id="edit" class="btn btn-sm btn-primary float-right" href="<?php echo base_url().'news/update/'.$slug; ?>"><i></i>Edit Article</a>
            <?php endif; ?>
        </p>
    </div>

    <div class="my-3 text-justify">
       <div class="summary col-sm-12 col-md-8 mx-auto my-5">
           <h5 class="text-center">Abstract</h5>
           <?php echo $summary; ?>
       </div>
       <div class="text">
           <?php echo $text; ?>
       </div>
    </div>
</article>

