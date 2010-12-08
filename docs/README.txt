README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or 
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "/Users/dragonbe/workspace/azure/public"
   ServerName azure.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development
    
   <Directory "/Users/dragonbe/workspace/azure/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>
    
</VirtualHost>

Facebook Example
================


Example code:
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Wingz</title>
  </head>
  <body>
    <h1>Wingz</h1>
    <p><fb:login-button autologoutlink="true"></fb:login-button></p>
    <p><fb:like></fb:like></p>

    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: 'YOUR_APP_ID', status: true, cookie: true,
                 xfbml: true});
      };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
  </body>
</html>