var prefix = 'api/1.0/';
var domain = 'http://gwa.local/';
function loadElements (url,params) {
   
    return axios.get(domain+prefix+url)
          
}
function loadOneElement (url,params) {
   
    return axios.get(domain+prefix+url)
          
}

function saveElement (url,params) {
   
    return axios.post(domain+prefix+url, params)
          
}
function updateElement (url,params) {
   
    return axios.put(domain+prefix+url, params)
          
}
function trashElement (url,params) {
   
    return axios.delete(domain+prefix+url, params)
          
}
function changueElement (url,params) {
   
    return axios.put(domain+prefix+url, params)
          
}