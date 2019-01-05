<?php 
    $username = $this->session->userdata('username');
?>
<div id="news" class="my-5">
    <h2 class="py-5">
        <?php echo $title; ?>
        <small class="text-muted">(<?php echo count($news); ?> articles)</small>
        <?php if($username != null): ?>
            <a class="btn btn-sm btn-primary d-inline float-right" href="news/create">Write Article</a>
        <?php endif; ?>
    </h2>


    <?php foreach($news as $news_item): ?>
    <h3>
        <?php echo $news_item['title']; ?>
    </h3>
    <div class="main">
        <?php echo $news_item['text'];  ?>
    </div>
    <p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View Article</a></p>

    <?php endforeach; ?>
</div>
