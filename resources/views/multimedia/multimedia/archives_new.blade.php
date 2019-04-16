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
        <h1 class="h3 mb-0 text-gray-800">Agregar una Archivo</h1>
    </div>   

    <div class="example-full">
  <button type="button" class="btn btn-danger float-right btn-is-option" @click.prevent="isOption = !isOption">
    <i class="fa fa-cog" aria-hidden="true"></i>
    Options
  </button>
  <h1 id="example-title" class="example-title">Full Example</h1>

  
  <div class="upload" v-show="!isOption">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Miniatura</th>
            <th>Nombre</th>
            <th>Tamaño</th>
            <th>Velocidad</th>
            <th>Estatus</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!files.length">
            <td colspan="7">
              <div class="text-center p-5">
                 <img :src="files.length ? files[0].url : 'https://cdn.pixabay.com/photo/2016/01/03/00/43/upload-1118929_960_720.png'"  width="200" height="200" align="center"/>
                 </br>
                <label :for="name" class="btn btn-lg btn-primary" align="center">Selecciona un Archivo</label>
              </div>
            </td>
          </tr>
          <tr v-for="(file, index) in files" :key="file.id">
            <td></td>
            <td>
              <img v-if="file.thumb" :src="file.thumb" width="40" height="auto" />
              <span v-else>No Image</span>
            </td>
            <td>
              <div class="filename">@{{file.name}}
              </div>
              <div class="progress" v-if="file.active || file.progress !== '0.00'">
                <div :class="{'progress-bar': true, 'progress-bar-striped': true, 'bg-danger': file.error, 'progress-bar-animated': file.active}" role="progressbar" :style="{width: file.progress + '%'}">@{{file.progress}}%</div>
              </div>
            </td>
            <td>@{{file.size | formatSize}}</td>
            <td>@{{file.speed | formatSpeed}}</td>

            <td v-if="file.error">@{{file.error}}</td>
            <td v-else-if="file.success">success</td>
            <td v-else-if="file.active">active</td>
            <td v-else></td>
            <td>
              <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button">
                  Action
                </button>
                <div class="dropdown-menu">
                  <a :class="{'dropdown-item': true, disabled: file.active || file.success || file.error === 'compressing'}" href="#" @click.prevent="file.active || file.success || file.error === 'compressing' ? false :  onEditFileShow(file)">Edit</a>
                  <a :class="{'dropdown-item': true, disabled: !file.active}" href="#" @click.prevent="file.active ? $refs.upload.update(file, {error: 'cancel'}) : false">Cancel</a>

                  <a class="dropdown-item" href="#" v-if="file.active" @click.prevent="$refs.upload.update(file, {active: false})">Abort</a>
                  <a class="dropdown-item" href="#" v-else-if="file.error && file.error !== 'compressing' && $refs.upload.features.html5" @click.prevent="$refs.upload.update(file, {active: true, error: '', progress: '0.00'})">Retry upload</a>
                  <a :class="{'dropdown-item': true, disabled: file.success || file.error === 'compressing'}" href="#" v-else @click.prevent="file.success || file.error === 'compressing' ? false : $refs.upload.update(file, {active: true})">Upload</a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" @click.prevent="$refs.upload.remove(file)">Remove</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="example-foorer">
      <div class="btn-group">
        <file-upload
          class="btn btn-primary dropdown-toggle"
          :post-action="postAction"
          :put-action="putAction"
          :extensions="extensions"
          :accept="accept"
          :multiple="multiple"
          :directory="directory"
          :size="size || 0"
          :thread="thread < 1 ? 1 : (thread > 5 ? 5 : thread)"
          :headers="headers"
          :data="data"
          :drop="drop"
          :drop-directory="dropDirectory"
          :add-index="addIndex"
          v-model="files"
          @input-filter="inputFilter"
          @input-file="inputFile"
          ref="upload">
          <i class="fa fa-plus"></i>
          Seleccionar
        </file-upload>
        <div class="dropdown-menu">
          <label class="dropdown-item" :for="name">Agregar archivos</label>
          <a class="dropdown-item" href="#" @click="onAddFolader">Agregar Carpeta</a>
          <a class="dropdown-item" href="#" @click.prevent="addData.show = true">Agregar datos</a>
        </div>
      </div>
      <button type="button" class="btn btn-success" v-if="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
        Subir
      </button>
      <button type="button" class="btn btn-danger"  v-else @click.prevent="$refs.upload.active = false">
        <i class="fa fa-stop" aria-hidden="true"></i>
        Detener
      </button>
    </div>
  </div>





