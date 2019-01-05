<h2 class="my-5 w-50 mx-auto">Registration From</h2>

<?php echo form_open('register'); ?>      
       
    <div class="input-group my-1 w-100 p-3">
        <label for="firstname" class="w-100">First Name</label>
        <input id="firstname" type="text" name="firstname" class="w-100" value="<?php echo set_value('firstname'); ?>"/>
        <?php echo form_error('firstname'); ?>         
    </div>
    
    <div class="input-group my-1 w-100 p-3">
        <label for="lastname" class="w-100">Last Name</label>
        <input id="lastname" type="text" name="lastname"  class="w-100"  value="<?php echo set_value('lastname'); ?>"/>
        <?php echo form_error('lastname'); ?>         
    </div>

    <div class="input-group my-1 w-100 p-3">
        <label for="username" class="w-100">Username</label>
        <input id="username" type="text" name="username" class="w-100"  value="<?php echo set_value('username'); ?>"/>
        <?php echo form_error('username'); ?>         
    </div>

   <div class="input-group my-1 w-100 p-3">
        <label for="email" class="w-100">Email</label>
        <input id="email" type="email" name="email" class="w-100"  value="<?php echo set_value('email'); ?>"/>
        <?php echo form_error('email'); ?>         
    </div>

    <div class="input-group my-1 w-100 p-3">
        <label for="password" class="w-100">Password</label>
        <input id="password" type="password" name="password" class="w-100"  value="<?php echo set_value('password'); ?>"/>
        <?php echo form_error('password'); ?>         
    </div>

    <div class="input-group  my-1 w-100 p-3">
        <label for="password-confirm" class="w-100">Confirm Password</label>
        <input id="password-confirm" type="password" name="password-confirm" size="50" class="w-100"  value="<?php echo set_value('password-confirm'); ?>"/>
        <?php echo form_error('password-confirm'); ?>         
    </div>

   <div class="input-group my-1 w-100 p-3">
       <button id="btn-cancel" type="reset" class="btn btn-sm btn-danger m-1">Reset</button>
       <button id="btn-register" type="submit" class="btn btn-sm btn-success m-1">Register</button>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('form').addClass('shadow w-50 mx-auto');
    });

</script>
