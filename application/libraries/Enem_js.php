<?php

/**
 * @author f1108k
 * @copyright 2015
 */



?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enem_js {

    public function js_home_user() {
        $js = '
            //For count animation
            var dataCountUser = {
                \'elSelector\': \'.enem-count.users\',
                \'totalCount\': 123,
            };

            var dataCountMessages = {
                \'elSelector\': \'.enem-count.messages\',
                \'totalCount\': 456,
            };

            var dataCountNotification = {
                \'elSelector\': \'.enem-count.notification\',
                \'totalCount\': 789,
            };

            var dataCountUser2 = {
                \'elSelector\': \'.enem-count.users2\',
                \'totalCount\': 99999,
            };

            var siteUrl = enem.powerGetUrl();

            function carouselHome() {
                $("#owl-demo").owlCarousel({
                    navigation : true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem : true,
                    autoPlay:true

                });
            }

            function dynamicTable() {
                $(\'#example\').dataTable( {
                    "aaSorting": [[ 4, "desc" ]]
                } );
            }

            function init() {
                enem.powerCount(dataCountUser);
                enem.powerCount(dataCountMessages);
                enem.powerCount(dataCountNotification);
                enem.powerCount(dataCountUser2);
                carouselHome();
                dynamicTable();
            }

            // alert("js jalan");
            $(document).ready(function() {
                init();
            });

            //  //custom select box

             // $(function(){
             //     $(\'select.styled\').customSelect();
             // });
        ';

        return $js;
    }

    public function js_signin_user() {
        $js = '
            // alert(enem.powerGetUrl() + \'enem/user/dashboard\');
            var enemUrl = enem.powerGetUrl();
            var dataTime = {
                "timeEl" : ".enem-time",
            };
            enem.powerTime(dataTime);

            //alert("hello");
            $(".btn-login").click(function(){
            //alert("vroh");
                $(".input-signin").removeClass("goyang");
                $.ajax({
                        url         : enemUrl + \'enem/ajax/ucsignin\',
                        type        : \'post\',
                        dataType    : "JSON",
                        data        : $(".form-signin").serialize(),
                        success     : function(data){
                        if(data.t == 0){
                            if(data.id == \'username\'){
                                $(\'.password-error\').html(\'\');
                                $(".username").addClass("goyang");
                                $(\'.username\').focus();
                                $(\'.username-error\').html(data.message);
                            }
                            if(data.id == \'password\'){
                                $(\'.username-error\').html(\'\');
                                $(".password").addClass("goyang");
                                $(\'.password\').focus();
                                $(\'.password-error\').html(data.message);
                            }
                        }
                        else if(data.t == 1){
                            // alert(\'berhasil\');
                            window.location= enemUrl + \'enem/user/dashboard\';
                            // $(\'.enem_box_login\').animate({
                            //     "top": "-=850px"
                            // },1234);
                            // setTimeout(function(){window.location=\'lllllll\';},2500);
                        }


                    }
                });
                return false;
            });
        ';

        return $js;
    }

    public function js_dashboard() {
        $js = '
            // alert("js jalan");

            $(document).ready(function() {
                $("#owl-demo").owlCarousel({
                    navigation : true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem : true,
                    autoPlay:true

                });
            });

            //  //custom select box

             $(function(){
                 $(\'select.styled\').customSelect();
             });

            $("[data-enem-pagination=\'pagination\'] a").on("click", function(){
                alert("asdasd");
            });
        ';

        return $js;
    }

    public function js_signin() {
        $js = '
            // alert("js jalan");
            var dataTime = {
                "timeEl" : ".enem-time",
            }
            enem.powerTime(dataTime);
        ';

        return $js;
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */