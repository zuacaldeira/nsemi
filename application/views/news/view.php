<?php if($owner == $session_user): ?>
    <a id="edit" class="btn btn-sm btn-warning circle" href="<?php echo base_url().'news/update/'.$slug; ?>" title="Edit Article"><i class="fas fa-edit"></i>Edit</a>
<?php endif; ?>

<article id="article" class="container my-5 p-5">

    <div class="header border-bottom">
        <h2 class="display-3">
            <?php echo $title; ?>
        </h2>
        <p class="author clearfix">
            <span>by <i><?php echo $author; ?></i></span> | <span class="date small"><?php echo $date; ?></span>
        </p>
    </div>

    <div class="my-3 text-justify">
       <div class="summary col-sm-12 col-md-8 mx-auto my-5">
           <h5 class="text-center">Abstract</h5>
           <?php echo $summary; ?>
       </div>
       <div class="text col-sm-12 col-md-8 mx-auto my-5">
           <?php echo $text; ?>
       </div>
    </div>
</article>


<script src="<?php echo base_url(); ?>assets/js/embedded_image.js"></script>

<script>
    $(document).ready(function() {
        $('#edit')
            .prependTo($('#actions'))
            .addClass('mr-1')
            .fadeIn(10000);
        
        $('#article').css({
            background: 'white',
            color: '#222'
        });
        
        updateImagesSrc();
    });
    
</script>