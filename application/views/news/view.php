<?php if($owner == $session_user): ?>
    <a id="edit" class="btn btn-sm btn-warning circle" href="<?php echo base_url().'news/update/'.$slug; ?>" title="Edit Article"><i class="fas fa-edit"></i>Edit</a>
<?php endif; ?>

<article class="container my-5">

    <div class="header border-bottom">
        <h2>
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
       <div class="text">
           <?php echo $text; ?>
       </div>
    </div>
</article>


<script>
    $(document).ready(function() {
        $('#edit').css({
            position: 'fixed',
            top: '1.1em',
            right: '2em'
        });
    });
</script>