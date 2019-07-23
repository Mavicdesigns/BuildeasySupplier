<template>


    <div class="">
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property" >
                        <option selected="selected">All Categories</option>
                        <option v-for="(category,index) in categories" :value="category.name">{{category.name}}</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters
                </button>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add item
                </button>
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">

            <div v-if="success" class="row" style="margin-top: 20px">
                <div class="sufee-alert alert with-close alert-danger alert-dismissible col-lg-8 col-lg-offset-2  show">
                    <span class="badge badge-pill badge-success">Alert</span>
                    {{success}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>


            <table class="table table-data2">

                <thead>
                <tr v-if="checkedProducts.length > 0" style="background: #fff">
                    <th>
<label class="au-checkbox">
                            <input type="checkbox" v-model="selectAll" @click="selectAllProducts">
                            <span class="au-checkmark"></span>
                        </label>                </label>
                    </th>
                    <th>{{checkedProducts.length}}
                        <small>selected</small>
                    </th>
                    <th></th>
                    <th>
                        <vs-dropdown :color="'#2E4EFF'" vs-custom-content vs-trigger-click >
                            <vs-button color="primary" type="flat">Add to collection</vs-button>

                        </vs-dropdown>
                    </th>
                    <th><vs-button color="primary" type="flat">Delete</vs-button></th>
                    <th><vs-button color="primary" type="flat">Set Visibilty</vs-button></th>
                </tr>
                <tr v-if="checkedProducts.length <= 0">
                    <th>
                        <label class="au-checkbox">
                            <input type="checkbox" v-model="selectAll" @click="selectAllProducts">
                            <span class="au-checkmark"></span>
                        </label>
                    </th>
                    <th>name</th>
                    <th>Sku</th>
                    <th>status</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>


                <tr class="tr-border" v-bind:key="products" v-for="(products, index) in allProducts">
                    <td>
                        <label class="au-checkbox">
                            <input type="checkbox" v-model="checkedProducts" @click="uncheckSelectAll"
                                   :value="products.product_id">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>


                    <td class="title"><a :href="'MyProducts/'+products.product_id">{{products.title}}</a></td>
                    <td>2018-09-27 02:12</td>
                    <td>
                        <span class="status--process">{{products.status}}</span>
                    </td>
                    <td>{{products.price}}</td>
                    <td>
                        <div class="table-data-feature">

                            <div class="centerx">

                            </div>

                            <a class="item" data-toggle="tooltip" @click="deleteProduct(products.product_id, index)" data-placement="top" title="More">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                            <vs-dropdown :color="'#2E4EFF'" vs-custom-content vs-trigger-click >
                                <a class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </a>

                                <vs-dropdown-menu >

                                        <vs-dropdown-item >Add to collection</vs-dropdown-item>
                                        <vs-dropdown-item >Hide</vs-dropdown-item>
                                        <vs-dropdown-item >Duplicate</vs-dropdown-item>


                                </vs-dropdown-menu>
                            </vs-dropdown>


                        </div>
                    </td>
                </tr>

                </tbody>

            </table>
        </div>

    </div>

</template>

<script>
    export default{

        props: ['supplier_id'],

        created(){
            this.getAllProducts();
            this.getCategory()
        },

        data(){

            return {
                switch1: true,
                baseUrl:this.$parent.$data.baseUrl,
                allProducts: [],
                products: {
                    title: '',
                    status: '',
                    product_id: '',
                    price: '',
                    imagePath: ''
                },
                category: {
                    name: '',
                    category_id: '',
                    id: ''
                },
                categories: [],
                checkedProducts: [],
                success: '',
                selectAll: false,
                error: [],
            }
        },

        methods: {

            showPopup(el){
                el.children.classList.toggle("show");
            },

            uncheckSelectAll(){
                this.selectAll = false;
            },
            selectAllProducts(){
                this.checkedProducts = [];

                if (!this.selectAll) {

                    this.allProducts.forEach((product) => {
                        this.checkedProducts.push(product.product_id)

                })

                }
            },
            getCategory(){


                var self = this;

                axios.get('http://localhost/supplier.buildeasy/public/Products/category')

                        .then(function (response) {
                            self.categories = response.data.categories;
                        }, function (error) {

                        });
            },
            getAllProducts(){


                var self = this;

                axios.get(this.baseUrl+ '/products/getSupplierProducts/' + this.supplier_id + '?api_key=4ntbqhy2g0mc&page=1&limit=20')
                        .then(function (response) {
                            self.allProducts = response.data.supplier_products.data;
                        }, function (error) {

                        });
            },
            deleteProduct(id, index){
                var self = this;
                self.success = '';

                this.$vs.dialog({
                    title:'Confirm Delete',
                    text: 'Are you sure you want to delete this Product',
                    color: 'danger',
                    accept : function(){
                        axios.get(this.baseUrl+ '/products/deleteProduct/' + id + '?api_key=4ntbqhy2g0mc')
                                .then(function (response) {

                                    self.error = response.data.error;

                                    if (response.data.success === 1) {
                                        self.allProducts.splice(index, 1);
                                        self.$vs.notify({
                                            title:'Deleted Successfully',
                                            text:'This Product has been deleted successfully',
                                            color:'success',
                                            icon:'check_circle'
                                        }) ;
                                    } else {
                                        self.$vs.notify({
                                            title:'Error Deleting',
                                            text: response.data.error_message || 'Something went wrong',
                                            color:'danger',
                                            icon:'error'
                                        }) ;
                                    }

                                }, function (error) {
                                    self.$vs.notify({
                                        title:'Error Connecting',
                                        text: 'Something went wrong, Try again',
                                        color:'danger',
                                        icon:'error'
                                    }) ;
                                });
                    },
                    type : 'confirm',
                    buttonAccept: true,
                    buttonCancel: true
                });

            },
            atConfirmDelete(){

            }
        }


    }
</script>