@include('website_public.web_layouts.header')
@include('website_public.web_layouts.navbar')
  <!-- Masthead -->
 <div id="app">
  
  <!-- Icons Grid -->

    <div class="feature01">
      <div class="row">       
        <div class="col-lg-12">
        <h3>  @{{texts.title11}}</h3>
        </div>

      </div>
    </div>

    <div class="feature03">
      <div class="row">       
        <div class="col-lg-12">
            <h3> @{{texts.title12}}</h3>
            <br>
            <div class="row">
            <div class="col-md-8">
            <p style="text-align: justify">@{{texts.description16}}</p>
           
            </div>
            <div class="col-md-4">
            <img class="" width="400" src="website_assets/img/cj02.jpg" alt="">
            </div>
            </div>

          
           
        </div>
       
        
      </div>
    </div>
 </div>

  
 <!-- Footer -->
@include('website_public.web_layouts.footer')

@include('website_public.web_layouts.footscripts')

</body>
<!-- Additional Scripts -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                texts: {                    
                },                
            }
        },
        mounted() {
            loadElements('text/filterby/id_section/3', '').then(
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
    })
</script>
<style>
 .feature01 {
        background-color: #3C455C;
        color: white;
        padding-top: 30px;
        padding-bottom: 20px;
        margin-top: -10px;
        text-align: center;
    }
  .feature02 {
  position: relative;  
  background: url("../website_assets/img/cj04.jpg") no-repeat center center;
  background-size: cover;
  padding-top: 4rem;
  padding-bottom: 7rem;
  max-height:100px;
  margin-top:-20px;
  text-shadow: 2px 1px 1px #000;
    text-align: center;
 
}
.feature03 {
 
 
  padding: 4rem;

   
 
}
</style>

</html>
