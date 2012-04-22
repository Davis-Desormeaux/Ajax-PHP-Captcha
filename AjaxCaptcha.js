/*
 *                   GNU GENERAL PUBLIC LICENSE
 *                     Version 3, 29 June 2007
 *
 * Copyright (C) 2012 Davis Desormeaux  
 * More: https://github.com/Davis-Desormeaux
 *
 */

function AjaxCaptcha() {
  
    var validCaptcha = { value: 0 };
    this.dooSelect   = dooSelect; // Public
    
    // Public
    this.refreshCapcha = function() {
        dooSelect('#incorrect').innerHTML = "";
        dooSelect('#captcha').src = 'images/captcha.php?cx=' + Math.random();
        validCaptcha.value = 0;
    }
     
    // Public
    this.validateCaptcha = function(textboxId) {
        var usr_captcha = this.dooSelect('#'+ textboxId).value;         
        if (usr_captcha.length < 2) {
            return; // No captcha generated under 2 chars...       
        }     
        dooAjax('captchaRestCheck.php?usrcap=' + usr_captcha, function(data){           
            if(data == "valid") {
             validCaptcha.value = 1;
               dooSelect('#incorrect').innerHTML    = " <b>Valid</b>";
               dooSelect('#incorrect').style.color  = "Green";
            } else {
               validCaptcha.value = 0;
               if (dooSelect('#incorrect').innerHTML == " <b>Valid</b>") {
                   dooSelect('#incorrect').innerHTML  = ""; 
               }
               dooSelect('#incorrect').style.color  = "red";                
            }
        });
    }
    
    // Public
    this.doFormSubmit = function() {
        if (!validCaptcha.value) {            
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
  
    // Private
    function dooAjax (url,callback,postQuery) {
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
    
    // Private
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
        
    function dooSelect(element) {
        var eltype   = element.substring(0, 1);
        var _element = element.substring(1);
    
        return eltype != '.'
                ? eltype != '#'
                    ? document.getElementsByName(element)
                    : document.getElementById(_element)
                : document.getElementsByClassName(_element);
      }  
}

var fire = function(f) {
  (/load/.test(document.readyState)) ? setTimeout('fire(' + f + ')', 10) : f();
};
