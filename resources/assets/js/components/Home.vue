<template>
    <section id="about">
        <div class="container">
            <cars-header @categoryChanged="categoryUpdated" :categories="categories"></cars-header>
            <!--<modal></modal>-->
            <div class="row about-cols" v-if="elementsLoaded">
                <div class="col-md-4 wow" v-for="car in cars">
                    <car v-bind:car="car"></car>
                </div>
            </div>
            <paginate
                    v-model="page"
                    :page-count="pageCount"
                    :click-handler="setPage"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :container-class="'pagination'"
                    :page-class="'page-item'"
                    :page-link-class="'page-link'"
                    :prev-class="'page-item'"
                    :prev-link-class="'page-link'"
                    :next-class="'page-item'"
                    :next-link-class="'page-link'">
                </paginate>
        </div>
        <div class="container" v-if="!elementsLoaded">
            <div class="col-md-12 wow">
                <div class="main-app-loader">
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

    import CarsHeader from './shared/CarsHeader';
    import Car from './shared/Car';
    import Modal from './shared/Modal'

    export default {
        name: 'Home',
        components: {
            'cars-header': CarsHeader,
            'car': Car,
            'modal': Modal
        },
        data: function(){
            return{
                cars: [],
                categories: [],
                elementsLoaded: false,
                page: 1,
                pageCount: 1
            }
        },
        methods: {
            fetchCars(){
                self = this;
                self.elementsLoaded = false;
                fetch(`/api/cars?page=${self.page}`).then(function(response){
                    return response.json()
                }).then(function(res){
                    self.cars = res.cars;
                    self.categories = res.categories;
                    self.pageCount = Math.ceil(res.count / 15)
                    self.elementsLoaded = true;
                }).catch(function(err){
                    console.log(err);
                })
            },
            setPage(page){
                console.log('page:', page)
                this.page = page
                this.fetchCars()
            },
            categoryUpdated(id){
                console.log('This is called');
                console.log('Id updated: ', id);
            },

            updateCategorySearch(newCategory) {
                this.elementsLoaded = false
                if(newCategory === '') {
                    this.fetchCars();
                    return;
                }else if(newCategory === '1') {
                    this.getExternal();
                    return;
                }
                let self = this;
                fetch('/api/cars/search/' + newCategory).then(function(response){
                    return response.json()
                }).then(function(res){
                    self.cars = res.cars
                    self.page = 1
                    self.pageCount = Math.ceil(res.count / 15)
                    self.elementsLoaded = true
                }).catch(function(err){
                    console.log(err);
                })
            },

            getExternal: function() {
                var self = this;
                $.ajax({
                    method: 'GET',
                    url: '/api/audi/fetch',
                    success: function(response){
                        self.cars = response
                        self.elementsLoaded = true
                    },
                    error: function(err){

                    }
                })
            }
        },
        mounted() {
            self = this;
            Event.vue.$on('categoryUpdated', function(value){
                self.updateCategorySearch(value);
            });
            this.fetchCars();
        }
    }
</script>
