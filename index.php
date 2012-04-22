<html>
    <title>Ajax PHP Captcha DEMO</title>
    <script language="javascript">
        <!--       
        var validCaptcha = 0;
        
        function dooSelect(element) {
            var eltype   = element.substring(0, 1);
            var _element = element.substring(1);
        
            return eltype != '.'
                ? eltype != '#'
                    ? document.getElementsByName(element)
                    : document.getElementById(_element)
                : document.getElementsByClassName(_element)
        }
        
        function dooAjax(url,callback,postQuery) {
            var http = getXMLHTTPObject();               
            if (!http || !url) {
                console.log(!http ? "Error No XMLHTTP available" : "Error: Empty URL");
                return;
            }  
            var method = (postQuery) ? "POST" : "GET";
            http.open(method,url,true);
               
            if (postQuery) {
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            }               
            http.onreadystatechange = function() {
                if ((http.readyState != 4) || (http.status != 200 && http.status != 304)) {
                    return;
                }            
                callback(http.responseText);
            }  
            http.send(postQuery);
        }
    
        function getXMLHTTPObject() {  
            var xmlHttp = false;
            var AjaxClients = [
                function () {return new XMLHttpRequest()},
                function () {return new ActiveXObject("Msxml2.XMLHTTP")},
                function () {return new ActiveXObject("Msxml3.XMLHTTP")},
                function () {return new ActiveXObject("Microsoft.XMLHTTP")}
            ];
        
            
            for (var i=0; i<AjaxClients.length; i++) {
                try {
                    xmlHttp = AjaxClients[i]();
                } catch (e) {
                    continue;
                }
                break;
            }
            return xmlHttp;
        }          

        function refreshCapcha() {
            dooSelect('#incorrect').innerHTML = "";
            dooSelect('#captcha').src = 'images/captcha.php?cx=' + Math.random();
            validCaptcha = 0;
        }
       
        function validateCaptcha() {
            var usr_captcha = dooSelect('#captchatxt').value;         
            if (usr_captcha.length < 2) return; // No captcha generated under 2 chars...
            dooAjax('captchaRestCheck.php?usrcap=' + usr_captcha, function(data){           
                if(data == "valid") {
                   validCaptcha = 1;
                   dooSelect('#incorrect').innerHTML = " <b>Valid</b>";
                   dooSelect('#incorrect').style.color  = "Green";
                } else {
                   validCaptcha = 0;
                   dooSelect('#incorrect').innerHTML = "";
                   dooSelect('#incorrect').style.color  = "red";                
                }
            });
        }
        
        function doFormSubmit() {
          if (!validCaptcha) {
            dooSelect('#incorrect').innerHTML  = "<b> Incorrect</b>";
            dooSelect('#captcha').src = "images/captcha.php?cx=" + Math.random();
            return false;
          } else {
            alert('Great!');
            dooSelect('#incorrect').innerHTML  = "";
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