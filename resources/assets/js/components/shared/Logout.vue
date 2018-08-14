<template>
    <h1>{{message}}</h1>
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
