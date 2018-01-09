<div class="enem modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Add New Data User</h4>
</div>
<div class="enem modal-body">
    <form class="enem form-add-user">
        <div class="col-lg-12 enem no-padding">
            <label>
                First name
            </label>
            <input class="form-control" type="text" name="firstname" placeholder="Insert first name" />
            <span class="enem block-error firstname"></span>
        </div>
        <div class="col-lg-12 enem no-padding">
            <label>
                Last name
            </label>
            <input class="form-control" type="text" name="lastname" placeholder="Insert last name" />
            <span class="enem block-error lastname"></span>
        </div>
        <div class="col-lg-12 enem no-padding">
            <label>
                Email
            </label>
            <input class="form-control" type="text" name="email" placeholder="Insert email" />
            <span class="enem block-error email"></span>
        </div>
        <div class="col-lg-12 enem no-padding">
            <label>
                Username
            </label>
            <input class="form-control" type="text" name="username" placeholder="Insert username" />
            <span class="enem block-error username"></span>
        </div>
        <div class="col-lg-12 enem no-padding">
            <label>
                Password
            </label>
            <input class="form-control" type="text" name="password" placeholder="Insert first name" />
            <span class="enem block-error password"></span>
        </div>
        <div class="col-lg-12 enem no-padding wrapper-add-user">
            <button class="enem btn btn-blue btn-add-user enem-waves" type="submit">
                Add User
            </button>
        </div>

        <div class="clearfix"></div>
    </form>
</div>
<script type="text/javascript">
    $('.enem.btn-add-user').on('click', function(){
        // alert('vroh');

            $.ajax({
                    url         : '<?php echo site_url(); ?>enem/ajax/add_enem_user',
                    type        : 'post',
                    dataType    : 'JSON',
                    data        : $('.enem.form-add-user').serialize(),
                    success     : function(data){
                    if(data.t == 0){
                        if(data.id == 'username'){
                            $('.password-error').html('');
                            $(".username").addClass("goyang");
                            $('.username-error').html(data.message);
                        }
                        if(data.id == 'password'){
                            $('.username-error').html('');
                            $(".password").addClass("goyang");
                            $('.password-error').html(data.message);
                        }
                    }
                    else if(data.t == 1){
                        // alert(\'berhasil\');
                        window.location= '<?php echo site_url(); ?>enem/user/dashboard';
                        // $(\'.enem_box_login\').animate({
                        //     "top": "-=850px"
                        // },1234);
                        // setTimeout(function(){window.location=\'lllllll\';},2500);
                    }


                }
            });
            return false;
        });
</script>