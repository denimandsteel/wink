<?php
  if (isset($_POST['email'])):
    $to = $_POST['email'];
    $subject = 'Browser Profile Submitted';
    $body = $_POST['profile'];
    if (isset($_POST['email']) && isset($_POST['profile']) && mail($to, $subject, $body)) {
      $status = 'Thanks, that should help!';
    }
    else {
      $status = 'Unfortunately that didn\'t work.';
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browser Profile</title>
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
    <style>
      form { margin: 1em 0; }
      textarea { display: none; }
      textarea.show { display: block; margin: 1em 0; width: 400px; height: 200px; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="hero-unit">
        <h1><?php print $status ?></h1>
      </div>
    </div>
  </body>
</html>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browser Profile</title>
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="modernizr.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#show-work').click(function() {
          $('textarea').toggleClass('show');
          return false;
        });
        var emailAddress = getParameterByName('email');
        if (emailAddress !== null) {
          $('.enter').hide();
          $('#email').val(emailAddress);
        }

        var profile = {
          screen: {},
          browser: {},
          modernizr: {}
        };
        profile.screen.width = window.screen.width;
        profile.screen.height = window.screen.height;

        profile.browser.userAgent = window.navigator.userAgent;
        profile.browser.width = window.innerWidth;
        profile.browser.height = window.innerHeight;
        profile.browser.availWidth = window.screen.availWidth;
        profile.browser.availHeight = window.screen.availHeight;

        profile.modernizr = Modernizr;

        var encoded = JSON.stringify(profile);
        $('#profile').val(encoded);
      });

      // http://stackoverflow.com/a/5158301
      function getParameterByName(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
      }
    </script>
    <style>
      .logo { float: left; margin-right: 30px; width: 135px; height: 135px; }
      form { margin: 1em 0; }
      textarea { display: none; }
      textarea.show { display: block; margin: 1em 0; width: 400px; height: 200px; }
      .the-rest { margin-left: 165px; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="hero-unit">
        <a href="http://denimandsteel.com"><img class="logo" src="denim.png" title="Denim &amp; Steel" /></a>
        <div class="the-rest">
          <h1>Help us, help you</h1>
          <form action="" method="post">
              <span class="help-block"><span class="enter">Enter your developer's email address. </span><a id="show-work" href="#">Show me what you're sending.</a></span>
              <input id="email" name="email" type="email" placeholder="email@example.com" />
              <button type="submit" class="btn">Submit</button>
              <textarea name="profile" id="profile"></textarea>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<?php endif; ?>
