<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--https://developers.facebook.com/quickstarts/1598778137051809/?platform=web-->
       <div
            class="fb-like"
            data-share="true"
            data-width="450"
            data-show-faces="true">
        </div>
         <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1598778137051809',
                    xfbml: true,
                    version: 'v2.4'
                });
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </body>
</html>
