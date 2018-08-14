<template>
    <div class="about-col" @click="displayCar">
        <div class="img">
            <img :src="car.slika" alt="" class="img-fluid">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
        </div>
        <h2 class="title"><a href="#">{{car.ime}}</a></h2>
        <p>
            <span>Cena: </span>
            {{car.cena}}
        </p>
    </div>
</template>

<script>
    export default {
        name: "Car",
        props: {
            car: {default: {}}
        },
        methods: {
            displayCar: function() {
                console.log('Clicked and opening element');
            }
        }
    }
</script>

<style scoped>

</style>
