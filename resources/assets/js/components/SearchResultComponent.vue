<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h1 class="page-header">Virtual Shop</h1>
                    <br/>
                        <search-component @search="searchProduct"> </search-component> 

                        <div class="container">
                            <product-component 
                                v-for="product in products" 
                                :key="product.id"
                                :product="product"> 
                            </product-component>
                        </div>
                        <br/>

                        <nav>
                            <ul class="pagination justify-content-end">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link"  href="#" @click.prevent="changePage(pagination.current_page - 1, text)"><span>Back</span></a>
                                </li>

                                <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
                                    <a class="page-link"  href="#"  @click.prevent="changePage(page, text)">
                                        {{page}}
                                    </a>
                                </li>

                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link"  href="#" @click.prevent="changePage(pagination.current_page + 1, text)"><span>Next</span></a>
                                </li>
                            </ul>
                        </nav>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products: [],
                pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0,
                }, 
                offset: 3,
                text:'', 
                
            }
        },

        created(page) {
            console.log('Component created.')
            axios.get('index?page=' + 1).then((response) => {
                this.products   = response.data.products.data;
                this.pagination = response.data.pagination;
            });
        },


        mounted() {
            console.log('Component mounted.')
            
        },

        computed: {
            isActived: function(){
                return this.pagination.current_page;
            },
            
            pagesNumber: function (){
               
                if(!this.pagination.to)
                    return[];
                
                var from = this.pagination.current_page - this.offset;

                if (from < 1) 
                    from = 1
                
                
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page)
                    to = this.pagination.last_page;
                
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }

        },

        methods:{
            getProducts(page){
                axios.get('index?page='+page).then((response) => {
                    this.products   = response.data.products.data;
                    this.pagination = response.data.pagination;
                });
            }, 

            searchProduct(page, text){
                this.text = text;

                if(page === undefined || page === null || page === '' )
                    page = 3;

                axios.get('searchProduct?page=' + page + '&text=' + text).then((response) => {
                    this.products   = response.data.products.data;
                    this.pagination = response.data.pagination;
                });
            },

            changePage(page, text){
                this.pagination.current_page = page;

                if(text === undefined || text === null || text === '' )
                    this.getProducts(page);
                else 
                    this.searchProduct(page, text)
            }, 

        }
    }
</script>
