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
                    <error-messages></error-messages>
                    <table class="table">
                        <thead>
                            <th>Ime</th>
                            <th>Akcije</th>
                        </thead>
                        <tbody>
                            <tr v-for="(category, index) in categories">
                                <td>{{category.ime}}</td>
                                <td width="200">
                                    <router-link :to="'/categories/'+ category.id">Edit</router-link>
                                    <a href="#" @click="deleteCategory(category.id, index, $event)">Delete</a>
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
    import ErrorHandler from '../errorHandler'
    import ErrorMessages from './shared/ErrorMessages'
    export default {
        name: "Categories",
        components: {
            'shared-links': SharedLinks,
            'error-messages': ErrorMessages
        },
        mounted() {
            var self = this;
            $.ajax({
                    method: 'GET',
                    url: '/api/dashboard/categories',
                    success: function(response) {
                        self.categories = response
                        self.loaded = true;
                    },
                    error: function(err){
                        ErrorHandler.displayErrors(err)
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
            deleteCategory: function(categoryId, index, ev){
                let self = this;
                ev.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: `/api/dashboard/categories/${categoryId}/delete`,
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken
                    },
                    success: function(response) {
                        var r = confirm("Do you want to delete this category?");
                        if (r == true) {
                            self.categories.splice(index, 1)
                        }
                    },
                    error: function(err){
                        ErrorHandler.displayErrors(err)
                    }
                });
            }
        }
    }
</script>

