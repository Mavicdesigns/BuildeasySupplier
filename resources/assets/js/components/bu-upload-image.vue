<template lang="html">

    <div>



        <div class="popups">

            <vs-popup classContent="popup-example"  style="color:#3899ec" id="clientImages"
                      background-color="rgba(255,255,255,.6)"
                      :background-color-popup="'white'"  fullscreen  title="Choose Image" @close="modalIsClosed" :active.sync="imagePageOpen">

                <div class="" style="padding:0 !important;">
                    <div class="col-md-3" style="height: 500px;">



                        <vs-button @click="uploadImagePop=true" color="primary" type="filled">Open Inner Popup</vs-button>

                    </div>

                    <div class="col-md-9"  style="height: 500px;">


                        <vue-select-image :h="'150px'" :w="'150px'" :dataImages="clientImages"
                                          :isMultiple="true"
                                          :rootClass="'image-box'"
                                          :useLabel="true"
                                          :activeClass="'--active'"
                                          @onselectmultipleimage="onSelectMultipleImage">

                        </vue-select-image>


                        <div class="" align="right" style="position: absolute;bottom: 20px">
                            <vs-button :disabled="onSelectedImages <= 0" @click="addImageToProduct"  color="primary" type="filled">Add to Product</vs-button>
                            <vs-button :disabled="onSelectedImages <= 0" color="primary" type="filled">Delete</vs-button>
                        </div>
                    </div>
                </div>

                <vs-popup title="Add image From Computer"  :active.sync="uploadImagePop">
                    <vs-upload :fileName="'image[]'" :action="'http://localhost/buildeasyApi/public/api/uploadImage?api_key=4ntbqhy2g0mc'" :data="uploadImageData" @on-success="successUpload" />

                </vs-popup>
            </vs-popup>

        </div>

    </div>


</template>

<style>
    .image-box li {
        width: 150px;
        margin: 20px;
        height: 150px;
        display: inline-block;
        border: 1px solid #ddd;
    }
    .image-box__thumbnail--active  {
        background: #8399ec;
        padding: 2px;
    }

    .image-box li:hover img{

    }

    .image-box li img{
        width: 100%; /* or any custom size */
        height: 100%;
        object-fit: cover;
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }
</style>


<script lang="js">

    import BeImagesSelect from "./be-image-select.vue";
    Vue.component("be-images-select", BeImagesSelect);


    export default  {
        props:{
            imagePageOpen:{
                default: false,
                type: Boolean
            },
            user_id:{
                default: '',
                type: String
            },
            selectedImages:{
                default: [],
            }
        },

        components:{
            BeImagesSelect
        },

        mounted() {

        },
        data() {
            return {
                uploadImageData:{
                    supplier_id: this.user_id
                },
                imagePagePop: this.imagePageOpen,
                uploadImagePop: false,
                modalSidebaractive: false,
                clientImages:[],
                onSelectedImages:[]

            }
        },
        created() {


        },

        watch:{
            imagePageOpen: function(val){
                if(val == true){
                    this.getClientImages();
                }
            }
        },

        methods:{

            deleteFunction(event){
                alert(event.title)
            },
            modalIsClosed(){
                this.$emit('update:imagePageOpen',false)

            },

            addImageToProduct(){

                this.$emit('update:selectedImages',this.onSelectedImages);
                this.$emit('update:imagePageOpen',false);

            },
            clearSelected(){

            },
            onSelectMultipleImage(event){

                this.onSelectedImages = event;
            },

            successUpload(event){

                var response = JSON.parse(event.srcElement.response);

                if(response.error == 0){
                    var images = response.images;
                    var self = this;

                    for(var i = 0; i < images.length;i++){


                        self.clientImages.push(images[i])
                    }

                    this.uploadImagePop = false;

                    this.$vs.notify({color:'success',title:'Uploaded Successfully',text:'Your images have been uploaded'})

                }else {
                    this.$vs.notify({color:'danger',title:'Failed to upload',text:response.error_message})
                }

            },

            errorUpload(event){

                console.log(event);


                this.$vs.notify({color:'danger',title:'Failed to Upload',text:'Lorem ipsum dolor sit amet, consectetur'})
            },

            getClientImages(){

                this.clearSelected();

                var self = this;

                this.$vs.loading({
                    container: '#clientImages',
                    scale: 0.6
                });

                axios.get('http://localhost/buildeasyApi/public/api/getSupplierImages?api_key=4ntbqhy2g0mc&supplier_id='+this.user_id)


                        .then(function(response) {
                            if(response.data.error == 0){
                                self.clientImages = response.data.data;
                            }else {
                                alert(response.data.error_message)
                            }
                            setTimeout( ()=> {
                                self.$vs.loading.close('#clientImages > .con-vs-loading')
                        }, 3000);

                        },function(error){
                            console.log(error);
                        });
            },
        }

    }
</script>