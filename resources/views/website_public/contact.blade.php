@include('website_public.web_layouts.header')
@include('website_public.web_layouts.navbar')
  <!-- Masthead -->
 
  <div id="app">
  <!-- Icons Grid -->

    <div class="feature01">
      <div class="row">       
        <div class="col-lg-12">
            <h3>@{{texts.title19}}</h3>
        </div>

      </div>
    </div>

    <div class="feature03">
      <div class="row">       
        <div class="col-lg-12">
            <h3>@{{texts.title20}}</h3>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                            <form style="padding:20px">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">@{{texts.title21}}</label>
                                      <input type="text" v-model="name_client" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                     
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">@{{texts.title22}}</label>
                                      <input type="text" v-model="email_client" class="form-control" id="exampleInputPassword1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleInputPassword1">@{{texts.title23}}</label>
                                            <input type="text" v-model="phone_client" class="form-control" id="exampleInputPassword1" placeholder="">
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputPassword1">@{{texts.title24}}</label>
                                                <textarea type="text" v-model="message_client" class="form-control" id="exampleInputPassword1" placeholder=""></textarea>
                                              </div>
                                 
                                    <button type="button" v-on:click="saveRow" class="btn btn-primary">@{{texts.title28}}</button>
                                  </form>
                    </div>
                    <div class="col-md-4 feature02">
                        <br>
                        <small>@{{texts.title25}}</small>
                            <div class="form-group row">
                            <span style="font-size: 48px; color: Dodgerblue;">
                                    <i class="fas fa-phone"></i>
                                    
                                  </span>
                                  <h5 class="mb-1" style="padding:20px">@{{texts.description25}}</h5>
                            </div>
                            <small>@{{texts.title25}}</small>
                            <div class="form-group row">
                                    <span style="font-size: 48px; color: Dodgerblue;">
                                            <i class="fas fa-clock"></i>
                                            
                                          </span>
                                         
                                          <h5 class="mb-1" style="padding:20px">@{{texts.description26}}</h5>
                                    </div>
                                    <small>@{{texts.title26}}</small>
                            <div class="form-group row">
                                    <span style="font-size: 48px; color: Dodgerblue;">
                                            <i class="fas fa-envelope"></i>
                                            
                                          </span>
                                          <h5 class="mb-1" style="padding:20px">@{{texts.description27}}</h5>
                                    </div>
                        
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Custom page Script -->
<script>


    var app = new Vue({
        el: '#app',
        data() {
            return {
                name_client: '',
                email_client: '',
                phone_client: '',
                message_client: '',
                texts:{}
              
            }
        },
        mounted() {
          loadElements('text/filterby/id_section/5', '').then(
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
            loadElements('section', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.sections = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });



        },
        methods: {
            back() {

            },
            saveRow() {
                Swal.fire({
                    title: 'Estas seguro de enviar esta información',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Enviar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            name_client: this.name_client,
                            email_client:this.email_client,
                            phone_client:this.phone_client,
                            message_client:this.message_client
                           

                        }

                        saveElement('contact', form).then(
                                response => {
                                    if (response.data.code !== 500) {
                                        // this.sections = response.data.data; 
                                        Swal.fire(
                                            'Su informacion fue enviada',
                                            'Esperamos contactarte pronto',
                                            'success'
                                        ).then((result) => {
                                           window.location.href = "/";
                                        });


                                    } else {
                                        console.log(response.data);
                                    }
                                })
                            .catch(error => {
                                console.log(error);
                            });

                    }
                })
            },
           

        },
        computed: {

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
  background: url("../website_assets/img/cj05.jpg") no-repeat center center;
  background-size: auto;
  padding: 2rem;
  
  color:#fff;
  margin-top:-20px;
  
    text-align: center;
 
}
.feature03 {
 
 
  padding: 4rem;

   
 
}
</style>

</html>
