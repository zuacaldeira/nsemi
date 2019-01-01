<h2 class="my-5">Nsemi Image Processing Tool</h2>

<div class="clearfix my-1">
    <input id="upload" type="file" name="original" class="float-left" required />
    <div id="iactions" class="float-right m-0">
        <button id="ia-resize"
            class="btn btn-sm btn-outline-secondary" 
            title="Resize Image" 
            style="border-radius: 50%; width: 32px; height: 32px;" 
            disabled>
            R
        </button>
        <button id="ia-thumbnail"
            class="btn btn-sm btn-outline-secondary"
            title="CreateThumbnail" 
            style="border-radius: 50%; width: 32px; height: 32px;" 
            disabled>
            T
        </button>
        <button id="ia-convert"
            class="btn btn-sm btn-outline-secondary" 
            title="Convert Image" 
            style="border-radius: 50%; width: 32px; height: 32px;" 
            disabled>
            C
        </button>
    </div>
</div>
<div id="dialogs" class="d-none text-success position-absolute">
    <form id="id-resize" title="Resize Image Dialog" class="shadow text-secondary border border-secondary">
        <div class="my-1 p-1">
            <input class="w-100 width" placeholder="W: "/>
        </div>
        
        <div class="p-1">
            <input class="w-100 height" placeholder="H: "/>
        </div>
    </form>
    
    <div id="id-thumbnail"  title="Create Thumbnail Dialog" class="shadow text-secondary border border-secondary">
        <div class="my-1 p-1">
            <input class="w-100 width" placeholder="W: "/>            
        </div>
        
        <div class="p-1">
            <input class="w-100 height" placeholder="H: "/>            
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

<div id="thumbnails" class="border border-secondary my-2" style="min-height: 64px;">

</div>
<div class="">
    <button class="btn btn-sm btn-secondary">Download</button>
</div>
