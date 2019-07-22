<template>
    <div>

        <bu-upload-image  :user_id="supplier_id" :imagePageOpen.sync="imagePagePop" :selectedImages.sync="selectedImages"></bu-upload-image>



        <header class="header">

            <div class="breadcrumbs">
                <h5 class="d-inline">{{supplier_id}}</h5>
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

                        <div class="box-data" v-if="product.options">
                            <div>
                                <div v-for="(options,index) in JSON.parse(product.options)" class="optionsblockbox">
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

                                        <input type="radio" name="demo"  :id="index" class="form-radio" :value="category.category_id" v-model="product.category_id">
                                        <label :for="index">{{category.name}}</label>

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


                        <div class="box-data" v-if="product.attributes">
                            <div v-for="(options,index) in JSON.parse(product.attributes)" class="optionsblockbox">
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
    Vue.component("input-tags", VueTags);
    Vue.component("bu-upload-image", BuUploadImage);

    import BeImages from "./be-image.vue";
    Vue.component("be-image", BeImages);

    export default  {
        props:['product_id','supplier_id'],
        mounted() {

        },
        components:{
            VueTags,
            BuUploadImage,
            BeImages
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
                selectedImages: [],
                allProducts:[],
                product:{
                    supplier_id: this.supplier_id,
                    product_id: this.product_id,
                    title:this.$parent.$data.productTitle,
                    price:'',
                    description:'',
                    images:[],
                    status:'in stock',
                    valuation:'',
                    category_id:'',
                    sku:'',
                    file:'',
                    weight:'',
                    options:[],
                    attributes:[]
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
                message:''
            }
        },
        created() {

            this.getCategory();
            this.getProduct();

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
            getProduct(){


                var self = this;

                axios.get('http://localhost/buildeasyApi/public/products/'+self.product_id+'?api_key=4ntbqhy2g0mc&page=1')

                        .then(function(response) {
                            self.product = (response.data.current_product);

                        },function(error){

                        });

            },

            onFileChanged(event){
                let files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file){
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.product.file = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            reset(){
                this.category.name = '';
            },
            submitProduct(){

                this.$vs.loading();

                var  self =this;
                this.success = '';
                axios.post('http://localhost/buildeasyApi/public/products/updateProduct?api_key=4ntbqhy2g0mc',JSON.stringify(self.product))
                        .then(function(response){



                            if(response.data.success == 1) {
                                self.$vs.notify({
                                    title: 'Updated Successfully',
                                    text: 'This Product has been Updated successfully',
                                    color: 'success',
                                    icon: 'check_circle'
                                });
                            }else {
                                self.$vs.notify({
                                    title: 'Failed to Update',
                                    text: response.data.error_message || 'There was a problem updating this product',
                                    color: 'danger',
                                    icon: 'error'
                                });
                                if (response.data.error == 1) {
                                    self.success = JSON.stringify(self.product) || 'ghy';
                                }
                            }

                            self.$vs.loading.close();

                        })
            },
            parseApiError(error){

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

                var option = JSON.parse(this.product.options);
                option.push(this.options);
                this.product.options = JSON.stringify(option);
                this.resetOptions();
                $('#close').click();

            },
            delProperty(index){
                var attribute = JSON.parse(this.product.attributes);
                attribute.splice(index,1);
                this.product.attributes = JSON.stringify(attribute);

            },
            addProperty(){
                var attribute = JSON.parse(this.product.attributes);
                attribute.push(this.property);
                this.product.attributes = JSON.stringify(attribute);
                this.resetProperty();
                $('.propsEdit').hide();
            },
            showPropsEdit(){
                $('.propsEdit').show();
            },

        }

    }
</script>