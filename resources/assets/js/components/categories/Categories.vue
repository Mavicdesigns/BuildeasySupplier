<template>

    <div class="m form-check" style="margin: 30px 0">
        <div class="" v-if="categories.length > 0">

            <div class="checkbox" v-for="(category, index) in categories">
                <label for="checkbox1" class="form-check-label ">
                    <input type="checkbox" id="checkbox1" name="checkbox1" :value="name" class="form-check-input">{{category.name}}
                </label>
            </div>


        </div>


        <div class="checkbox form-box" id="inputCat">

            <div class="form-group form-big">
                <input type="checkbox" id="checkbox3" name="checkbox1" value="Interior" class="form-check-input">
                <input type="text" id="title"  v-model="category.name" style="width: 60%" class="form-control" placeholder="Add a product name">
                <button class="btn btn-round" style="display: inline" @click="addCategory">add </button>

            </div>

        </div>

    </div>







</template>

<script>



    export default {

        data(){
            return {

              category : {
                    name : '',
                    category_id: '',
                    id: ''
                },
                categories:[],
                success: ''
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
                    self.categories.push(response.data.newCategory)

                    alert(self.success);

                        },function(error){

                        });

            },
            reset(){
                this.category.name = '';
            }
        }
    }
</script>