@include('layouts.header')
<!-- Custom styles for this page -->


@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 contact-gray-800">Contactos en el Website</h1>
        </div>



        <p class="mb-4">En esta lista puedes visualizar los contactos que han realizado en el sitio web </p>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold contact-primary">Lista de Contactos</h6>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>


            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="contact in contacts">
                        <div class="row">
                            <div class="col-md-3">
                                @{{contact.name_client}}
                            </div>
                            <div class="col-md-3">
                                @{{contact.email_client}}
                            </div>
                            <div class="col-md-4">
                                @{{contact.created_at}}
                            </div>
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" v-on:click="loadDetails(contact)" data-toggle="modal" data-target="#exampleModal">
                                    Ver Detalle
                                </button>


                            </div>
                        </div>
                  
                    </li>
                    
                </ul>




            </div>
        </div>

    </div>

    <!-- /.container-fluid -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detalles del Contacto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <h5><strong>Nombre: </strong>@{{contact_detail.name_client}}</h5>
                  <h5><strong>Email: </strong>@{{contact_detail.email_client}}</h5>
                  <h5><strong>Telefono: </strong>@{{contact_detail.phone_client}}</h5>
                  <h5><strong>Mensaje: </strong>@{{contact_detail.message_client}}</h5>
                  <p><strong>Fecha de Registro: </strong>@{{contact_detail.created_at}}</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               
              </div>
          </div>
      </div>
  </div>


</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<!-- Additional Scripts -->
 <script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                contacts: {},
                contact_detail:{
                    name_client:'',
                    email_client:'',
                    phone_client:'',
                    message_client:'',
                    created_at:''
                }
            }
        },
        mounted() {
            loadElements('contact', '').then(
                    response => {
                        if (response.data.code !== 500) {


                            this.contacts = response.data.data;


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
            loadDetails(contact)
            {
                console.log(contact);
               this.contact_detail = contact;
            },
            editSubmit() {

            },

            updateRow(idelement) {
                $('#exampleModal').on('shown.bs.modal', function () {

                })
            },
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>