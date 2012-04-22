<html>
    <title>Ajax PHP Captcha DEMO</title>
    <script language="javascript">
        <!-- 
        var ajaxRequest;          
        var validCaptcha = 0;

        function ajaxGet(restUrl, callBackFunction){
            try {
                ajaxRequest = new XMLHttpRequest();
            } catch (e){
                try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        console.log("No XMLHttp Object found!");
                        return false;
                    }
                }
            }
            ajaxRequest.onreadystatechange = callBackFunction; 
            ajaxRequest.open("GET", restUrl, true);
            ajaxRequest.send(null); 
        }

        function domSelect(element) {
            var eltype   = element.substring(0, 1);
            var _element = element.substring(1);
        
            return eltype != '.'
                ? eltype != '#'
                    ? document.getElementsByName(element)
                    : document.getElementById(_element)
                : document.getElementsByClassName(_element)
        }

        function refreshCapcha() {
            domSelect('#captcha').src = 'images/captcha.php?cx=' + Math.random();
        }
       
        function validateCaptcha() {
            var usr_captcha = domSelect('#captchatxt').value;
            
            if (usr_captcha.length < 2) return; // No captcha generated under 2 chars...

            ajaxGet('captchaRestCheck.php?usrcap=' + usr_captcha, function(){
                if(ajaxRequest.readyState == 4 && ajaxRequest.responseText == "true"){
                    validCaptcha = 1;
                }
            });
        }
        
        function doFormCheck() {
          if (!validCaptcha) {
            domSelect('#incorrect').innerHTML  = " Incorrect";
            domSelect('#captcha').src = "images/captcha.php?cx=" + Math.random();
            return false;
          } else {
            alert('Great!');
            domSelect('#incorrect').innerHTML  = "";
            return true;
          }
          
        }              
    //-->
    </script>
</html>
<h1>Ajax PHP Captcha DEMO</h1>
<p>
  <form action="#" method="post" name="captcha-demo" onsubmit="return doFormCheck()">
    <div id="contact_email">
      <img src="images/captcha.php?cx=1686237619" id="captcha" class="capt">
      <br>
      <a href="#capt" onclick="refreshCapcha()" id="change-image">Refresh</a>:
      <label id="incorrect" style="color:red"></label>
      <br>
      CAPTCHA (Validation):
      <input type="text" name="usrcaptcha" id="captchatxt" onkeyup='validateCaptcha()'>
      <br>
      <button class="button validate" type="submit">Send</button>
    </div>
  </form>
</p>
</body>
</html>