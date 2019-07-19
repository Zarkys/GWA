var prefix = '/goadmin/api/1.0/';
var domain = window.location.hostname;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host;

function RouteGet_BACK (url,params) {
    return axios.get(url,params)
}

function RoutePost_BACK (url,params) {
    return axios.post(url,params)
}

function RoutePost_test (url,params) {
    var config = {
        onUploadProgress: function(progressEvent) {
            var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
        }
    };
    return axios.post(url,params,config)
}

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
function inactiveElement (url,params) {
   
    return axios.delete(baseUrl+prefix+url, params)
          
}
function activeElement (url,params) {
   
    return axios.delete(baseUrl+prefix+url, params)
          
}
function changueElement (url,params) {
   
    return axios.put(baseUrl+prefix+url, params)
          
}
function changueLang (url,params) {
   
    return axios.get(baseUrl+url, params)
          
}