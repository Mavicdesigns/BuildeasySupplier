<template lang="html">
    <header class="header" >

        <div class="breadcrumbs">
            <h5 class="d-inline">Products</h5>
            <h5 class="d-inline"> > </h5>
            <h5 class="d-inline">{{product_title}}</h5>
        </div>
        <div class="header-title col-lg-9">

            <input type="text" class="header-product-title form-control" v-model="product_title" >

        </div>
        <div class="header-navs col-lg-3">
            <button type="submit"  class="btn btn-danger btn-cancel">Cancel</button>
            <button type="submit"  class="btn btn-danger btn-submit">Save</button>
        </div>


    </header>

</template>

<script lang="js">
  export default  {
    name: 'create-product-header',
    props: [],
    mounted() {

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

<style scoped lang="scss">
  .create-product-header {

  }
</style>
