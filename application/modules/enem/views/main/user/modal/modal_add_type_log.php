<div class="enem modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Add New Type Log</h4>
</div>
<div class="enem modal-body">
    <form class="enem form-add-user">
        <div class="col-lg-12 enem no-padding">
            <label>
                Log Name
            </label>
            <input class="enem form-control input name" type="text" name="name" placeholder="Insert name" />
            <span class="enem block-error name"></span>
        </div>
        <div class="col-lg-12 enem no-padding">
            <label>
                Status Log
            </label>
            <input class="enem form-control input log" type="text" name="log" placeholder="Insert log" />
            <span class="enem block-error log"></span>
        </div>
        <br>
        <div class="col-lg-12 enem no-padding wrapper-add-user">
            <button class="enem btn btn-blue btn-add-user enem-waves" type="submit">
                Add Type Log
            </button>
        </div>

        <div class="clearfix"></div>
    </form>
</div>
<script type="text/javascript">
    $('.enem.btn-add-user').on('click', function(){
        // alert('vroh');
            $('.goyang').removeClass('goyang');
            $.ajax({
                    url         : '<?php echo site_url(); ?>enem/ajax/add_enem_type_log',
                    type        : 'post',
                    dataType    : "JSON",
                    data        : $('.enem.form-add-user').serialize(),
                    success     : function(data){
                    if(data.t == 0){

                        $('.block-error').html('');
                        // $('.goyang').removeClass('goyang');

                        $('.block-error.' + data.id).html(data.message);
                        $('.input.' + data.id).addClass('goyang');

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