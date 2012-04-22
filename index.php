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
          <button type="submit" id="submit-button">Send</button>
      </form>
    </p>
    <script language="javascript">
        <!--       
        fire(function() {
            var axCaptcha = new AjaxCaptcha();
            axCaptcha.dooSelect('#captcha').src = "images/captcha.php?cx=" + Math.random();
            axCaptcha.dooSelect('#refreshimage').onclick  = axCaptcha.refreshCapcha;
            axCaptcha.dooSelect('#submit-button').onclick = axCaptcha.doFormSubmit;
            axCaptcha.dooSelect('#captch-text').onkeyup   = function() {
                axCaptcha.validateCaptcha('captch-text');
            }
        });
        //-->
    </script>
</body>
</html>