  <!-- Navigation -->
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <div id="navbar">   
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="min-height: 90px;">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('website_assets/img/logo.png')}}" width="180" height="70" alt="">
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">@{{texts.menu01}} <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/conocenos">@{{texts.menu02}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/catalogo">@{{texts.menu03}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contacto">@{{texts.menu04}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="text_lang" style="visibility:hidden" href="/contacto">{{Session::get('lang','es')}}</a>
          </li>
        <li class="nav-item dropdown">
          @if(Session::get('lang','es')==='es')
            <a class="nav-link dropdown-toggle" id="dropdown09"  href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="flag-icon flag-icon-es"> </span> Español</a>
            <div class="dropdown-menu" aria-labelledby="dropdown09">
            <a class="dropdown-item" href="#" v-on:click="changueLang('en')"><span class="flag-icon flag-icon-us"> </span>  English</a>
              
            </div>
          @endif
          @if(Session::get('lang')==='en')
          <a class="nav-link dropdown-toggle"  href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="flag-icon flag-icon-us"> </span> English</a>
          <div class="dropdown-menu" aria-labelledby="dropdown09">
              <a class="dropdown-item"  href="#" v-on:click="changueLang('es')"><span class="flag-icon flag-icon-es"> </span>  Spanish</a>
            
          </div>
        @endif
        </li>
      
      </ul>
    </div>
  </nav>
    </div>
  <!-- Additional Scripts -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#navbar',
        data() {
            return {
                message: '',  
                texts:{}             
            }
        },
        mounted() { 
          loadElements('text/filterby/id_section/1', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            var element = document.getElementById('text_lang');
                            var lang_text = element.innerText || element.textContent;
                            console.log(lang_text);
                            if(lang_text === 'es')
                            {
                                this.texts = response.data.data.es;
                            }
                            if(lang_text === 'en')
                            {
                                this.texts = response.data.data.en;
                            } 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            back() {

            },
            editSubmit() {

            },
           
            changueLang(lang){
              changueLang('/changue_lang/'+lang, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                         window.location.reload();
                                            
                                        } else {
                                            console.log(response.data);
                                        }
                                    })
                                .catch(error => {
                                    console.log(error);
                                });
            },
           

        },
        computed: {

        },
    })
</script>