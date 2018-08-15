<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h1>{{message}}</h1>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {
    name: 'Logout',
    mounted() {
        let self = this
        $.ajax({
            method: 'GET',
            url: '/api/logout',
            success: function(resp){
                self.message = "Successfully logged out"
                Event.vue.$emit('navigationUpdated', { type: 'ordinary' })
            },
            error: function(err){

            }
        })
    },
    data: function(){
        return {
            message: 'Logging out'
        }
    }
}
</script>
