var prefix = '/api/1.0/';
var domain = window.location.hostname;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host;
function loadElements (url,params) {
   
    return axios.get(baseUrl+prefix+url)
          
}
function loadOneElement (url,params) {
   
    return axios.get(baseUrl+prefix+url)
          
}

function saveElement (url,params) {
   
    return axios.post(baseUrl+prefix+url, params)
          
}
function updateElement (url,params) {
   
    return axios.put(baseUrl+prefix+url, params)
          
}
function trashElement (url,params) {
   
    return axios.delete(baseUrl+prefix+url, params)
          
}
function changueElement (url,params) {
   
    return axios.put(baseUrl+prefix+url, params)
          
}