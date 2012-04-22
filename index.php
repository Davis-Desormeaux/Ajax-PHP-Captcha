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
                    : document.getElementsByClassName(_element);
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
                if (http.readyState == 4) callback(http.responseText);        
            }  
            http.send(postQuery);
        }
    
        function getXMLHTTPObject() {  
            var xmlHttp = false;
            var AjaxClients = [
                function () {return new ActiveXObject("Microsoft.XMLHTTP")},
                function () {return new ActiveXObject("Msxml3.XMLHTTP")},
                function () {return new ActiveXObject("Msxml2.XMLHTTP")},
                function () {return new XMLHttpRequest()}
            ];
            
            do {
                try {
                    xmlHttp = AjaxClients.pop()();
                } catch (e) {
                    continue;
                }
            } while (!xmlHttp && AjaxClients.length != 0)            
            
            return xmlHttp;
        }          

        function refreshCapcha() {
            dooSelect('#incorrect').innerHTML = "";
            dooSelect('#captcha').src = 'images/captcha.php?cx=' + Math.random();
            validCaptcha = 0;
        }
       
        function validateCaptcha() {
            var usr_captcha = dooSelect('#captchatxt').value;         
            if (usr_captcha.length < 2) {
                return; // No captcha generated under 2 chars...       
            }     
            dooAjax('captchaRestCheck.php?usrcap=' + usr_captcha, function(data){           
                if(data == "valid") {
                   validCaptcha = 1;
                   dooSelect('#incorrect').innerHTML    = " <b>Valid</b>";
                   dooSelect('#incorrect').style.color  = "Green";
                } else {
                   validCaptcha = 0;
                   dooSelect('#incorrect').innerHTML    = "";
                   dooSelect('#incorrect').style.color  = "red";                
                }
            });
        }
        
        function doFormSubmit() {
          if (!validCaptcha) {            
            dooSelect('#incorrect').innerHTML    = "<b> Incorrect</b>";
            dooSelect('#incorrect').style.color  = "red"; 
            dooSelect('#captcha').src = "images/captcha.php?cx=" + Math.random();
            return false;
          } else {
            alert('Great!');
            dooSelect('#incorrect').innerHTML  = "";
            return true;
          }          
        }
        
        function put(args){
            document.write(args);
        }              
    //-->
    </script>
</head>
<body>
<h1>Ajax PHP Captcha DEMO</h1>
<p>
  <form action="#" method="post" name="captcha-demo" onsubmit="return doFormSubmit()">
      <script>put('<img src="images/captcha.php?cx=' + Math.random() + '" id="captcha">')</script> 
      <br>
      <a href="#capt" onclick="refreshCapcha()" id="change-image">Refresh:</a>
      <label id="incorrect" style="color:red"></label>
      <br>
      CAPTCHA (Validation):
      <input type="text" name="usrcaptcha" id="captchatxt" onkeyup='validateCaptcha()'>
      <br>
      <button class="button validate" type="submit">Send</button>
  </form>
</p>
</body>
</html>