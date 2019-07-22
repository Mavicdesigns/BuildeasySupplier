
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.css'
Vue.use(Vuesax);
import {status} from './status';

Vue.filter("status", status);



import VueSelectImage from 'vue-select-image'
// add stylesheet
require('vue-select-image/dist/vue-select-image.css');
Vue.use(VueSelectImage);
Vue.use(require('vue-moment'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('bu-upload-image', require('./components/bu-upload-image'));

Vue.component('categoriess', require('./components/productList.vue'),{});


Vue.component('Pcategorie', require('./components/profile/index.vue'),{});

Vue.component('categor', require('./components/Order-View.vue'),{

});


Vue.component('categori', require('./components/ordersList.vue'),{

});

Vue.component('categories', require('./components/CreateProductTemplate.vue'),{

});

Vue.component('categorie', require('./components/UpdateProductTemplate.vue'),{

});


const axios = require('axios');

var categoriesObj = {
    name:"hey",
    category_id:""
};

const app = new Vue({
    el: '#app',


    data:{
      productTitle: 'Untitled Product',
        product_id:''
    },

    created:function(){

    }
});
