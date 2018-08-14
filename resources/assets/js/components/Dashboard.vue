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
                                <tr v-for="car in cars">
                                    <td><img width="50" height="50" :src="car.slika" /></td>
                                    <td>{{car.ime}}</td>
                                    <td>{{car.kilometraza}}</td>
                                    <td>{{car.cena}}</td>
                                    <td width="200">
                                        <a v-if="car.odobren !== 1" href="#" @click="approveCategory($event, car.id)">Odobri</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
            self = this;
            $.ajax({
                method: 'GET',
                url: 'api/dashboard',
                success: function(response) {
                    self.cars = response
                    self.loaded = true;
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
        methods: {
            approveCategory: function(ev, id){
                ev.preventDefault();
                console.log("Odobri auto sa id: ", id);
                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `dashboard/cars/approve/${id}`,
                    success: function(response) {
                        console.log("Response: ", response);
                    },
                    error: function(err){
                        console.log("Error odobravanja, ", err);
                    }
                });
            }
        },
        data: function(){
            return{
                cars: [],
                loaded: false
            }
        }
    }
</script>
