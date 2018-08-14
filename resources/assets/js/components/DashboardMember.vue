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
                                <td><img width="50" :src="car.slika" /></td>
                                <td>{{car.ime}}</td>
                                <td>{{car.kilometraza}}</td>
                                <td>{{car.cena}}</td>
                                <td width="200">
                                    <router-link :to="'/cars/'+ car.id">Edit</router-link>
                                    <a href="#" @click="deleteCar($event, car.id)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import SharedLinks from './member/SharedLinks';
    export default {
        name: "DashboardMember",
        components: {
            'shared-links': SharedLinks
        },
        mounted() {
            self = this
            $.ajax({
                    method: 'GET',
                    url: 'member/dashboard',
                    success: function(response) {
                        self.loaded = true;
                        console.log("Response: ", response);
                        self.cars = response
                    },
                    error: function(err){
                        console.log('Error', err);
                    }
                });
        },
        data: function(){
            return{
                cars: [],
                loaded: false
            }
        },
        methods: {
            deleteCar: function(ev, id){
                ev.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: `/member/cars/${id}/delete`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(err){
                        console.log('Error', err);
                    }
                });
            }
        }
    }
</script>
