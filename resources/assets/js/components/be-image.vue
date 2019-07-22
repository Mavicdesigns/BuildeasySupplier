<template lang="html">

    <div>

    <div class="imag-box" v-for="(image,index) in dataImages">

        <div class="overlay table-data-feature">
            <vs-dropdown class="drop-button"  vs-custom-content vs-trigger-click >
                <a class="item" data-toggle="tooltip" data-placement="top" title="More">
                    <i class="zmdi zmdi-more"></i>
                </a>

                <vs-dropdown-menu >

                    <vs-dropdown-item @click="deleteImage(image)">Remove</vs-dropdown-item>



                </vs-dropdown-menu>
            </vs-dropdown>
        </div>

        <div class="imag-container">
            <img :src="image.src" width="100%">



        </div>
    </div>


    </div>

    </div>
</template>

<style>

    .overlay{
        position: absolute;
        width:100%;
        height: 100%;
        top:0;
        z-index: 1;
        opacity: 0;
        right: 0;
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
        background: rgba(0, 0, 0, 0.51);
    }
    .overlay .drop-button{
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .imag-box{
        display: inline-block;
        position: relative;
        padding: 10px;
        margin:10px;
        border-radius: 10px;
        border: 1px solid #ddd;
        overflow: hidden;

    }

    .imag-container{
        width: 150px;
        height: 150px;

    }


    .imag-box:hover img{
        -webkit-transform: scale(1);
        transform: scale(1);

    }
    .imag-box:hover .overlay{
        opacity: 1;

    }

    .imag-container img{
        width: 100%; /* or any custom size */
        height: 100%;
        object-fit: cover;
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }

</style>

<script lang="js">


    export default{

        props:{
            dataImages:{
                default: []
            },
            deleteFunction: {}
        },

        mounted(){

        },

        data(){
            return {
            }
        },

        methods:{
            deleteImage(event){
                this.dataImages.splice(this.dataImages.indexOf(event),1);
            }
        }

    }

</script>