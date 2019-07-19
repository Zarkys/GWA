@include('website_public.web_layouts.header')
@include('website_public.web_layouts.navbar')

    <!-- Masthead -->


    <!-- Icons Grid -->
<div id="app">
    <div class="feature01">
        <div class="row">
            <div class="col-lg-12">
                <h3>@{{texts.title17}}</h3>
            </div>

        </div>
    </div>

    <div class="feature03">
        <div class="row">
            <div class="col-lg-10">
            <div class="row">
                <div class="card catalog-card" style="width: 18rem;" v-for="product in products">
                       
                                <img  class="card-img-top" v-bind:src="'/website_assets/img/'+product.imagen" width=200 alt="Card image cap">
                          

                   
                    <div class="card-body">
                    <h5 class="card-title">@{{product.name}}</h5>
                       
                        <p v-if="product.color != null" class="card-text"><strong>Color:</strong>@{{product.color}}</p>
                       
                        <br>
                        <a :href="'/catalogo/' + product.id" class="btn btn-primary">@{{texts.title18}}</a>
                    </div>
                </div>
              
               
    </div>




            </div>
            <div class="col-lg-2">

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                products: {},
                texts:{}
            }
        },
        mounted() {
            loadElements('text/filterby/id_section/4', '').then(
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
            loadElements('product/attributes/active', '').then(
                    response => {
                        if (response.data.code !== 500) {

                            console.log(response.data.data)
                            this.products = response.data.data;
                            console.log(this.products);

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
        max-height: 100px;
        margin-top: -20px;
        text-shadow: 2px 1px 1px #000;
        text-align: center;

    }

    .feature03 {


        padding: 4rem;



    }
    .catalog-card {
        padding:10px;
        margin:10px;
    }
</style>

</html>