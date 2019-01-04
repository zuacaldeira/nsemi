<h2 class="my-5"><?php echo $title; ?></h2>

<div class="clearfix my-1 sticky-top bg-light py-3">
    <input id="upload" type="file" name="original" class="float-left" required />
    <div id="iactions" class="float-right m-0">
        <button id="ia-resize" class="btn btn-sm btn-outline-secondary" title="Resize Image" style="border-radius: 50%; width: 32px; height: 32px;" disabled>
            R
        </button>
        <button id="ia-thumbnail" class="btn btn-sm btn-outline-secondary" title="CreateThumbnail" style="border-radius: 50%; width: 32px; height: 32px;" disabled>
            T
        </button>
        <button id="ia-convert" class="btn btn-sm btn-outline-secondary" title="Convert Image" style="border-radius: 50%; width: 32px; height: 32px;" disabled>
            C
        </button>
    </div>
</div>
<div id="dialogs" class="d-none text-success position-absolute">
    <form id="id-resize" title="Resize Image Dialog" class="shadow text-secondary border border-secondary">
        <div class="p-1 container">
            <div>
                <input id="single-dimension-radio" type="radio" name="dimension" checked/>Single Dimension
                <div id="single-dimensions" class="row m-0 mb-2">
                    <input class="col-6 width border-0 shadow" type="number" placeholder="w: " />
                    <input class="col-6 height  border-0 shadow" type="number" placeholder="h: " />
                </div>
            </div>
            <div>
                <input id="multiple-dimensions-radio" type="radio" name="dimension" />Multiple Dimensions
                <div id="multiple-dimensions" class="row m-0 mb-3" style="display:none;">
                    <input class="col-6 width border-0 shadow" type="number" placeholder="dw: " />
                    <input class="col-6 height  border-0 shadow" type="number" placeholder="dh: " />
                </div>
            </div>
        </div>

        <div class="p-1">
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
    </form>

    <div id="id-thumbnail" title="Create Thumbnail Dialog" class="shadow text-secondary border border-secondary">
        <div class="my-1 p-1">
            <input class="w-100 width" placeholder="W: " />
        </div>

        <div class="p-1">
            <input class="w-100 height" placeholder="H: " />
        </div>
        <div class="text-right my-1 p-1">
            <button type="submit" class="btn btn-sm btn-success">Resize</button>
            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
        </div>
    </div>
    <div id="id-convert"></div>
</div>

<div id="previewer" class="border border-secondary my-2 w-100 overflow-auto position-relative" style="height: 400px;">
    <img src="" />
</div>

<div id="result">
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
            <button class="btn btn-sm btn-success">Download</button>
        </div>
    </div>

    <div id="thumbnails" class="shadow my-2 mx-auto px-auto container">

    </div>
</div>
