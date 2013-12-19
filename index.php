<?php
session_start();
session_destroy();
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="lib/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" href="themes/mytheme.css" />
        <script src="lib/jquery-1.9.1.min.js" ></script>
        <script src="lib/jquery.mobile-1.3.2.min.js" ></script>
        <script>

            $(document).on('pageinit', '#page-index', function() {
                //alert('ssss');

                function onSuccess(data, status) {
                    //alert(data);   
                    data = $.trim(data);

                    if (data == 'ok') {
                        // login ผ่าน

                        //$.mobile.changePage('#page-dialog');
                        $.mobile.changePage('main.php');
                        //$.mobile.changePage('main.php', {transition: "slide"});



                    } else {
                        // login ไม่ผ่าน
                        $("#res_login").html("ไม่มีสิทธิเข้าใช้ระบบ");

                    }

                }

                function onError(data, status) {

                }

                // event click
                $("#btnOk").on('click', function() {
                    //alert('Sing in ถูก คลิก');

                    $.ajax({
                        type: "POST",
                        url: "ajx_qry_login.php",
                        cache: false,
                        data: {
                            user: $('#txtUser').val(),
                            pass: $('#txtPass').val()
                        },
                        success: onSuccess,
                        error: onError
                    });

                    return false;
                    // จบ event คลิก
                });


            });

        </script>

    </head> 
    <body> 
        <div data-role="page" id="page-index">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="home">Home</a>
                <h1>iTracker Location Monitor</h1>
                <a href="#page-about" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">	

                <form id="frm_login" name="frm_login">
                    <div data-role="fieldcontain">
                        <label for="txtUser">
                            UserName:
                        </label>
                        <input name="txtUser" id="txtUser" placeholder="" value="" type="text" data-clear-btn="true">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtPass">
                            PassWord:
                        </label>
                        <input name="txtPass" id="txtPass" placeholder="" value="" type="text">
                    </div>
                    <div align="center">
                        <input id="btnOk" type="button" data-inline="true" data-theme="b" data-icon="check"
                               data-iconpos="left" value="Sign In">
                        <input type="reset" data-inline="true" data-theme="e" data-icon="delete"
                               data-iconpos="left" value="Cancel">

                    </div>
                </form>
                <div id="res_login" align="center"></div>


            </div>
            <div data-role="footer" data-position="fixed" data-theme="f" >
                <h4>Copy Right 2013 - 2015</h4>
            </div>
        </div>

        <div data-role="dialog" id="page-about">
            <div data-role="header" data-theme="f">
                <h1>เกี่ยวกับ</h1>
            </div>
            <div data-role="content">
                กรุณาติดต่อขอรับ User , Password จากผู้บริหารระบบ<p>
                    โทร 081-xxxxxx
            </div>
        </div>



    </body>
</html