</div>   

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Agregar Archivo</h6>
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
                    <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de archivo</label>
                    <input type="text" class="form-control" id="inputName" v-model="name_type" aria-describedby="nameHelp" placeholder="Nombre del archivo" disabled>
                     </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo de archivo</label>
                                    <input type="text" class="form-control" id="inputTypeArchive" v-model="typearchive_type" aria-describedby="nameHelp" placeholder="Tipo de archivo" disabled >
                                    </div>
                    </div>
                   <!-- <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Fecha de creación</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="creationdate_type" aria-describedby="nameHelp" placeholder="Fecha de creación" >
                     </div>
                    </div>-->
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Tamaño del archivo</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="size_type" aria-describedby="nameHelp" placeholder="Tamaño del archivo" disabled>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Dimensiones</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="dimension_type" aria-describedby="nameHelp" placeholder="Dimension del archivo" disabled>
                     </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" class="form-control" id="inputUrl" v-model="url_type" aria-describedby="nameHelp" placeholder="Url">
                     </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="inputTitle" v-model="title_type" aria-describedby="nameHelp" placeholder="Título del archivo">
                     </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Texto alternativo</label>
                    <input type="text" class="form-control" id="inputAlternativeText" v-model="alternativetext_type" aria-describedby="nameHelp" placeholder="Texto alternativo">
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Leyenda</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="legend_type" aria-describedby="nameHelp" placeholder="Leyenda del archivo"></textarea>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputDescription" v-model="description_type" aria-describedby="nameHelp" placeholder="Descripción del archivo"></textarea>
                     </div>
                    </div>
                   

                </div>
              
              
              
                <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>
   
    <!-- /.container-fluid -->



</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')


