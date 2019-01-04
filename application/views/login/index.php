<h2 class="my-5 w-50 mx-auto">
    <?php echo $title; ?>
</h2>

<?php echo form_open_multipart('register'); ?>

<div class="input-group my-1 w-100 p-3">
    <label for="email" class="w-100">Email</label>
    <input id="email" type="email" name="email" class="w-100" />
</div>

<div class="input-group my-1 w-100 p-3">
    <label for="password" class="w-100">Password</label>
    <input id="password" type="password" name="password" class="w-100" />
</div>

<div class="input-group my-1 w-100 p-3">
    <button id="btn-cancel" type="reset" class="btn btn-sm btn-danger m-1">Reset</button>
    <button id="btn-login" type="submit" class="btn btn-sm btn-success m-1">Login</button>
</div>

</form>

<script>
    $(document).ready(function() {
        $('form').addClass('shadow w-50 mx-auto');
    });

</script>
