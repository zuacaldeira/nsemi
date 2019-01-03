<h2 class="my-5">Nsemi Image Processing Tool</h2>


<?php echo $error;?> 
<?php echo form_open_multipart('gallery/create'); ?>

<div class="clearfix my-1">
    <div class="clearfix">
        <input id="data" type="file" name="data" class="float-right"/>
    </div>
    <button type="submit" id="btn-upload" value="Upload" class="btn btn-sm btn-primary float-right" title="Upload Image" disabled></button>
</div>

<div id="previewer" class="border border-secondary my-2 w-100 overflow-auto position-relative" style="width: 100%;">
    <img src="" />
</div>


</form>
