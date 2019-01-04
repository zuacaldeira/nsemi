<div id="news">
    <h2 class="my-5">
        <?php echo $title; ?>
    <a class="btn btn-sm btn-primary d-inline float-right" href="news/create">Write Article</a>
    <small class="text-muted">(<?php echo count($news); ?> articles)</small>
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
