<form id="form-resize-many" class="container m-0 p-1">
    <div class="my-1">
        <label for="step-dimension" class="w-100">Dimensions</label>
        <div id="step-dimensions" class="row m-0 p-0" title="Min Dimensions">
            <input name="step-width" class="col-6 width border-0 shadow" type="number" placeholder="w: " value="256"/>
            <input name="step-height" class="col-6 height  border-0 shadow" type="number" placeholder="h: " value="256"/>
        </div>
    </div>
    <div class="my-1">
        <label for="select-filter"class="w-100">Filter</label>
        <select id="select-filter" class="w-100 height">
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
    <div class="my-1">
        <input id="do-resize-many" type="button" class="btn btn-sm btn-primary w-100" value="Resize" />
    </div>
</form>
