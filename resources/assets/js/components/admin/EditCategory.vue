<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Update kategoriju: {{category.ime}}</h2>
                </div>
            </div>
            <shared-links></shared-links>
            <div class="row">
                <div class="col-md-12">
                    <error-messages></error-messages>
                    <div v-if="success" class="alert alert-success">{{successMessage}}</div>
                    <form method="POST" action="" v-on:submit="updateCategory($event)">
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Ime Kategorije</label>
                            <div class="col-md-6">
                                <input id="ime" type="text" class="form-control"  name="ime" v-model="category.ime" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Azuriraj Kategoriju
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import SharedLinks from './SharedLinks.vue'
import ErrorHandler from '../../errorHandler'
import ErrorMessages from '../shared/ErrorMessages';
export default {
    name: 'EditCategory',
    components: {
        'shared-links': SharedLinks,
        'error-messages': ErrorMessages
    },
    data: function(){
        return{
            category: {},
            success: false,
            successMessage: ''
        }
    },
    created() {
        self = this
        $.ajax({
            method: 'GET',
            url: `/api/dashboard/categories/${this.$route.params.id}`,
            headers: {
                'X-CSRF-TOKEN': Laravel.csrfToken
            },
            success: function(response) {
                self.category = response
            },
            error: function(err){
                ErrorHandler.displayErrors(err);
            }
        });
    },
    methods: {
        updateCategory: function(ev){
            ev.preventDefault();
            var data = {
                ime: this.category.ime
            };
            $.ajax({
                method: 'POST',
                url: `/api/dashboard/categories/${self.category.id}/update`,
                headers: {
                    'X-CSRF-TOKEN': Laravel.csrfToken
                },
                data: data,
                success: function(response) {
                    self.success = true
                    self.successMessage = 'Successfully updated category'
                },
                error: function(err){
                    ErrorHandler.displayErrors(err);
                }
            });
        }
    }
}
</script>
