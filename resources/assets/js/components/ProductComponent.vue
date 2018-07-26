<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            
                        <br/>
                <div class="card">
                    <div class="card-header">{{product.name}}</div>
                        <p> Description: {{product.description}} </p>
                        <p> Score: {{product.score}} </p>
                        <p> Price: {{product.price}} </p>
                        <p> Category: {{product.category.name}} </p>
                        <p> Brand: {{product.brand.name}} </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'], 
        data(){
            return{
            }
        },

        mounted() {
            console.log('Component mounted.');
        }
    }
</script>
