<template>
    <div>
        <section v-if="loaded">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Dashboard</h1>
                    </div>
                    <shared-links></shared-links>
                    <div class="col-md-12">
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
                                        <a v-if="car.odobren !== 1" href="#" @click="approveCategory($event, car.id, index)">Odobri</a>
                                        <span v-if="car.odobren" style="color: green;">Odobren</span>
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
        <section v-if="!loaded">
            <div class="col-md-12 wow">
                <div class="main-app-loader">
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import SharedLinks from './admin/SharedLinks.vue'
    export default {
        name: "Dashboard",
        components: {
            'shared-links': SharedLinks,
        },
        mounted() {
            this.getCars()
        },
        methods: {
            approveCategory: function(ev, id, index){
                ev.preventDefault();
                console.log("Odobri auto sa id: ", id);
                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken
                    },
                    url: `dashboard/cars/approve/${id}`,
                    success: function(response) {
                        self.cars[index].odobren = 1;
                    },
                    error: function(err){
                        console.log("Error odobravanja, ", err);
                    }
                });
            },
            getCars() {
                self = this
                $.ajax({
                    method: 'GET',
                    url: `api/dashboard?page=${self.page}`,
                    success: function(response) {
                        self.cars = response.cars
                        self.pageCount = Math.ceil(response.count / 20)
                        self.loaded = true
                        console.log("Response: ", response);
                    },
                    error: function(err){
                        if(err.status === 401){
                            self.$router.push('/login')
                        }
                        console.log('Error', err);
                    }
                });
            },
            setPage(page) {
                this.page = page
                this.getCars()
            }
        },
        data: function(){
            return{
                cars: [],
                loaded: false,
                page: 1,
                pageCount: 0
            }
        }
    }
</script>
