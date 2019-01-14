<form id="form-resize-one" class="">
    <label for="single-dimension">Dimensions</label>
    <div id="single-dimension" class="row m-0 mb-2">
        <input name="width" class="width col-6 width border-0 shadow  bg-transparent  text-light" type="number" placeholder="W: " />
        <input name="height" class="col-6 height  border-0 shadow  bg-transparent text-light" type="number" placeholder="H: " />
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
        <input id="do-resize-one" type="button" class="btn btn-sm btn-success w-100" value="Resize" />
    </div>
</form>