<style>
.example-full .btn-group .dropdown-menu {
  display: block;
  visibility: hidden;
  transition: all .2s
}
.example-full .btn-group:hover > .dropdown-menu {
  visibility: visible;
}
.example-full label.dropdown-item {
  margin-bottom: 0;
}
.example-full .btn-group .dropdown-toggle {
  margin-right: .6rem
}
.example-full .filename {
  margin-bottom: .3rem
}
.example-full .btn-is-option {
  margin-top: 0.25rem;
}
.example-full .example-foorer {
  padding: .5rem 0;
  border-top: 1px solid #e9ecef;
  border-bottom: 1px solid #e9ecef;
}
.example-full .edit-image img {
  max-width: 100%;
}
.example-full .edit-image-tool {
  margin-top: .6rem;
}
.example-full .edit-image-tool .btn-group{
  margin-right: .6rem;
}
.example-full .footer-status {
  padding-top: .4rem;
}
.example-full .drop-active {
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
.example-full .drop-active h3 {
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
<!-- Additional Scripts -->
 <script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>

<script src="{{ asset('/js/axios.js') }}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="https://unpkg.com/vue-select@latest"></script>
<!--UPLOAD FILE  -->
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vue-upload-component"></script>
<!--END UPLOAD FILE  -->

<!-- Custom page Script -->
<script>
Vue.component('v-select', VueSelect.VueSelect)
Vue.component('file-upload', VueUploadComponent)

    var app = new Vue({
        el: '#app',
        components: {
             FileUpload: VueUploadComponent
    },
        data() {
            return {
                message: '',
                name_type:'',
                typearchive_type:'',
                creationdate_type:'',
                size_type:'',
                dimension_type:'',
                url_type:'',
                title_type:'',
                legend_type:'',
                alternativetext_type:'',
                description_type:'',
                user_type:'',
                files: [],
      accept: 'image/png,image/gif,image/jpeg,image/webp',
      extensions: 'gif,jpg,jpeg,png,webp',
      // extensions: ['gif', 'jpg', 'jpeg','png', 'webp'],
      // extensions: /\.(gif|jpe?g|png|webp)$/i,
      minSize: 1024,
      size: 1024 * 1024 * 10,
      multiple: true,
      directory: false,
      drop: true,
      dropDirectory: true,
      addIndex: false,
      thread: 3,
      name: 'file',
      postAction: '/upload/post',
      putAction: '/upload/put',
      headers: {
        'X-Csrf-Token': 'xxxx',
      },
      data: {
        '_csrf_token': 'xxxxxx',
      },
      autoCompress: 1024 * 1024,
      uploadAuto: false,
      isOption: false,
      addData: {
        show: false,
        name: '',
        type: '',
        content: '',
      },
      editFile: {
        show: false,
        name: '',
      }
            }
        },
        mounted() {  

                  

             


        },
        methods: {
            back() {

            },
            inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // Before adding a file
        // 添加文件前
        // Filter system files or hide files
        // 过滤系统文件 和隐藏文件
        if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
          return prevent()
        }
        // Filter php html js file
        // 过滤 php html js 文件
        if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
          return prevent()
        }
        // Automatic compression
        // 自动压缩
        if (newFile.file && newFile.type.substr(0, 6) === 'image/' && this.autoCompress > 0 && this.autoCompress < newFile.size) {
          newFile.error = 'compressing'
          const imageCompressor = new ImageCompressor(null, {
            convertSize: Infinity,
            maxWidth: 512,
            maxHeight: 512,
          })
          imageCompressor.compress(newFile.file)
            .then((file) => {
              this.$refs.upload.update(newFile, { error: '', file, size: file.size, type: file.type })
            })
            .catch((err) => {
              this.$refs.upload.update(newFile, { error: err.message || 'compress' })
            })
        }
      }
      if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
        // Create a blob field
        // 创建 blob 字段
        newFile.blob = ''
        let URL = window.URL || window.webkitURL
        if (URL && URL.createObjectURL) {
          newFile.blob = URL.createObjectURL(newFile.file)
        }
        // Thumbnails
        // 缩略图
        newFile.thumb = ''
        if (newFile.blob && newFile.type.substr(0, 6) === 'image/') {
          newFile.thumb = newFile.blob
        }
      }
    },// add, update, remove File Event
    inputFile(newFile, oldFile) {
      if (newFile && oldFile) {
        // update
        if (newFile.active && !oldFile.active) {
          // beforeSend
          // min size
          if (newFile.size >= 0 && this.minSize > 0 && newFile.size < this.minSize) {
            this.$refs.upload.update(newFile, { error: 'size' })
          }
        }
        if (newFile.progress !== oldFile.progress) {
          // progress
        }
        if (newFile.error && !oldFile.error) {
          // error
        }
        if (newFile.success && !oldFile.success) {
          // success
        }
      }
      if (!newFile && oldFile) {
        // remove
        if (oldFile.success && oldFile.response.id) {
          // $.ajax({
          //   type: 'DELETE',
          //   url: '/upload/delete?id=' + oldFile.response.id,
          // })
        }
      }
      // Automatically activate upload
      if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
        if (this.uploadAuto && !this.$refs.upload.active) {
          this.$refs.upload.active = true
        }
      }
    },
    alert(message) {
      alert(message)
    },
    onEditFileShow(file) {
      this.editFile = { ...file, show: true }
      this.$refs.upload.update(file, { error: 'edit' })
    },
    onEditorFile() {
      if (!this.$refs.upload.features.html5) {
        this.alert('Your browser does not support')
        this.editFile.show = false
        return
      }
      let data = {
        name: this.editFile.name,
      }
      if (this.editFile.cropper) {
        let binStr = atob(this.editFile.cropper.getCroppedCanvas().toDataURL(this.editFile.type).split(',')[1])
        let arr = new Uint8Array(binStr.length)
        for (let i = 0; i < binStr.length; i++) {
          arr[i] = binStr.charCodeAt(i)
        }
        data.file = new File([arr], data.name, { type: this.editFile.type })
        data.size = data.file.size
      }
      this.$refs.upload.update(this.editFile.id, data)
      this.editFile.error = ''
      this.editFile.show = false
    },
    // add folader
    onAddFolader() {
      if (!this.$refs.upload.features.directory) {
        this.alert('Your browser does not support')
        return
      }
      let input = this.$refs.upload.$el.querySelector('input')
      input.directory = true
      input.webkitdirectory = true
      this.directory = true
      input.onclick = null
      input.click()
      input.onclick = (e) => {
        this.directory = false
        input.directory = false
        input.webkitdirectory = false
      }
    },
    onAddData() {
      this.addData.show = false
      if (!this.$refs.upload.features.html5) {
        this.alert('Your browser does not support')
        return
      }
      let file = new window.File([this.addData.content], this.addData.name, {
        type: this.addData.type,
      })
      this.$refs.upload.add(file)
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
                                name: this.name_type,
                                type: this.typearchive_type,
                                size: this.size_type,
                                dimension: this.dimension_type,
                                url: this.url_type,
                                title: this.title_type,
                                legend: this.legend_type,
                                alternative_text: this.alternativetext_type,
                                description: this.description_type,

                            }

                            saveElement('archive', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
                                           Swal.fire(
                                                'Elemento Guardado',
                                                'La información se almaceno correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/goadmin/library';
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

        }
    })
</script>