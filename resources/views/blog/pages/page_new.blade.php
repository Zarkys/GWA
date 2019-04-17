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
        <h1 class="h3 mb-0 text-gray-800">Agregar una Pagína</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Agregar Pagína</h6>
                </div>
                <div class="col-md-4">
                <a href="{{ url()->previous() }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Volver</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-8">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="inputName" v-model="title_type" aria-describedby="nameHelp" placeholder="Introduce el titulo aqui">
                     </div>
                     <div class="form-group">
                    <label for="exampleInputEmail1">Enlace Permanente</label>
                    <input type="text" class="form-control" id="inputName" v-model="permanent_link_type" aria-describedby="nameHelp" placeholder="Introduce el link permanente">
                     </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Contenido</label>
                  <!--  <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="content_type" aria-describedby="nameHelp" placeholder="Agregar el contenido"></textarea>-->
                         <div id="app">
    <quill-editor v-model="content_type"
                  ref="quillEditorA"
                  :options="editorOption"
                  @blur="onEditorBlur($event)"
                  @focus="onEditorFocus($event)"
                  @ready="onEditorReady($event)">
        </quill-editor>
   <!-- <div class="content ql-editor" v-html="content"></div>-->
    <br>
  <!--  <local-quill-editor v-model="content2"
                        ref="quillEditorB"
                        :options="editorOption"
                        @blur="onEditorBlur($event)"
                        @focus="onEditorFocus($event)"
                        @ready="onEditorReady($event)">
        </local-quill-editor>
    <div class="content ql-editor" v-html="content2"></div>-->
</div>

</tinymce>
                     </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Estado</label>
                            <select v-model="status">
                                <option value=1>Borrador</option>
                                <option value=2>Pendiente de revisión</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Visibilidad</label>
                            <select v-model="visibility">
                                <option value=1>Público</option>
                                <option value=2>Privado</option>
                            </select>
                        </div>
                        <div class="form-group">
                         <label>Fecha de publicación</label>
                         <flat-pickr :config="configs.dateTimePicker"
                          id="datetime-input"
                          class="form-control"
                          v-model="datepublication"
                          placeholder="Fecha de publicación">
                         </flat-pickr>
                        </div>
                        <div class="example-avatar">
    <div v-show="$refs.upload && $refs.upload.dropActive" class="drop-active">
      <label>Imagen destacada</label>
    </div>
    <div class="avatar-upload"  v-show="!edit">
     <div class="form-group">
      <div class="text-center p-2">
        <label for="avatar">
          <img :src="files.length ? files[0].url : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSL4EkjMng3t1rm5KJ0qbdER-28C1-iC3I52Q1qVK0sSlNAkVhC'"  width="200" height="150"/>
          <h4 class="pt-2"><br/>Agregue una imagen</h4>
        </label>
      </div>
      </div>
      <div class="text-center p-2">
        <file-upload
          extensions="gif,jpg,jpeg,png,webp"
          accept="image/png,image/gif,image/jpeg,image/webp"
          name="avatar"
          class="btn btn-primary"
          post-action="/upload/post"
          :drop="!edit"
          v-model="files"
          @input-filter="inputFilter"
          @input-file="inputFile"
          ref="upload">
          Subir imagen
        </file-upload>
      </div>
    </div>

    <div class="avatar-edit" v-show="files.length && edit">
      <div class="avatar-edit-image" v-if="files.length">
        <img ref="editImage" :src="files[0].url" />
      </div>
      <div class="text-center p-4">
        <button type="button" class="btn btn-secondary" @click.prevent="$refs.upload.clear">Cancelar</button>
        <button type="submit" class="btn btn-primary" @click.prevent="editSave">Agregar</button>
      </div>
    </div>
  </div>
                    </div>
                </div>
              
              
              
                <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    <!-- /.container-fluid -->



</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')


<!-- Additional Scripts -->
 <script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>

<script src="{{ asset('/js/axios.js') }}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="https://unpkg.com/vue-select@latest"></script>

<!-- START DATEPICKER -->
<link href="https://cdn.jsdelivr.net/npm/flatpickr@4/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4/dist/flatpickr.min.js"></script>
<!-- Vue js -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6"></script>
<!-- Lastly add this package -->
<script src="https://cdn.jsdelivr.net/npm/vue-flatpickr-component@8"></script>
<!-- END DATEPICKER -->
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<!-- Quill JS Vue -->
<script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.4/quill.core.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.4/quill.bubble.css" rel="stylesheet">

