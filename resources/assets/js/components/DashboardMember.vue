<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Sva auta</h2>
                </div>
            </div>
            <shared-links></shared-links>
            <div class="row">
                <div class="col-md-12">
                    <error-messages></error-messages>
                    <div v-if="success" class="alert alert-success">{{successMessage}}</div>
                    <table class="table">
                        <thead>
                            <th>Slika</th>
                            <th>Ime</th>
                            <th>Kilometraza</th>
                            <th>Cena</th>
                            <th>Akcije</th>
                        </thead>
                        <tbody>
                            <tr v-for="(car, index) in cars">
                                <td><img width="50" :src="car.slika" /></td>
                                <td>{{car.ime}}</td>
                                <td>{{car.kilometraza}}</td>
                                <td>{{car.cena}}</td>
                                <td width="200">
                                    <router-link :to="'/cars/'+ car.id">Edit</router-link>
                                    <a href="#" @click="deleteCar($event, index, car.id)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        </div>
    </section>
</template>

<script>
    import SharedLinks from './member/SharedLinks';
    import ErrorHandler from '../errorHandler'
    import ErrorMessages from './shared/ErrorMessages'
    export default {
        name: "DashboardMember",
        components: {
            'shared-links': SharedLinks,
            'error-messages': ErrorMessages
        },
        mounted() {
            this.getMemberCars()
        },
        data: function(){
            return{
                cars: [],
                loaded: false,
                success: false,
                successMessage: '',
                page: 1,
                pageCount: 0
            }
        },
        methods: {
            getMemberCars(){
                let self = this
                $.ajax({
                    method: 'GET',
                    url: `member/dashboard?page=${self.page}`,
                    success: function(response) {
                        self.loaded = true;
                        self.cars = response.cars
                        self.pageCount = Math.ceil(response.count / 20)
                    },
                    error: function(err){
                        console.log('Error', err);
                    }
                });
            },
            setPage(page){
                this.page = page
                this.getMemberCars()
            },
            deleteCar: function(ev, index, id){
                let self = this;
                ev.preventDefault();
                var r = confirm("Do you want to delete this category?");
                if (r == true) {
                    $.ajax({
                        method: 'POST',
                        url: `/member/cars/${id}/delete`,
                        headers: {
                            'X-CSRF-TOKEN': Laravel.csrfToken
                        },
                        success: function(response) {
                            self.cars.splice(index, 1)
                        },
                        error: function(err){
                            ErrorHandler.displayErrors(err);
                        }
                    });
                }
            }
        }
    }
</script>
