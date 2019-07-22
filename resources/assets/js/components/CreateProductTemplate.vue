<template>

   <div class="">

       <bu-upload-image  :user_id="user_id" :imagePageOpen.sync="imagePagePop" :selectedImages.sync="selectedImages"></bu-upload-image>


       <header class="header">

           <div class="breadcrumbs">
               <h5 class="d-inline">Product</h5>
               <h5 class="d-inline"> > </h5>
               <h5 class="d-inline">{{product.title}}</h5>
           </div>
           <div class="header-title col-lg-9">

               <input type="text" class="header-product-title form-control"  v-model="product.title">

           </div>
           <div class="header-navs col-lg-3">
               <button type="submit"  class="btn btn-danger btn-cancel">Cancel</button>
               <button type="submit" @click="submitProduct"  class="btn btn-danger btn-submit">Save</button>
           </div>

           <div v-if="success" class="row" style="margin-top: 20px">
               <div class="sufee-alert alert with-close alert-danger alert-dismissible col-lg-8 col-lg-offset-2  show">
                   <span class="badge badge-pill badge-success">Alert</span>
                   {{success}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           </div>

       </header>

       <div class="" style="padding: 70px;">


           <div class="col-md-7 rx-col" style="height: 250px">

               <div class="row">
                   <div class="image-box box ">

                       <div class="box-header">
                           <h3>Images and Videos</h3>
                       </div>

                       <div class="box-body row">

                           <be-image :dataImages.sync="product.images"></be-image>

                           <div class="col-md-6">
                               <button class="rx-big-btn"  @click="imagePagePop=true">Add Images</button>

                           </div>

                           <div class="col-md-6">
                               <button class="rx-big-btn">Add Videos</button>

                           </div>
                       </div>

                   </div>

                   <div class="box">
                       <div class="row">

                       </div>
                   </div>


                   <div class="product-info-box box">

                       <div class="box-header">
                           <h3>Product Info</h3>
                       </div>

                       <div class="box-body form-box row">

                           <h5>Basic Info</h5>


                           <div class="m" style="margin: 30px 0" >

                               <div class="form-group form-big">
                                   <label for="title">Name</label>
                                   <input type="text"  v-model="product.title" class="form-control " placeholder="Add a product name">

                               </div>

                               <div class="form-group form-small">
                                   <label for="title">Ribbons</label>
                                   <input type="text" id="ribbons" class="form-control ">
                               </div>

                               <div class="form-group form-small">
                                   <label for="title">Price</label>
                                   <input type="text" id="price" v-model="product.price" class="form-control " placeholder="#1000">
                               </div>

                               <div class="form-group form-small">
                                   <label for="valuation">valuation</label>
                                   <select name="valuation" id="valuation" v-model="product.valuation" class="form-control">
                                       <option value="kg">Kg</option>
                                       <option value="cmm">Cmm</option>
                                   </select>
                               </div>

                               <br>

                               <div class="form-group form-full">
                                   <label for="description">Description</label>
                                   <textarea id="description" class="form-control" v-model="product.description" cols="12" rows="5"></textarea>
                               </div>

                           </div>


                       </div>

                   </div>



                   <div class="options-box box">

                       <div class="box-header">
                           <h3>Product Options</h3>
                           <p>Does your product come in different options, like Size, Color or Material? Add them here.</p>
                       </div>

                       <div class="box-data" v-if="product.allOptions.length > 0">
                           <div>
                               <div v-for="(options,index) in product.allOptions" class="optionsblockbox">
                                   {{options.name}}

                                  <div class="tag-box">
                                      <span v-for="tag in options.tags" class="tags-input-tag">
                                          <span> {{ tag }} </span>

                                      </span>
                                  </div>
                               </div>


                           </div>

                       </div>

                       <div class="box-body">

                           <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#mediumModal">
                               <i class="fa fa-plus"></i>&nbsp; Add options</button>



                           <div class="modal fade optionsModal" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                                           <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">


                                           <div class="box-body form-box row">


                                               <div class="m" style="margin: 30px 0" >

                                                   <div class="form-group form-big">
                                                       <label for="title">Option Name</label>
                                                       <input type="text"  v-model="options.name" class="form-control " placeholder="Add a product name">
                                                   </div>



                                                   <div class="form-group ">
                                                       <label for="title">Options</label>
                                                       <input-tags v-model="options.tags">
                                                           <div class="tags-input"
                                                                slot-scope="{tag,removeTag,inputEventHandlers,inputBindings }">

                                                               <span v-for="tag in options.tags" class="tags-input-tag">
                                                                   <span> {{ tag }} </span>
                                                                   <button type="button" class="tags-input-remove" @click="removeTag(tag)">×</button>
                                                               </span>
                                                               <input
                                                                       class="tags-input-text"
                                                                       placeholder="Add tag..."
                                                                       v-on="inputEventHandlers"
                                                                       v-bind="inputBindings"
                                                               >
                                                           </div>
                                                       </input-tags>

                                                   </div>


                                               </div>


                                           </div>



                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                           <button type="button" @click="addOption" class="btn btn-primary">Confirm</button>
                                       </div>
                                   </div>
                               </div>
                           </div>


                       </div>

                   </div>

                   <div class="shipping-box box">

                       <div class="box-header">
                           <h3>Inventory and Shipping</h3>
                       </div>

                       <div class="box-body form-box ">

                           <div class="form-group form-small">
                               <label for="status">Status</label>
                               <select name="status" id="status" v-model="product.status" class="form-control">
                                   <option value="In Stock">In Stock</option>
                                   <option value="Out Of Stock">Out of Stock</option>
                               </select>
                           </div>

                           <div class="form-group form-small">
                               <label for="sku">Sku</label>
                               <input type="text" id="sku" v-model="product.sku" class="form-control " placeholder="">

                           </div>

                           <div class="form-group form-small">
                               <label for="status">Weight</label>
                               <input type="text" id="weight" v-model="product.weight" class="form-control " placeholder="0.00">

                           </div>


                       </div>

                   </div>


               </div>

           </div>

           <div class="col-md-4 rx-col"  style="height: 250px">

               <div class="row">


                   <div class="category-box box">

                       <div class="box-header">
                           <h3 style="display: inline-block">Visibility  </h3>
                           <label class="switch switch-3d switch-primary mr-3" style="display: inline-block;float: right;">
                               <input type="radio" class="switch-input" checked="true">
                               <span class="switch-label"></span>
                               <span class="switch-handle"></span>
                           </label>


                       </div>

                       <div class="box-body">
                           <h4>Collections</h4>


                           <div class="m form-check" style="margin: 30px 0">
                               <div class="" v-if="categories.length > 0">

                                   <div class="checkbox " v-for="(category, index) in categories">

                                           <input type="radio" name="demo"  id="radio-one" class="form-radio" :value="category.category_id" v-model="product.category_id">
                                           <label for="radio-one">{{category.name}}</label>

                                   </div>


                               </div>


                               <div class="checkbox form-box" id="inputCat">

                                   <div class="form-group ">
                                       <input type="text" id="title"  v-model="category.name" style="width: 60%;display: inline" class="form-control" placeholder="Add a product name">
                                       <button class="btn btn-round2" style="display: inline" @click="addCategory">Add </button>

                                   </div>

                               </div>

                           </div>





                       </div>

                   </div>

                   <div class="feature-box box">

                       <div class="box-header">
                           <h3 style="display: inline-block">Add Property  </h3>
                       </div>


                       <div class="box-data" v-if="product.allProperties.length > 0">
                           <div v-for="(options,index) in product.allProperties" class="optionsblockbox">
                               <div  class="propBlockBox">
                                   {{options.name}}

                                   <div class="tag-box">

                                          <span> {{ options.value }} </span>

                                       <span><button class="btn btn-round2" style="display: inline-block !important" @click="delProperty(index)">Remove</button></span>

                                   </div>
                               </div>


                           </div>

                       </div>

                       <div class="box-data">

                           <div class="propsEdit">

                               <div  class="optionsblockbox">
                                 <input type="text" v-model="property.name" class="propsInput"  placeholder="Property Name">


                                    <input type="text" v-model="property.value" class="propsInput" placeholder="Property Value">

                                       <button class="btn btn-round2" style="display: inline-block !important" @click="addProperty">Add</button>



                               </div>


                           </div>


                       </div>

                     <div class="box-footer">
                         <button type="button" class="btn btn-primary btn-round" @click="showPropsEdit">
                             <i class="fa fa-plus"></i>&nbsp; Add Property</button>

                     </div>
                   </div>

               </div>




           </div>

       </div>


   </div>
</template>

<script lang="js">

    import VueTags from "vue-tags";
    import BuUploadImage from "./bu-upload-image.vue";
    import BeImages from "./be-image.vue";


    export default  {
        props:['user_id'],
        mounted() {
        },
        components:{
            VueTags,
            BuUploadImage
        },

        watch:{
            selectedImages: function(val){
                var _this = this;
                if(val.length > 0){
                    val.forEach((image) => {
                        let check = _this.product.images.filter((obj) => obj.image_id === image.image_id)
                        if(check == 0){
                            _this.product.images.push(image)

                        }
                    })
                }
            }
        },
        data() {
            return {
                imagePagePop: false,
                selectedImages:[],
                product:{
                    supplier_id : this.user_id,
                    title:this.$parent.$data.productTitle,
                    price:'',
                    description:'',
                    status:'',
                    valuation:'',
                    category:'',
                    images:[],
                    sku:'',
                    file:'',
                    weight:'',
                    allOptions:[],
                    allProperties:[]
                },
                tag:'',
                options:{
                    name:'',
                    tags: ['Laravel','Vuejs']
                },
                category : {
                    name : '',
                    category_id: '',
                    id: ''
                },
                property:{
                    name:'',
                    value:''
                },
                categories:[],
                success: '',
                error:{
                    title:[],
                    price:[],
                    description:[],
                    status:[],
                    valuation:[],
                    category_id:[],
                    sku:[],
                    file:[],
                    weight:[],

                }
            }
        },
        created() {
            this.getCategory();
        },

        methods:{
            getCategory(){


                var self = this;

                axios.get('http://localhost/supplier.buildeasy/public/Products/category')

                        .then(function(response) {
                            self.categories = response.data.categories;
                        },function(error){

                        });
            },
            addCategory(){

                var self = this;

                axios.get('http://localhost/supplier.buildeasy/public/Products/category/create/'+self.category.name).then(function(response) {

                    self.reset();
                    self.success = response.data.success;
                    self.categories.push(response.data.newCategory);

                    alert(self.success);

                },function(error){

                });

            },
            reset(){
                this.category.name = '';
            },
            submitProduct(){
                var newProduct = JSON.stringify(this.product);
                var  self =this;

                this.$vs.loading({
                    type:'material'
                });

                axios.post('http://localhost/buildeasyApi/public/products/createProduct?api_key=4ntbqhy2g0mc',JSON.stringify(self.product))
                        .then(function(response) {

                            if(response.data.error == 0){
                                self.success = response.data.message;
                            }else if(response.data.message){
                                self.success = response.data.message;
                            }else{
                                self.error = response.data.errors;
                                self.success = JSON.stringify(response.data.errors);
                            }
                            self.$vs.loading.close();

                        },function(error){
                            self.$vs.loading.close();
                            console.log(error);
                            this.$vs.notify({color:'error',title:'Faild to Reach',text:'Unable to connect to Internet Try again later'})

                        });
            },
            resetOptions(){
                this.options = {
                    name: '',
                    tags:[]
                };
            },
            resetProperty(){
                this.property = {
                    name: '',
                    value:''
                };
            },
            addOption(){

                    this.product.allOptions.push(this.options);
                    this.resetOptions();
                    $('#close').click();

            },
            delProperty(index){
                this.product.allProperties.splice(index,1);
            },
            addProperty(){
                this.product.allProperties.push(this.property);
                this.resetProperty();
                $('.propsEdit').hide();
            },
            showPropsEdit(){
                $('.propsEdit').show();
            },

        }

    }
</script>

<style lang="">
    .parentx-static {
        overflow :hidden;
        height: 600px ;
        position: relative;
    }
    .header-sidebar{
        display :flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%
    }

    h4{
        display: flex;
        align-items: center;
        justify-content: center;
        width :100%;
    }

    h4 > button{ margin-left :10px}

    .footer-sidebar{
        display: flex ;
        align-items :center ;
        justify-content: space-between;
        width: 100%;
    }

</style>