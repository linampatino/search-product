<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div >
                    <div class="card-header">Search Porduts</div>

                    <div class="card-body">
                        
                        <form class="form-inline" action="" v-on:submit.prevent="search()">
                           
                                <label class=" mb-2 mr-sm-2" for="buscar">Search: </label>
                                
                                    <input class="form-control mb-2 mr-sm-2" type="text" name="text" id="text" v-model="text">
                                    <button class="btn btn-success btn-addon mb-2 mr-sm-2" type="submit">Search  <i class="fa fa-search"></i>  </button> 
                                                        
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                text:''
            }
        },

        mounted() {
            console.log('Component mounted.');           
        }, 
        methods:{
            search(){
                this.$emit('search', 1, this.text);
            }
        }
    }
</script>
