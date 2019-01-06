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

    <div class="my-3">
        <?php echo $text; ?>
    </div>
</article>

