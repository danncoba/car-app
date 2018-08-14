<template>
    <section id="about">
        <div class="container">
            <cars-header @categoryChanged="categoryUpdated" :categories="categories"></cars-header>
            <!--<modal></modal>-->
            <div class="row about-cols">
                <div class="col-md-4 wow" v-for="car in cars">
                    <car v-bind:car="car"></car>
                </div>
            </div>
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
                elementsLoaded: false
            }
        },
        methods: {
            fetchCars(){
                self = this;
                fetch('/api/cars').then(function(response){
                    return response.json()
                }).then(function(res){
                    self.cars = res.cars;
                    self.categories = res.categories;
                    self.elementsLoaded = true;
                }).catch(function(err){
                    console.log(err);
                })
            },

            categoryUpdated(id){
                console.log('This is called');
                console.log('Id updated: ', id);
            },

            updateCategorySearch(newCategory) {
                if(newCategory === '') {
                    this.fetchCars();
                    return;
                }
                let self = this;
                fetch('/api/cars/search/' + newCategory).then(function(response){
                    return response.json()
                }).then(function(res){
                    self.cars = res;
                }).catch(function(err){
                    console.log(err);
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
