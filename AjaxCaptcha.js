/*
 *                   GNU GENERAL PUBLIC LICENSE
 *                     Version 3, 29 June 2007
 *
 * Copyright (C) 2012 Davis Desormeaux
 * More: https://github.com/Davis-Desormeaux
 *
 */

var ajxCaptcha = (function() {

  var parameterMap = {
    txtValid   : 'Valid',
    validColor : 'Green', 
    txtBad     : 'Incorrect',
    badColor   : 'Red'
  };
    
  var validCaptcha = { 
    value : false 
  };
              
  // Public
  refreshCapcha = function() {
    dooSelect('#captcha').src = 'images/captcha.php?cx=' + Math.random();
    dooSelect('#incorrect').innerHTML = "";
    validCaptcha.value = false;
  }
  
  // Public
  var validateCaptcha = function(textboxId) {
    var usr_captcha = dooSelect(textboxId).value;
    if(usr_captcha.length < 2 && !validCaptcha.value) {
      return; // No captcha generated under 2 characters
    }
    
    dooAjax('captchaRestCheck.php?usrcap=' + usr_captcha, function(data) {
      var outputElem = dooSelect('#incorrect');
      if(data == "valid") {
        outputElem.style.color = outputElem.validColor;
        outputElem.innerHTML = outputElem.txtValid;
        validCaptcha.value = true;
      } else {    
        outputElem.style.color = parameterMap.badColor;
        validCaptcha.value = false;        
        if ( validCaptcha.value ) {
          // Remove the word valid.
          outputElem.innerHTML = ""; 
        } 
      }
    });
  }
  
  // Public
  doFormSubmit = function() {
    if(!validCaptcha.value) {
      dooSelect('#captcha').src = "images/captcha.php?cx=" + Math.random();
      dooSelect('#incorrect').style.color = parameterMap.badColor;
      dooSelect('#incorrect').innerHTML = parameterMap.txtBad;
      return false;      
    } else {
      dooSelect('#incorrect').innerHTML = ""; 
      return true;     
    }
  }

  // Private
  function dooAjax(url, callback, postQuery) {
    var http = getXMLHTTPObject();
    
    if(!http || !url) {
      console.log(!http ? "Error No XMLHTTP available" : "Error: Empty URL");
      return;       
    }
    
    http.open((postQuery) ? "POST" : "GET", url, true);
    
    if(postQuery) {
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    }
    
    http.onreadystatechange = function() {
      if(http.readyState == 4) {
        callback(http.responseText);
      }
    }
    
    http.send(postQuery);
  }
  
  // Private
  function getXMLHTTPObject() {
    var xmlHttp = false;
    var AjaxClients = [
        function() { return new ActiveXObject("Microsoft.XMLHTTP") },
        function() { return new ActiveXObject("Msxml3.XMLHTTP") },
        function() { return new ActiveXObject("Msxml2.XMLHTTP") },
        function() { return new XMLHttpRequest() }
    ];
                       
    while (!xmlHttp && AjaxClients.length != 0) {
      try {
        xmlHttp = AjaxClients.pop()();
      } catch (e) {
        continue;
      }
    } 
    return xmlHttp;
  }
  
  // Private   
  function dooSelect(element) {
    var eltype   = element.substring(0, 1);
    var _element = element.substring(1);
  
    return eltype != '#' 
          ? eltype == '.'
              ? document.getElementsByClassName(_element) // .className     
              : document.getElementsByName(element)       // elemntName
          : document.getElementById(_element);            // #elementId   
  }
  
  return {
       validateCaptcha: validateCaptcha,
       refreshCapcha: refreshCapcha,
       doFormSubmit: doFormSubmit
  }
    
}()); 

var fire = function(f) {
  (/load/.test(document.readyState)) ? setTimeout('fire(' + f + ')', 10) : f();
};
