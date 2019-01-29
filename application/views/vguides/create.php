<div class="container mx-auto border shadow bg-light text-dark my-5 py-3">
    <h2 class="text-center border-bottom pb-2">Video Upload Form</h2>
    <div class="row m-3">
        <div id="vpreviewer" class="col-md-7 border">
            <video  controls height='300'></video>
        </div>
        <div class="form col-md-5">
            <?php echo form_open_multipart('vguides/upload'); ?>
            <div id="title-group" class="form-group px-5 clearfix">
                <label for="title">Title</label>
                <span class="error float-right"></span>
                <input id="title" name="title" type="text" class="w-100" required>
            </div>
            <div id="description-group" class="form-group px-5 clearfix">
                <label for="description">Description</label>
                <span class="error float-right"></span>
                <input id="description" name="description" type="text" class="w-100" required>
            </div>
            <div id="video-group" class="form-group px-5 clearfix">
                <label for="video">Video</label>
                <span class="error float-right"></span>
                <input id="video" name="video" type="file" class="w-100" required>
            </div>
            <div class="form-group px-5">
                <button id="save" type="submit" class="btn btn-sm btn-success">Upload Video to Server</button>
                <input id="cancel" name="cancel" type="reset" class="btn btn-sm btn-danger" value="Cancel"/>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/videoUploadForm.js"></script>