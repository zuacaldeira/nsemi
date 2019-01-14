<h2 class="my-5">
    <?php echo $title; ?>
</h2>

<div class="clearfix my-1py-3">
    <?php if($original == null): ?>
    <input id="upload" type="file" name="original" class="float-left" required />
    <?php endif; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div id="previewer" class="col-md-8 border border-secondary p-0 overflow-auto" data-name="<?php echo $original['name']; ?>">
            <img src="<?php echo $original['data']; ?>" />
        </div>

        <aside class="col-md-4">

            <ul class="nav nav-tabs" id="transformationsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="resize-tab" data-toggle="tab" href="#resize" role="tab" aria-controls="resize" aria-selected="true">Resize</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="crop-thumbnail-tab" data-toggle="tab" href="#crop-thumbnail" role="tab" aria-controls="crop-thumbnail" aria-selected="false">Crop Thumbnail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="convert-tab" data-toggle="tab" href="#convert" role="tab" aria-controls="convert" aria-selected="false">Convert</a>
                </li>
            </ul>
            <div class="tab-content" id="transformation-form-tab">
                <div class="tab-pane fade show active" id="resize" role="tabpanel" aria-labelledby="resize-tab">
                    <?php echo form_open('news/create'); ?>
                    </div>
                    <div class="tab-pane fade" id="crop-thumbnail" role="tabpanel" aria-labelledby="crop-thumbnail-tab">...</div>
                    <div class="tab-pane fade" id="convert" role="tabpanel" aria-labelledby="convert-tab">...</div>
                </div>
        </aside>
        </div>

    </div>



    <script src="<?php echo base_url(); ?>assets/js/tools.js">
    </script>
