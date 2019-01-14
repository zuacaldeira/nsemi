<article id="tools-article" class="my-5">
    <h2 class="my-5 display-2">
        <?php echo $title; ?>
    </h2>

    <!-- File upload -->
    <section id="s-upload" class="my-5">
        <h3>1: Upload a photo</h3>
        <div class="shadow py-3">
            <input id="data" type="file" name="data" class="btn btn-sm btn-primary my-1 text-left" />
            <div id="previewer" class="border border-secondary p-0 overflow-auto" data-name="<?php echo $original['name']; ?>" data-width="<?php echo $original['width']; ?>" data-height="<?php echo $original['height']; ?>">
                <img src="<?php echo $original['data']; ?>" />
            </div>
        </div>
    </section>

    <!-- Transformation forms  -->
    <section id="s-transform" class="my-5">
        <h3 class="text-center">2: Choose Transformation</h3>
        <div class="container-fluid my-3 mx-auto w-50">
            <!-- Image Previewer -->
            <div id="iactions" class="my-1">
                <button id="btn-resize" type="button" class="btn btn-sm btn-primary mb-1" name="action" value="resize_one" disabled>Resize 1</button>
                <button id="btn-resize-many" type="button" class="btn btn-sm btn-primary mb-1" name="action" value="resize_many" disabled>Resize *</button>
                <button id="btn-crop-thumbnail" type="button" class="btn btn-sm btn-primary mb-1" name="action" value="crop_thumbnail" disabled>Crop</button>
                <button id="btn-convert" type="button" class="btn btn-sm btn-primary mb-1" name="action" value="convert_format" disabled>Convert</button>
            </div>
            <div id="forms">
            </div>
        </div>
    </section>

    <!-- View and analyze details -->
    <section id="s-player" class="my-5">
        <h3 class="text-center">3: Transformations</h3>
        <div id="iplayer" class="shadow rounded mx-auto">
            <button id="btn-details" class="btn btn-sm btn-outline-warning w-100 mb-1">Hide / Show Details</button>
            <button id="by-filename" class="btn btn-sm btn-outline-warning w-100 mb-1">by Filename</button>
            <button id="by-width" class="btn btn-sm btn-outline-warning w-100 mb-1">by Width</button>
            <button id="by-height" class="btn btn-sm btn-outline-warning w-100 mb-1">by Height</button>
            <button id="by-size" class="btn btn-sm btn-outline-warning w-100 mb-1">by Size</button>
            <button id="by-filter" class="btn btn-sm btn-outline-warning w-100 mb-1">by Filter</button>
            <button id="download" class="btn btn-sm btn-success w-100 mb-1">Download</button>
        </div>
        <div class="results w-auto my-5">
            <div id="thumbnails" class="row">
            </div>
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
