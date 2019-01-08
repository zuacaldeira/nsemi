<h2 class="my-5 w-50 mx-auto">Login From</h2>
<?php echo form_open('login/index'); ?>      
       
    <div class="input-group my-1 w-100 p-3">
        <label for="username" class="w-100">Username</label>
        <input id="username" type="text" name="username" class="w-100"  value="<?php echo set_value('username'); ?>"/>
        <?php echo form_error('username'); ?>         
    </div>

    <div class="input-group my-1 w-100 p-3">
        <label for="password" class="w-100">Password</label>
        <input id="password" type="password" name="password" class="w-100"  value="<?php echo set_value('password'); ?>"/>
        <?php echo form_error('password'); ?>         
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
