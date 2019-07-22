<template>
    <div class="product-info-box box">

        <div class="box-header">
            <h3>Product Info</h3>
        </div>

        <div class="box-body form-box row">

            <h5>Basic Info</h5>


            <div class="m" style="margin: 30px 0" >

                <div class="form-group form-big">
                    <label for="title">Name</label>
                    <input type="text" v-model="product_title" class="form-control " placeholder="Add a product name">
                </div>

                <div class="form-group form-small">
                    <label for="title">Ribbons</label>
                    <input type="text" id="title" class="form-control ">
                </div>

                <div class="form-group form-small">
                    <label for="title">Price</label>
                    <input type="text" id="title" class="form-control " placeholder="#1000">
                </div>
                <br>

                <div class="form-group form-full">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" cols="12" rows="5"></textarea>
                </div>

            </div>


        </div>

    </div>
</template>

<script lang="js">
    export default  {
        name: 'productInfo',
        props: [],
        mounted() {
            alert("mounted")
        },
        data() {
            return {
                product_title:this.$parent.$data.productTitle
            }
        },
        methods: {

        },
        computed: {

        }
    }
</script>
