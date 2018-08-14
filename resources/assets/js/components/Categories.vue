<template>
    <section>
        <div class="container" v-if="loaded">
            <div class="row">
                <div class="col-md-12">
                    <h2>All categories</h2>
                </div>
            </div>
            <shared-links></shared-links>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Ime</th>
                            <th>Akcije</th>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories">
                                <td>{{category.ime}}</td>
                                <td width="200">
                                    <router-link :to="'/categories/'+ category.id">Edit</router-link>
                                    <a href="#" @click="deleteCategory(category.id, $event)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container" v-if="!loaded">
            <div class="col-md-12 wow">
                <div class="main-app-loader">
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import SharedLinks from './admin/SharedLinks.vue'
    export default {
        name: "Categories",
        components: {
            'shared-links': SharedLinks,
        },
        mounted() {
            var self = this;
            $.ajax({
                    method: 'GET',
                    url: '/api/dashboard/categories',
                    success: function(response) {
                        self.categories = response
                        self.loaded = true;
                        console.log("Response: ", response);
                    },
                    error: function(err){
                        console.log('Error', err);
                    }
                });
        },

        data: function(){
            return{
                categories: [],
                loaded: false
            }
        },

        methods: {
            deleteCategory: function(categoryId, ev){
                ev.preventDefault();
                console.log("Category id: ", categoryId);
                $.ajax({
                    method: 'POST',
                    url: `/api/dashboard/categories/${categoryId}/delete`,
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
                // /api/dashboard/categories/{category}/delete
            }
        }
    }
</script>

