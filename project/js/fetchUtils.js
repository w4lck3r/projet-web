"use strict";// indicates that this code should be run in strict mode
//in strict mode for example you can't use undeclared variables 
//since it's declared at the beginning of the script it has a global scope (all code in this script is in strict mode)
window.onload=function(){
    if(document.querySelector('.ajax')) {
        document.querySelector('.ajax').addEventListener('submit', function(e) {
            
          e.preventDefault();
          var formData = new FormData(document.querySelector('form')),
              request = new XMLHttpRequest(),
              actionURL = this.getAttribute("action");
            request.open('POST', actionURL, true);
            request.onreadystatechange = function() {
                if (request.readyState == XMLHttpRequest.DONE) {
                    console.log(request.response);
                }
            }
            request.send(formData);
        });
    
    }
    
    if(document.querySelector('.fav_list')) {

        var login = this.getAttribute("data-login"),
            request = new XMLHttpRequest();
        request.open('GET', '/services/getFavories.php', true);
        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE) {
                document.querySelector('.fav_list').innerHTML = request.response;
            }
        }
        request.send({login: login});
    
    }
}

    
    function AddFav(insee){
        var request = new XMLHttpRequest();
        request.open('GET', '/services/favorie.php', true);
        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE) {
                console.log(request.response);
            }
        }
        request.send({insee: insee});
    }

/*
 *   get query string from FormData object
 *   fd : FormData instance
 *   returns : query string with fd parameters (without initial '?')
 */
function formDataToQueryString (fd){
  return Array.from(fd).map(function(p){return encodeURIComponent(p[0])+'='+encodeURIComponent(p[1]);}).join('&');
}

{
  let makeFetchFunction = function (type){
    let processResponse = function(response){
      if (response.ok)
        return response[type]();
      else
        throw  Error(response.statusText);
    };
    return function(...args){ return fetch(...args).then(processResponse); };
  };
  /*
   *   Fetch functions :
   *      same arguments as fetch()
   *      each function returns a Promise resolving as received data
   *      each function throws an Error if not response.ok
   *   fetchText : returns Promise resolving as received data, as string
   *   fetchObject : returns Promise resolving as received data, as object (from JSON data)
   *   fetchFromJson : fetchFromObject alias
   *   fetchBlob : returns Promise resolving as received data, as Blob
   *     ...
   */
  var fetchObject = makeFetchFunction('json');
  var fetchFromJson = fetchObject;
  var fetchBlob = makeFetchFunction('blob');
  var fetchText = makeFetchFunction('text');
  var fetchArrayBuffer = makeFetchFunction('arrayBuffer');
  var fetchFormData = makeFetchFunction('formData');
}
