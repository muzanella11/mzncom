<div class="enem time-wrapper enem-time">Timeee</div>
<form class="form-signin">
    <h2 class="form-signin-heading">Enem Apps User</h2>
    <div class="login-wrap">

        <input type="text" name="username" class="enem home input-signin username form-control" placeholder="User ID" autofocus>
        <span class="enem username-error home block-error"></span>

        <input type="password" name="password" class="enem home input-signin password form-control" placeholder="Password">
        <span class="enem password-error home block-error"></span>

        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
            <span class="pull-right">
              <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

            </span>
        </label>
        <button class="btn btn-lg btn-login btn-block enem-waves" type="submit">Sign in</button>

    </div>

</form>
<?php
    $date = getdate();
    $time = time();
?>
<?php //var_dump($date); exit();?>

<?php

    echo site_url().'<br>';
    echo $time.'<br>';
    echo date('jS F, Y', strtotime('now')).'<br>';
    $setting_expired = array(
        'timeby' => 'hours',
        'value' => 1, // di set 1 jam expired nya
    );
    echo $this->enem_templates->create_expired_time($time, $setting_expired);
?>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
            </div>
            <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-success" type="button">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->