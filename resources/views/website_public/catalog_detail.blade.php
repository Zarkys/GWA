@include('website_public.web_layouts.header')
@include('website_public.web_layouts.navbar')
<!-- Masthead -->


<!-- Icons Grid -->
<div id="app">
<div class="feature01">
    <div class="row">
        <div class="col-lg-12">
            <h3>@{{product.name}}</h3>
        </div>

    </div>
</div>

<div class="feature03">
    <div class="row">


        <div class="col-lg-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detalles</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-profile" aria-selected="false">Galería</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-specs" role="tab" aria-controls="nav-profile" aria-selected="false">Especificaciones</a>
               
                   </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <br>
            <div class="row">
                <div class="col-md-8">
                <p>@{{product.descripcion}}</p>
                </div>
                <div class="col-md-4">
                    <img  class="card-img-top" v-bind:src="'/website_assets/img/'+product.imagen" width=200 alt="Card image cap">
                  </div>
            </div>
            </div>
            <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-profile-tab">
            
                    <div class="container">
                            <div class="row">
                                <div class="row" v-if="product.id === 1">
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb" v-for="gallery in product_gallery_green">
                                        <a class="thumbnail" href="#" v-on:click="showDetail(gallery)" data-image-id="" data-toggle="modal" data-title=""
                                        v-bind:data-image="'/website_assets/img/catalog/'+gallery+'.jpeg'"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 v-bind:src="'/website_assets/img/catalog/'+gallery+'.jpeg'"
                                                 alt="Another alt text">
                                        </a>
                                      
                                    </div>                                   
                                </div>

                                <div class="row" v-if="product.id === 2">
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb" v-for="gallery in product_gallery_gray">
                                        <a class="thumbnail" href="#" v-on:click="showDetail(gallery)" data-image-id="" data-toggle="modal" data-title=""
                                        v-bind:data-image="'/website_assets/img/catalog/'+gallery+'.jpeg'"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 v-bind:src="'/website_assets/img/catalog/'+gallery+'.jpeg'"
                                                 alt="Another alt text">
                                        </a>
                                      
                                    </div>                                   
                                </div>
                                <div class="row" v-if="product.id === 4">
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb" v-for="gallery in product_gallery_fwdfj40gris">
                                        <a class="thumbnail" href="#" v-on:click="showDetail(gallery)" data-image-id="" data-toggle="modal" data-title=""
                                        v-bind:data-image="'/website_assets/img/catalog/'+gallery+'.jpg'"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 v-bind:src="'/website_assets/img/catalog/'+gallery+'.jpg'"
                                                 alt="Another alt text">
                                        </a>
                                      
                                    </div>                                   
                                </div>


                                <div class="modal fade" id="image-gallery" tabindex="-1" @close="showModal = false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img id="image-gallery-image" class="img-responsive col-md-12" v-bind:src="'/website_assets/img/catalog/'+actualimage+'.jpeg'">
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                        
                        
                               
                            </div>
                        </div>
            
            </div>
            <div class="tab-pane fade" id="nav-specs" role="tabpanel" aria-labelledby="nav-profile-tab">
            <br>
           
               <div class="row borderround" >
                 
                   <div v-if="product.color != null" class="col-sm-3">
                   <p >Color</p>
                   <h5>@{{product.color}}</h5>
                   </div>
                   <div v-if="product.marca != null" class="col-sm-3">
                      <p >Marca</p>
                      <h5>@{{product.marca}}</h5>
                      </div>
                      <div v-if="product.motor != null" class="col-sm-3">
                          <p >Motor</p>
                          <h5>@{{product.motor}}</h5>
                          </div>
                          <div v-if="product.caja != null" class="col-sm-3">
                              <p >Caja</p>
                              <h5>@{{product.caja}}</h5>
                              </div>
                              <div v-if="product.transmision != null" class="col-sm-3">
                                  <p >Trasmision</p>
                                  <h5>@{{product.transmision}}</h5>
                                  </div>
                   
                       
               
               </div>
              
              

              
            </div>
              </div>

           
            <br>
           



        </div>
        <div class="col-lg-2">
            <!-- <h3>Conoce a RMT</h3> -->
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
                showModal: false,
                actualimage:'',
                product: {
                  color:'',
                  marca:'',
                  imagen:'',
                  motor:'',
                  caja:'',
                  
                },
                product_gallery_green:[
                  'verde01',
                  'verde02',
                  'verde03',
                  'verde04',
                  'verde05',
                  'verde06',
                  'verde07',
                  'verde08',
                  'verde09',
                  'verde10',
                  'verde11',
                  'verde12',
                  'verde13',
                  'verde14',
                  'verde15',
                  'verde16',
                  'verde17',
                  'verde18',
                  'verde19',
              ],
              product_gallery_gray:[
                  'gris01',
                  'gris02',
                  'gris03',
                  'gris04',
                  'gris05',
                  'gris06',
                  'gris07',
                  'gris08',
                  'gris09',
                  'gris10',
                  'gris11',
                  'gris12',
                  'gris13',
                  'gris14',
                  'gris15',
                  'gris16',
                  'gris17',
                
              ],
              product_gallery_fwdfj40gris:[
                  'fwdfj40gris1',
                  'fwdfj40gris2',
                  'fwdfj40gris3',
                  'fwdfj40gris4',
                  'fwdfj40gris5',
                  'fwdfj40gris6',
                  'fwdfj40gris7',
                  'fwdfj40gris8',
                  'fwdfj40gris9',
                  'fwdfj40gris10',
                  'fwdfj40gris11',
                  'fwdfj40gris12',
                  'fwdfj40gris13',
                
              ]
            }
        },
        mounted() {
          var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
          
            loadElements('product/attributes/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {

                            
                            this.product = response.data.data;

                         

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })
        },  
        methods:{
          showDetail(gallery)
            {
              this.showModal = true;
              this.actualimage = gallery;
            },
        }   
       
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
    .borderround{
        border-radius: 12px 12px 12px 12px !important;
-moz-border-radius: 12px 12px 12px 12px !important;
-webkit-border-radius: 12px 12px 12px 12px !important;
border: 1px solid #d6d6d6 !important;
padding: 10px;
margin:2px;
    }

    .btn:focus, .btn:active, button:focus, button:active {
  outline: none !important;
  box-shadow: none !important;
}

#image-gallery .modal-footer{
  display: block;
}

.thumb{
  margin-top: 15px;
  margin-bottom: 15px;
}
</style>
<script>
    let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>
</html>