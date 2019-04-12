/ template> <style scoped>     img {         max-height: 36px;     } </style> <script>     exportar por defecto {





















        data () { 
            return { 
                image: '' 
            } 
        }, 
        métodos: { 
            onFileChange (e) { 
                let files = e.target.files || e.dataTransfer.files; 
                if (! files.length) 
                    return; 
                this.createImage (archivos [0]); 
            }, 
            createImage (file) { 
                let reader = new FileReader (); 
                sea ​​vm = esto; 
                reader.onload = (e) => { 
                    vm.image = e.target. como resultado ; 
                }; 
                reader.readAsDataURL (archivo);
            }, 
            upload () { 
                axios.post ('/ api / upload', {image: this.image}). then (response => { 

                }); 
            } 
        } 
    } 
</script>