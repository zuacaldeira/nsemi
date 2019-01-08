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
    <div class="my-3 p-3 shadow">
        <h3 class="border-bottom border-secondary">
            <?php echo $news_item['title']; ?>
        </h3>
        <div class="body text-justify text-muted">
            <?php   
                echo $news_item['summary']; 
            ?>
            <a class="display-inline" href="<?php echo base_url().'news/'.$news_item['slug']; ?>">Read more</a>
        </div>
    </div>

    <?php endforeach; ?>
</div>
