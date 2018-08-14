<template>
    <header class="section-header">
        <h3>Pretrazite auta</h3>
        <p>
            Pretrazite auto koje vam odgovara
            <br>
            <br>
            <car-category-select :categories="categories"></car-category-select>
        </p>
    </header>
</template>

<script>

    import CarCategorySelect from './CarCategorySelect';

    export default {
        name: "CarsHeader",
        components: {'car-category-select': CarCategorySelect},
        props: {
            categories: {default: []}
        }
    }
</script>

<style scoped>

</style>
