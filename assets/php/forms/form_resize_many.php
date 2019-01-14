<form>
    <label for="single-dimension">Dimensions</label>
    <div id="multiple-dimensions">
        <div id="min-dimensions" class="row m-0 mb-3" title="Min Dimensions">
            <input name="min-width" class="col-6 width border-0 shadow bg-transparent text-light" type="number" placeholder="w: " />
            <input name="min-height" class="col-6 height  border-0 shadow bg-transparent text-light" type="number" placeholder="h: " />
        </div>
    </div>
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
        <input id="do-resize-many" type="button" class="btn btn-sm btn-success w-100" value="Resize" />
    </div>
</form>
