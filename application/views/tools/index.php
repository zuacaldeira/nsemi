<article id="tools-article" class="container-fluid my-5">
    <h2 class="my-5 display-3">
        <?php echo $title; ?>
    </h2>

    <!-- File upload -->
    <section id="s-upload" class="container-fluid my-5">
        <div class="row m-0 p-0">
            <div id="previewer" class="col-lg-8 overflow-auto w-100" data-name="<?php echo $original['name']; ?>" data-width="<?php echo $original['width']; ?>" data-height="<?php echo $original['height']; ?>">
                <img src="<?php echo $original['data']; ?>" class="" />
            </div>
            <aside class="col-lg-4 text-dark m-0 p-0 px-2 rounded">
                <!-- Image Previewer -->
                <?php if($original['name'] == null): ?>
                    <input id="data" type="file" name="data" class="btn btn-sm btn-outline-primary w-100 mx-auto mb-1" />
               <?php endif; ?> 
               <div id="iactions" class="w-100 btn-group">
                    <button id="btn-resize" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="resize_one" disabled>Resize 1</button>
                    <button id="btn-resize-many" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="resize_many" disabled>Resize *</button>
                    <button id="btn-crop-thumbnail" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="crop_thumbnail" disabled>Crop</button>
                    <button id="btn-crop-thumbnail-many" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="crop_thumbnail_many" disabled>Crop *</button>
                    <button id="btn-convert" type="button" class="btn btn-sm btn-outline-primary mb-1" name="action" value="convert_format" disabled>Convert</button>
                </div>
                <div id="forms" class="my-0">
                </div>
            </aside>
        </div>
    </section>

    <!-- View and analyze details -->
    <section id="result" class="container-fluid m-0 p-0 my-5 pt-5">
        <h3 class="text-center my-5 pt-5 display-3">2: Your Transformations</h3>
        <div id="transformations-status" class="text-center">
            <span class="badge badge-danger">
                Elapsed time:
                <span class="elapsed-time">0 s</span>
            </span>
        </div>
        <!-- Sort and Details Visibility -->
        <div id="iplayer" class="rounded sticky-top text-center my-5">
            <button id="btn-details" class="btn btn-sm btn-info mb-1">Hide / Show Details</button>
            <div class="btn-group">
            <button id="by-filename" class="btn btn-sm btn-outline-warning mb-1">by Filename</button>
            <button id="by-width" class="btn btn-sm btn-outline-warning mb-1">by Width</button>
            <button id="by-height" class="btn btn-sm btn-outline-warning mb-1">by Height</button>
            <button id="by-size" class="btn btn-sm btn-outline-warning  mb-1">by Size</button>
            <button id="by-filter" class="btn btn-sm btn-outline-warning mb-1">by Filter</button>
            </div>
            <div class="btn-group">
            <button id="download-selected" class="btn btn-sm btn-outline-success mb-1">Download Selected  (<span>0</span>)</button>
            <button id="download-all" class="btn btn-sm btn-outline-success mb-1">Download All (<span>0</span>) </button>
            </div>
        </div>
        <div id="thumbnails" class="row m-2 overflow-auto">
        </div>
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
