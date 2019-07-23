<template>

    <div style="position: relative">
        <div class="" v-if="failedToLoad==false">
            <div class="header-fixed">
                <h1>Order #1101</h1>
                <small class="badge">{{order.status | status}}</small>
                <small><vs-button v-if="order.status == 0 " type="filled" @click="deliverOrder" color="primary">Deliver</vs-button></small>
            </div>

            <div class="row body">

                <div class="col-md-8 col detail-flow">

                    <div class="box ">
                        <div class="box-header">
                            <div class="box-header-title"><h4>Order Details</h4></div>
                            <div class="box-header-tools">
                                <p>Placed on {{order.created_at | moment("dddd, MMMM Do YYYY")}} | Items : {{order.quantity}}</p>
                            </div>
                        </div>

                        <div class="box-body row">
                            <div class="col-md-3">
                                <vs-avatar size="120px" v-if="product.images != null" :src="product.images[0].src" />
                                <vs-avatar size="120px" color="primary" v-else icon="filter" />
                            </div>
                            <div class="col-md-4 t-margin">
                                <h4>{{product.title}}</h4>
                                <small>Sku: 29892</small>
                            </div>
                            <div class="col-md-2 t-margin">
                                <h5>Qty</h5>
                                <small>{{order.quantity}} {{order.valuation}}</small>
                            </div>
                            <div class="col-md-3 f-right t-margin"><strong>#{{order.price * order.quantity}}</strong></div>
                        </div>
                        <vs-divider/>
                        <div class="box-body row">

                            <vs-tabs vs-alignment="center">
                                <vs-tab vs-label="On Map">
                                    <iframe
                                            width="600"
                                            height="450"
                                            frameborder="0" style="border:0"
                                            :src="getMapView(order.destination)" allowfullscreen>
                                    </iframe>
                                </vs-tab>
                                <vs-tab vs-label="Directions">
                                    <iframe
                                            width="600"
                                            height="450"
                                            frameborder="0" style="border:0"
                                            :src="getMapDirections('hey')" allowfullscreen>
                                    </iframe>
                                </vs-tab>
                            </vs-tabs>



                        </div>
                    </div>

                </div>
                <div class="col-md-4 col detail-flow2">

                    <div class="box">
                        <div class="box-header">
                            <div class="box-header-title">
                                    <vs-avatar size="50px" color="primary" :text="order.buyer"/>
                            </div>

                            <div class="box-header-title2">
                                <h4>{{order.buyer}}</h4>
                            </div>

                        </div>

                        <div class="box-body row">
                            <h5>Customer Details</h5>
                            <br>
                            <a class="c-details">Osanmisola@gmail.com</a>
                            <a class="c-details">09069719689</a>
                            <a class="c-details">Nigeria</a>
                            <a class="c-details">Ogun State</a>
                            <a class="c-details">Ado-odo Ota</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="failed_to_load" v-if="failedToLoad==true" align="center">

            <vs-avatar size="200px" color="danger" icon="highlight_off" />
            <h4>Opps Something went Wrong</h4>


        </div>
    </div>
</template>

<style>

    .failed_to_load{
        width: 100%;
    }


    .c-details{
        color: #8399ec;
        font-size: 15px;
        cursor: pointer;
        display: block;
    }

    .t-margin{
        margin-top: 20px;
    }

    .f-right{
        float: right;
    }

    .box{
        width: 100%;
        background: #fff;
        border-radius: 20px;
    }

    .box .box-header .box-header-title{
        width: 30%;
        display: inline-block;
    }
    .box .box-header .box-header-tools{
        float: right;
        width: 60%;
        display: inline-block;
    }
    .box .box-header .box-header-title2{
        width: 50%;
        float: right;
        margin-top: 20px;
        margin-right: 50px;
        display: inline-block;
    }

    .header-fixed h1{
        display: inline-block;
        margin: 0 20px;
    }

    /*.header-fixed{
        position: fixed;
        top: 200px;
    }*/

    .body{
        margin: 50px 0;
    }
    .col{
        margin: 20px 0;

    }

    .badge{
        padding: 10px !important;
        background: red !important;
        color: white;
        border-radius: 20px !important;
        font-size: 14px !important;
        user-select: none;
    }


</style>

<script lang=js>
    export default{

        props:{
            order_id:{
                default: '',
                required: true
            }
        },

        created(){
            this.getOrder();
            this.getSupplier();
        },

        watch: {

            isLoading: function(val){
                if(val == true){
                    this.$vs.loading({
                        background:'rgba(131, 153, 236, 0.63)'
                    });
                }else {
                    this.$vs.loading.close();
                }
            }
        },

        data(){
            return {

                order: {
                    id : '',
                    order_id : "",
                    title : "",
                    price : "",
                    status : "",
                    buyer : "",
                    buyer_id : "",
                    destination : "",
                    quantity : '',
                    valuation : "",
                    product_id : "",
                    supplier_id : "",
                    token : "",
                    created_at : "",
                    updated_at : ""
                },
                baseUrl:this.$parent.$data.baseUrl,
                product: {
                    images:[]
                },
                supplier:{

                },
                isLoading: false,
                failedToLoad: false

            }
        },

        methods: {
            getMapView(place_id){
                return "https://www.google.com/maps/embed/v1/place?key=AIzaSyCoHhq-078QaLuiSUWMyBhT-DbXhHLHjwA&q="+ place_id
            },
            getMapDirections(destination){
                return "https://www.google.com/maps/embed/v1/directions?key=AIzaSyCoHhq-078QaLuiSUWMyBhT-DbXhHLHjwA&origin=Oslo+Norway &destination=Telemark+Norway"
            },

            getOrder(){
                this.isLoading = true;

                var self = this;

                axios.get(this.baseUrl+ '/allOrders/'+this.order_id+'?api_key=4ntbqhy2g0mc')
                        .then(function(response){
                            self.isLoading = false;

                            if(response.data.error == 0){
                                self.order = response.data.current_order;
                                self.product = response.data.product;
                            }else{
                                self.$vs.notify({
                                    title:'There is an error somewhere',
                                    text: 'unable to load correctly pleas try agian somtime',
                                    color: 'danger',
                                    icon: 'error'
                                });

                            }


                        })

            },
            getSupplier(){
                this.isLoading = true;
                var self = this;

                axios.get(this.baseUrl+ '/suppliers/YKgz2Y4?api_key=4ntbqhy2g0mc')
                        .then(function(response){
                            self.isLoading = false;

                            if(response.data.error == 0){
                                self.supplier = response.data.supplier;
                            }else {
                                self.failedToLoad = true;
                                self.$vs.notify({
                                    title:'There is an error somewhere',
                                    text: 'unable to load correctly pleas try agian somtime',
                                    color: 'danger',
                                    icon: 'error'
                                });


                            }
                        })
            },

            deliverOrder(){
                this.isLoading = true;
                const self = this;

                axios.get(this.baseUrl+ '/allOrders/'+self.order.order_id+'/deliver?api_key=4ntbqhy2g0mc')
                        .then(function(response){

                            self.isLoading = false;

                            if(response.data.error == 1){
                                self.$vs.notify({
                                    title:'There is an error somewhere',
                                    text: response.data.error_message,
                                    color: 'danger',
                                    icon: 'error'
                                });
                                return;
                            }

                            self.getOrder();

                            self.$vs.notify({
                                title:'Order Accepted',
                                text: 'Now We are waiting for customers to accept the terms',
                                color: 'success',
                                icon: 'success'
                            });

                        })

            }
        }

    }
</script>
