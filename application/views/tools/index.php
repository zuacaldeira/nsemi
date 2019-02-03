<article id="tools-article" class="container">
    <!-- File upload -->
    <h2 class="my-5 display-3 text-center">
        <?php echo $title; ?>
    </h2>

    <section id="s-upload" class="container-fluid my-5 p-1 rounded">
        <div class="row m-0 p-0">
            <div id="previewer" class="col-md-8 overflow-auto w-100" data-name="<?php echo $image['name']; ?>" data-width="<?php echo $image['width']; ?>" data-height="<?php echo $image['height']; ?>">
                <img src="<?php echo $image['data_url']; ?>" class="" />
            </div>
            <aside class="col-md-4 text-dark m-0 p-2 py-auto mx-auto">
                <!-- Image Previewer -->
                <?php if($image['name'] == null): ?>
                <input id="data" type="file" name="data" class="btn btn-sm btn-primary w-100 mx-auto mb-1" />
                <?php endif; ?>
                <div id="iactions" class="w-100 btn-group">
                    <button id="btn-resize" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="resize_one" disabled>Resize 1</button>
                    <button id="btn-resize-many" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="resize_many" disabled>Resize *</button>
                    <button id="btn-crop-thumbnail" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="crop_thumbnail" disabled>Crop</button>
                    <button id="btn-crop-thumbnail-many" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="crop_thumbnail_many" disabled>Crop *</button>
                    <button id="btn-convert" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="convert_format" disabled>Convert</button>
                </div>
                <div id="forms" class="m-0 p-0">
                </div>
                <div id="transformations-status" class="text-right">
                    <span class="badge badge-danger">
                        Elapsed time:
                        <span class="elapsed-time">0 s</span>
                    </span>
                </div>
            </aside>
        </div>

    </section>
    <!-- View and analyze details -->
    <section id="result" class="container-fluid ">
        <h3 class="text-center my-5 display-4">Image Transformations</h3>
        <!-- Sort and Details Visibility -->
        <div id="iplayer" class="rounded text-center ">
            <div class="btn-group-vertical">
                <button id="expand" class="btn btn-sm btn-danger"><i class="fas fa-expand-arrows-alt"></i></button>
                <button id="compress" class="btn btn-sm btn-danger"><i class="fas fa-compress-arrows-alt"></i></button>
            </div>
            <div class="btn-group-vertical">
                <button id="btn-details-show" class="btn btn-sm btn-secondary" title="SHOW Details"><i class="fas fa-eye small"></i></button>
                <button id="btn-details-hide" class="btn btn-sm btn-secondary" title="HIDE Details"><i class="fas fa-eye-slash small"></i></button>
            </div>
            <div class="btn-group-vertical shadow">
                <button id="by-filename" class="btn btn-sm btn-warning" title="Sort by FILENAME"><i class="fas fa-sort-alpha-down"></i></button>
                <button id="by-width" class="btn btn-sm btn-warning" title="Sort by WIDTH"><i class="fas fa-arrows-alt-h"></i></button>
                <button id="by-height" class="btn btn-sm btn-warning" title="Sort by HEIGHT"><i class="fas fa-arrows-alt-v"></i></button>
                <button id="by-size" class="btn btn-sm btn-warning" title="Sort by FILE SIZE"><i class="fas fa-file-medical-alt"></i></button>
                <button id="by-filter" class="btn btn-sm btn-warning" title="Sort by FILTER"><i class="fas fa-filter"></i></button>
            </div>

            <div class="btn-group-vertical">
                <button id="download-all" class="btn btn-sm btn-success" title="Download All"><i class="fas fa-download"></i> (<span>0</span>) </button>
            </div>
        </div>
        <div id="thumbnails" class="row"></div>

    </section>

</article>


<!-- JAVASCRIPT -->
<script src="https://fastcdn.org/FileSaver.js/1.1.20151003/FileSaver.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/jszip.js">


</script>



<script src="<?php echo base_url(); ?>assets/js/upload.js">


</script>

<script src="<?php echo base_url(); ?>assets/js/previewer.js">


</script>


<script src="<?php echo base_url(); ?>assets/js/transformations.js">


</script>


<script>
    $(document).ready(function() {
        $(document).on('load', '.single-image', function(event) {
            $(this).animate({
                width: 150,
                height: 150
            });
        });
    });

</script>
