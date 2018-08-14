<template>
    <select v-on:change="changedCategory($event)" name="kategorije_auta" id="kategorije_auta">
        <option value="">Izaberite marku automobile</option>
        <option v-for="category in categories" v-bind:value="category.id">{{category.ime}}</option>
    </select>
</template>

<script>
    export default {
        name: "CarCategorySelect",
        props: {
            categories: {default: []}
        },
        methods: {
            changedCategory: function(ev){
                Event.vue.$emit('categoryUpdated', ev.target.value);
            }
        }
    }
</script>

<style scoped>

</style>
