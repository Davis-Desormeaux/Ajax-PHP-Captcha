<html>
    <title>Ajax PHP Captcha DEMO</title>
    <script language="javascript" src="AjaxCaptcha.js"></script>
</head>
<body>
    <h1>Ajax PHP Captcha DEMO</h1>
    <p>
      <form action="#" method="post" id="captcha-form">
          <img id="captcha">  
          <br>
          <a href="#" id="refreshimage">Refresh:</a>
          <label id="incorrect" style="color:red"></label>
          <br>
          CAPTCHA (Validation):
          <input type="text" id="captch-text">
          <br>
          <input type="submit">
      </form>
    </p>
    <script language="javascript">
        <!--       
        fire(function() { // Use $(document).ready() or whatever is available (like fire)...
            
            // Could use a cool selector here: jQuery('#captcha'), dojo.query('#captcha')...
            document.getElementById('captcha').src = "images/captcha.php?cx=" + Math.random();
            document.getElementById('refreshimage').onclick = ajxCaptcha.refreshCapcha;
            
            // Add a handler to prevent a form submission when the captcha is invalid.
            document.getElementById('captcha-form').onsubmit = ajxCaptcha.doFormSubmit;
            
            // Add handler to check against the captcha on a keypress. 
            // If the captcha is valid, the word 'Valid' will show up.
            document.getElementById('captch-text').onkeyup = function(e) {
                ajxCaptcha.validateCaptcha('#' + this.id);
            }
            
        });
        //-->
    </script>
</body>
</html>