<!--UPLOAD FILE  -->
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vue-upload-component"></script>
<!--END UPLOAD FILE  -->

<style>
.example-avatar .avatar-upload .rounded-circle {
  width: 200px;
  height: 200px;
}
.example-avatar .text-center .btn {
  margin: 0 .5rem
}
.example-avatar .avatar-edit-image {
  max-width: 100%
}
.example-avatar .drop-active {
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  position: fixed;
  z-index: 9999;
  opacity: .6;
  text-align: center;
  background: #000;
}
.example-avatar .drop-active h3 {
  margin: -.5em 0 0;
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  font-size: 40px;
  color: #fff;
  padding: 0;
}
</style>

<script>

// Initialize as global component
Vue.component('flat-pickr', VueFlatpickr);
</script>
<!-- Custom page Script -->
<script>
Vue.use(VueQuillEditor)

Vue.component('flat-pickr', VueFlatpickr);

Vue.component('v-select', VueSelect.VueSelect)
Vue.component('file-upload', VueUploadComponent)

    var app = new Vue({
        el: '#app',
        components: {

            LocalQuillEditor: VueQuillEditor.quillEditor,
             FileUpload: VueUploadComponent
    },
        data() {
            return {
                message: '',
                title_type:'',
                permanent_link_type:'',
                content_type:'',
                visibility:'',
                status:'',
                datepublication:'',
                page:{},
                page:'',
                pages: [],
                files: [],
      edit: false,
      cropper: false,
     editorOption: {
        theme: 'snow'
      },
                configs: {
          dateTimePicker: {
            enableTime: true,
            dateFormat: 'Y-m-d H:i:s'
          }
            }
            
          }
        },
        watch: {
    edit(value) {
      if (value) {
        this.$nextTick(function () {
          if (!this.$refs.editImage) {
            return
          }
          let cropper = new Cropper(this.$refs.editImage, {
            aspectRatio: 1 / 1,
            viewMode: 1,
          })
          this.cropper = cropper
        })
      } else {
        if (this.cropper) {
          this.cropper.destroy()
          this.cropper = false
        }
      }
    }
  },
        mounted() { 
           // console.log('this is quill A instance object', this.editorA, 'B instance', this.editorB)

        },
        methods: {
           editSave() {
      this.edit = false
      let oldFile = this.files[0]
      let binStr = atob(this.cropper.getCroppedCanvas().toDataURL(oldFile.type).split(',')[1])
      let arr = new Uint8Array(binStr.length)
      for (let i = 0; i < binStr.length; i++) {
        arr[i] = binStr.charCodeAt(i)
      }
      let file = new File([arr], oldFile.name, { type: oldFile.type })
      this.$refs.upload.update(oldFile.id, {
        file,
        type: file.type,
        size: file.size,
        active: true,
      })
    }, alert(message) {
      alert(message)
    },
    inputFile(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        this.$nextTick(function () {
          this.edit = true
        })
      }
      if (!newFile && oldFile) {
        this.edit = false
      }
    },
    inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        if (!/\.(gif|jpg|jpeg|png|webp)$/i.test(newFile.name)) {
          this.alert('Your choice is not a picture')
          return prevent()
        }
      }
      if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
        newFile.url = ''
        let URL = window.URL || window.webkitURL
        if (URL && URL.createObjectURL) {
          newFile.url = URL.createObjectURL(newFile.file)
        }
      }
    },
            onEditorBlur(quill) {
        console.log('editor blur!', quill)
      },
      onEditorFocus(quill) {
        console.log('editor focus!', quill)
      },
      onEditorReady(quill) {
        console.log('editor ready!', quill)
      },
            back() {

            },
            saveRow() {
                Swal.fire({
                    title: 'Estas seguro de guardar el elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Guardar'
                    }).then((result) => {
                    if (result.value) {
                        let form = {
                                title: this.title_type,
                                permanent_link: this.permanent_link_type,
                                content: this.content_type,
                                visibility: this.visibility,
                                status_page: this.status,
                                publication_date: this.datepublication,
                                image: this.files,

                               // id_user: this.iduser

                            }

                            saveElement('page', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
                                           Swal.fire(
                                                'Elemento Guardado',
                                                'La información se almaceno correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/goadmin/pages';
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
            cleanform() {

            }

        },
        computed: {
           /* editorA() {
        return this.$refs.quillEditorA.quill
      },
      editorB() {
        return this.$refs.quillEditorB.quill
      }*/

        },
    })
</script>