@include('website_public.web_layouts.header')
@include('website_public.web_layouts.navbar')

<!-- Masthead -->
<div id="app">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" v-if="actual_lang==='es'">
            <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT01.jpg')}}" alt="First slide">
        </div>
        <div class="carousel-item" v-if="actual_lang==='es'">
            <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT02.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item" v-if="actual_lang==='es'">
            <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT03.jpg')}}" alt="Third slide">
        </div>
        <div class="carousel-item" v-if="actual_lang==='es'">
                <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT04.jpg')}}" alt="Third slide">
            </div>

        <!-- LANG ENGLISH -->
        <div class="carousel-item active" v-if="actual_lang==='en'">
                <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT01English.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item" v-if="actual_lang==='en'">
                <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT02English.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item" v-if="actual_lang==='en'">
                <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT03English.jpg')}}" alt="Third slide">
            </div>
            <div class="carousel-item" v-if="actual_lang==='en'">
                    <img class="d-block w-100" src="{{ asset('website_assets/img/BannerRMT04English.jpg')}}" alt="Third slide">
                </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Icons Grid -->

<div class="feature01">
    <div class="row">
        <div class="col-lg-12">
           
            <h3>@{{texts.title01}}</h3>
          
        </div>
    </div>
</div>


<!-- Image Showcases -->
<section class="showcase">
    <div class="container-fluid p-0">
        <div class="row no-gutters">

            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('website_assets/img/cj01.jpg');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>@{{texts.title02}}</h2>
                <p class="lead mb-0">@{{texts.description02}}</p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('website_assets/img/cj02.jpg');"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>@{{texts.title03}}</h2>
                <p class="lead mb-0">@{{texts.description03}}</p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('website_assets/img/cj03.jpg');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>@{{texts.title04}}</h2>
                <p class="lead mb-0">@{{texts.description04}}</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials text-center bg-light">
    <div class="container">
        <h2 class="mb-5">@{{texts.title05}}</h2>
        <div class="row">
            <div class="col-lg-3">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="website_assets/img/expert01.jpg" alt="">
                    <h5>@{{texts.title06}}</h5>
                    <p class="font-weight-light mb-0">@{{texts.description06}}</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="website_assets/img/expert02.jpg" alt="">
                    <h5>@{{texts.title07}}</h5>
                    <p class="font-weight-light mb-0">@{{texts.description07}}</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="website_assets/img/expert03.jpg" alt="">
                    <h5>@{{texts.title08}}</h5>
                    <p class="font-weight-light mb-0">@{{texts.description08}}</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="website_assets/img/expert04.jpg" alt="">
                    <h5>@{{texts.title09}}</h5>
                    <p class="font-weight-light mb-0">@{{texts.description09}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="feature02 text-white text-center" style="background-color:#EDFAFD">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h2 class="mb-4">@{{texts.title10}}</h2>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form>
                    <div class="form-row">
                        <div class="col-2">

                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="feature03 text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2">
                            <span style="font-size: 7em; ">
                                <i class="fas fa-car"></i>
                            </span><br>
                            @{{texts.description11}}

                        </div>
                        <div class="col-md-2">
                            <span style="font-size: 7em;">
                                <i class="fas fa-search"></i>
                            </span><br>
                            @{{texts.description12}}
                        </div>
                        <div class="col-md-2">
                            <span style="font-size: 7em;">
                                <i class="fas fa-tools"></i>
                            </span><br>
                            @{{texts.description13}}
                        </div>
                        <div class="col-md-2">
                            <span style="font-size: 7em;">
                                <i class="fas fa-paint-brush"></i>
                            </span><br>
                            @{{texts.description14}}
                        </div>
                        <div class="col-md-2">
                            <span style="font-size: 7em;">
                                <i class="fas fa-car-side"></i>
                            </span><br>
                            @{{texts.description15}}
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
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
                actual_lang:'es',
                texts: {                    
                },                
            }
        },
        mounted() {
            loadElements('text/filterby/id_section/2', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            var element = document.getElementById('text_lang');
                            this.actual_lang = element.innerText || element.textContent;
                           
                            if(this.actual_lang === 'es')
                            {
                                this.texts = response.data.data.es;
                            }
                            if(this.actual_lang === 'en')
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
        max-height: 100px;
        margin-top: -20px;
        text-shadow: 2px 1px 1px #000;
        text-align: center;

    }

    .feature03 {


        padding-top: 4rem;
        padding-bottom: 7rem;



        text-align: center;

    }
</style>

</html>