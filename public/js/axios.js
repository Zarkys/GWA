var prefix = 'api/1.0/'
function loadElements (url,params) {
   
    return axios.get(prefix+url)
          
}