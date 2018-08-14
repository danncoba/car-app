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
export default {
    name: 'EditCategory',
    components: {
        'shared-links': SharedLinks
    },
    data: function(){
        return{
            category: {}
        }
    },
    created() {
        self = this
        $.ajax({
            method: 'GET',
            url: `/api/dashboard/categories/${this.$route.params.id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                self.category = response
            },
            error: function(err){
                console.log('Error', err);
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
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
