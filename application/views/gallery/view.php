<article id="gallery" class="container">
    <h2 class="my-5 clearfix sticky-top py-3 px-2">
        <?php echo $title; ?>
        <small class="text-muted"></small>
    </h2>
    <div class="container">
        <div class="row shadow p-auto small">
            <div id="image-wrapper" data-name="<?php echo $name; ?>" class="col-md-8 m-0 p-0">
                <img src="<?php echo $image['data_url']; ?>" />
            </div>
            <div class="col-md-4 bg-light text-secondary">
                <div id="image-details" class="mx-2 my-2">
                    <h3 class="border-bottom">Details</h3>

                    <!-- NAME -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Name:
                        </span>
                        <span id="details-owner" class="col text-right">
                            <?php echo $image['original_name']; ?>
                        </span>
                    </div>

                    <!-- Type -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Type:
                        </span>
                        <span id="details-type" class="col text-right">
                            <?php echo $image['mime_type']; ?>
                        </span>
                    </div>

                    <!-- OWNER -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Owner:
                        </span>
                        <span id="details-owner" class="col text-right">
                            <?php echo $image['owner']; ?>
                        </span>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Description:
                        </span>
                        <span id="details-owner" class="col text-right">
                            <?php 
                                if(isset($image['description'])) {
                                    echo $image['description'];
                                }
                                else {
                                    echo '--';
                                }
                            ?>
                        </span>
                    </div>
                    <!-- KEYWORDS -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Keywords:
                        </span>
                        <span id="details-keywords" class="col text-right">
                            <?php 
                                if(isset($image['keywords'])) {
                                    echo $image['keywords'];
                                }
                                else {
                                    echo '--';
                                }
                            ?>
                        </span>
                    </div>
                    <!-- COLORS -->
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Colors:
                        </span>
                        <span id="details-colors" class="col text-right">
                            <?php 
                                if(isset($image['colors'])) {
                                    echo $image['colors'];
                                }
                                else {
                                    echo '--';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Size:
                        </span>
                        <span id="details-size" class="col text-right">
                            <?php echo $image['size'].' KB'; ?> 
                            | 
                            <?php echo $image['original_size'].' KB'; ?>
                            <span class="badge badge-secondary">original</span>
                        </span>
                    </div>
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Width:
                        </span>
                        <span id="details-width" class="col text-right">
                            <?php echo $image['width'].' px'; ?>
                            | 
                            <?php echo $image['original_width'].' px'; ?>
                            <span class="badge badge-secondary">original</span>
                        </span>
                    </div>
                    <div class="row my-2">
                        <span class="col-auto text-left">
                        Height:
                        </span>
                        <span id="details-height" class="col text-right">
                            <?php echo $image['height'].' px'; ?>
                            | 
                            <?php echo $image['original_height'].' px'; ?>
                            <span class="badge badge-secondary">original</span>
                        </span>
                    </div>
                </div>
                <div id="image-actions" class="clearfix my-3">
                    <a href="<?php echo base_url().'tools/'.$image['name']; ?>" class="btn btn-sm btn-success float-right">Transform and Download</a>
                </div>
            </div>
        </div>
    </div>
</article>


<script>
    var resizeTimeout = false;

    $(document).ready(function() {
        loadImage();
        $(window).on('resize', function(event) {
            debounce();
        });
    });

    function loadImage() {

        var name = $('#image-wrapper').data('name');
        name = name.replace('_lg_thumb', '_xl_thumb');

        var width = $('#image-wrapper').innerWidth();
        $.ajax({
            url: '../assets/php/resize_image.php',
            data: {
                name: name,
                width: width,
                height: 0,
                from_db: true
            },
            success: function(result) {
                var image = result[0];
                var $img = $('#image-wrapper img');

                if ($img.length == 0) {
                    $img = $('<img>').attr('src', image.src);
                    $('#image-wrapper').append($img);
                } else {
                    $img.attr('src', image.src);
                }

                $('#details-owner').text(image.owner);
                $('#details-size').text(image.size.toFixed(2) + 'KB');
                $('#details-width').text(image.width.toFixed(2) + ' px');
                $('#details-height').text($img.height().toFixed(2) + ' px');
            },
            error: function() {
                alert('Error resizing image');
            }
        });
    }

    function debounce() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            loadImage();
        }, 1000);
    }

</script>
