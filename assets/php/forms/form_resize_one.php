<form id="form-resize-one" class="container m-0 p-1">
    <div class="my-1">
        <label for="single-dimension" class="w-100">Dimensions</label>
        <div id="single-dimension" class="row m-0 p-0">
            <input name="width" class="width col-6 width border-0 shadow" type="number" placeholder="W: " value="400"/>
            <input name="height" class="col-6 height  border-0 shadow" type="number" placeholder="H: " value="300"/>
        </div>
    </div>
    <div class="my-1">
        <label for="select-filter" class="w-100">Filter</label>
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
    <div class="my-1">
        <input id="do-resize-one" type="button" class="btn btn-sm btn-primary w-100" value="Resize"/>
    </div>
</form>
