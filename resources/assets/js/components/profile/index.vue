<template>

    <div style="position: relative">
        <div class="" >
            <div class="header-fixed">
                <h1>{{username}}</h1>
              </div>

            <div class="row body">

                <div class="col-md-8 col detail-flow">

                    <div class="box ">

                        <div class="box-body row">
                            <vs-col vs-w="3">
                                <vs-avatar size="120px"  src="http://localhost/supplier.buildeasy/public/images/icon/avatar-big-01.jpg" />
                            </vs-col>
                            <vs-col vs-w="8">
                                <br>
                                <h4>Anjola Olurin</h4>
                                <small class="badge">Active</small>
                                <p>coreUI ut CoreUI is not just another Admin Template. It goes way beyond hitherto admin templat</p>
                            </vs-col>

                        </div>
                        <vs-divider/>
                    </div>
                    <div class="box row">
                        <div class="box-header">
                            <div class="box-header-title">
                                <h4>Profile Details</h4>
                            </div>
                        </div>

                        <div class="box-body row">

                            <vs-row>
                                <vs-col vs-w="6">
                                    <vs-input style="width: 90%" size="large" label-placeholder="Company Name" v-model="profile.title"></vs-input>
                                </vs-col>

                                <vs-col vs-w="6">
                                    <vs-input style="width: 90%" size="large" label-placeholder="Email Address" v-model="profile.email"></vs-input>
                                </vs-col>
                            </vs-row>

                            <vs-row>
                                <vs-col vs-w="6">
                                    <vs-input style="width: 90%" size="large" label-placeholder="Company Name" v-model="profile.title"></vs-input>
                                </vs-col>

                                <vs-col vs-w="6">
                                    <vs-input style="width: 90%" size="large" label-placeholder="Email Address" v-model="profile.email"></vs-input>
                                </vs-col>
                            </vs-row>

                        </div>

                    </div>

                </div>
                <div class="col-md-4 col detail-flow2">

                    <div class="box">
                        <div class="box-header">
                            <div class="box-header-title">
                                <vs-avatar size="50px" color="primary" text="order.buyer"/>
                            </div>

                            <div class="box-header-title2">
                                <h4></h4>
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


    </div>

</template>

<script>

    export default {
        props:{
            user_id:{

            },
            username:{

            }
        },

        data(){
            return{
                profile: {
                    title: 'Anjola Olurin',
                    email: 'Osanmisola@gmail.com'
                }
            }
        }
    }

</script>