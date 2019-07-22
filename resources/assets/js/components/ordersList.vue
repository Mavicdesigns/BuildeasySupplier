<template>


    <div class="">
        <div class="table-data__tool">
            <div class="table-data__tool-left">
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
                <tr v-if="checkedOrders.length > 0" style="background: #fff">
                    <th>
                        <label class="au-checkbox">
                            <input type="checkbox" v-model="selectAll" @click="selectAllOrders">
                            <span class="au-checkmark"></span>
                        </label>                </label>
                    </th>
                    <th>{{checkedOrders.length}}
                        <small>selected</small>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <vs-dropdown :color="'#2E4EFF'" vs-custom-content vs-trigger-click >
                            <vs-button color="primary" type="flat">Add to collection</vs-button>

                            <vs-dropdown-menu >

                                <div v-for="(category, index) in categories">
                                    <vs-dropdown-item >
                                        {{category.name}}
                                    </vs-dropdown-item>

                                </div>

                            </vs-dropdown-menu>
                        </vs-dropdown>
                    </th>
                    <th><vs-button color="primary" type="flat">Delete</vs-button></th>
                    <th><vs-button color="primary" type="flat">Set Visibilty</vs-button></th>

                </tr>
                <tr v-if="checkedOrders.length <= 0">
                    <th>
                        <label class="au-checkbox">
                            <input type="checkbox" v-model="selectAll" @click="selectAllOrders">
                            <span class="au-checkmark"></span>
                        </label>
                    </th>
                    <th>order</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>status</th>
                    <th>qty</th>
                    <th>Total</th>
                    <th> </th>
                </tr>
                </thead>

                <tbody>


                <tr class="tr-border" :key="orders" v-for="(orders, index) in allOrders">
                    <td>
                        <label class="au-checkbox">
                            <input type="checkbox" v-model="checkedOrders" @click="uncheckSelectAll"
                                   :value="orders.product_id">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>


                    <td class="title"><a :href="'MyOrders/'+orders.order_id">{{orders.title}}</a></td>
                    <td>{{orders.created_at | moment("dddd, MMMM Do YYYY")}}</td>
                    <td>
                        <span class="status--process">{{orders.buyer}}</span>
                    </td>
                    <td class="title">{{convertStatusToWord(orders.status)}}</td>
                    <td><span class="status--process">{{orders.quantity}}</span></td>
                    <td><span class="status--process">{{orders.quantity * orders.price}}</span></td>
                    <td>
                        <div class="table-data-feature">

                            <div class="centerx">

                            </div>

                            <a class="item" data-toggle="tooltip" @click="deleteOrder(orders.order_id, index)" data-placement="top" title="More">
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
            this.getAllOrders();
        },

        data(){

            return {
                switch1: true,

                allOrders: [],
                orders: {
                     id : 2,
                     order_id : "OOfaPePa5cQQP51",
                     title : "Untitled Product",
                     price : "20000.00",
                     status : "0",
                     buyer : "Olusegun Olurin",
                     buyer_id : "xpw9BHCU8Es",
                     destination : "place_id:EihLb2xhd29sZSBTdCwgSWZha28gQWdlZ2UsIExhZ29zLCBOaWdlcmlhIi4qLAoUChIJvRKHz0KROxARmk2OA30WZnMSFAoSCekZvrVakTsQEWyM8_1KwmgD",
                     quantity : 20,
                     valuation : "cmm",
                     product_id : "C4NTCMdlJV",
                     supplier_id : "w7RPsTG47s",
                     token : "eO5OQ5Ra001Ofg22SO8f",
                     created_at : "2019-03-09 00:57:12",
                     updated_at : "2019-03-09 00:57:12"
                },
                category: {
                    name: '',
                    category_id: '',
                    id: ''
                },
                categories: [],
                checkedOrders: [],
                success: '',
                selectAll: false,
                error: [],
            }
        },

        methods: {

            convertStatusToWord(status){
                if(status == 0){
                    return "Not Confirmed"
                }else if (status == 1){
                    return "Not Fufilled"
                }else if (status == 2){
                    return "Not Paid"
                }else if (status == 3){
                    return "Fufilled"
                }
            },

            showPopup(el){
                el.children.classList.toggle("show");
            },

            uncheckSelectAll(){
                this.selectAll = false;
            },
            selectAllOrders(){
                this.checkedOrders = [];

                if (!this.selectAll) {

                    this.allOrders.forEach((product) => {
                        this.checkedOrders.push(product.product_id)

                })

                }
            },

            getAllOrders(){


                var self = this;

                axios.get('http://localhost/buildeasyApi/public/allOrders?api_key=4ntbqhy2g0mc&page=1&limit=2&supplier_id='+self.supplier_id)
                        .then(function (response) {
                            self.allOrders = response.data.supplier_orders.data;
                        }, function (error) {
                            console.log(error);
                        });
            },
            deleteOrder(id, index){
                var self = this;
                self.success = '';

                this.$vs.dialog({
                    title:'Confirm Delete',
                    text: 'Are you sure you want to delete this Order',
                    color: 'danger',
                    accept : function(){
                        axios.get('http://localhost/buildeasyApi/public/orders/deleteOrder/' + id + '?api_key=4ntbqhy2g0mc')
                                .then(function (response) {

                                    self.error = response.data.error;

                                    if (response.data.success === 1) {
                                        self.allOrders.splice(index, 1);
                                        self.$vs.notify({
                                            title:'Deleted Successfully',
                                            text:'This Order has been deleted successfully',
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

        }


    }
</script>