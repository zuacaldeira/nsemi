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
                    <div class="p-1 container">
                        <div id="single-dimension" class="my-2 p-2">
                            <input class="mb-3" id="single-dimension-radio" type="radio" name="dimension" checked /> Single Dimension
                            <div id="single-dimension" class="row m-0 mb-2">
                                <input name="swidth" class="col-6 width border-0 shadow  bg-transparent text-light" type="number" placeholder="w: " />
                                <input name="sheight" class="col-6 height  border-0 shadow  bg-transparent text-light" type="number" placeholder="h: " />
                            </div>
                        </div>
                        <!--div id="multiple-dimensions" class="my-2 p-2">
                                <input class="mb-3"  id="multiple-dimensions-radio" type="radio" name="dimension"/> Multiple Dimensions
                                <div id="options-container" >
                                    <div id="min-dimensions" class="row m-0 mb-3" title="Min Dimensions">
                                        <input name="min-width" class="col-6 width border-0 shadow bg-transparent text-light" type="number" placeholder="w: " />
                                        <input name="min-height"  class="col-6 height  border-0 shadow bg-transparent text-light" type="number" placeholder="h: " />
                                    </div>
                                    <div id="max-dimensions" class="row m-0 mb-3" title="Max Dimensions">
                                        <input name="max-width"  class="col-6 width border-0 shadow bg-transparent text-light" type="number" placeholder="W: " />
                                        <input name="max-height"  class="col-6 height  border-0 shadow bg-transparent text-light" type="number" placeholder="H: " />
                                    </div>
                                    <div id="step-dimensions" class="row m-0 mb-3" title="Step">
                                        <input name="step-width" class="col-6 width border-0 shadow bg-transparent text-light" type="number" placeholder="dw: " />
                                        <input name="step-height" class="col-6 height  border-0 shadow bg-transparent text-light" type="number" placeholder="dh: " />
                                    </div>
                                </div>
                            </div>
                        </div -->
                        <div class="my-2 p-2">
                            <label for="select-filter">Filter</label>
                            <select id="select-filter" class="w-100 height" multiple>
                                <option>FILTER_UNDEFINED</option>
                                <option>FILTER_POINT</option>
                                <option>FILTER_BOX</option>
                                <option>FILTER_TRIANGLE</option>
                                <option>FILTER_HERMITE</option>
                                <option>FILTER_HANNING</option>
                                <option>FILTER_HAMMING</option>
                                <option>FILTER_BLACKMAN</option>
                                <option>FILTER_GAUSSIAN</option>
                                <option>FILTER_QUADRATIC</option>
                                <option>FILTER_CUBIC</option>
                                <option>FILTER_CATROM</option>
                                <option>FILTER_MITCHELL</option>
                                <option>FILTER_LANCZOS</option>
                                <option>FILTER_BESSEL</option>
                                <option>FILTER_SINC</option>
                            </select>
                        </div>
                        <div class="my-2 p-2">
                            <input type="submit" class="btn btn-sm btn-success w-100" value="Resize"/>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="crop-thumbnail" role="tabpanel" aria-labelledby="crop-thumbnail-tab">...</div>
                    <div class="tab-pane fade" id="convert" role="tabpanel" aria-labelledby="convert-tab">...</div>
                </div>
        </aside>
        </div>

    </div>



    <!--div id="result">
        <div id="iplayer" class="bg-dark shadow rounded my-2 p-3 sticky-top clearfix" style="display: none;">
            <div class="btn-group">
                <button id="btn-details" class="btn btn-sm btn-outline-warning">Hide / Show Details</button>
            </div>
            <div class="btn-group">
                <button id="by-filename" class="btn btn-sm btn-outline-warning">by Filename</button>
                <button id="by-width" class="btn btn-sm btn-outline-warning">by Width</button>
                <button id="by-height" class="btn btn-sm btn-outline-warning">by Height</button>
                <button id="by-size" class="btn btn-sm btn-outline-warning">by Size</button>
                <button id="by-filter" class="btn btn-sm btn-outline-warning">by Filter</button>
            </div>
            <div class="btn-group float-right">
                <button id="download" class="btn btn-sm btn-success">Download</button>
            </div>
        </div>

        <div id="thumbnails" class="m-0 p-0 container-fluid">

        </div>
    </div-->


    <script src="<?php echo base_url(); ?>assets/js/tools.js">
    </script>
