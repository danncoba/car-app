<template>
    <div v-if="display">
        <div class="alert alert-danger">
            {{message}}
        </div>
    </div>
</template>
<script>
export default {
    name: 'ErrorMessages',
    data: function(){
        return{
            display: false,
            message: ''
        }
    },
    mounted() {
        let self = this;
        Event.vue.$on('errorMessages', (message) => {
            let messages = message.join(' ')
            self.display = true
            self.message = messages
            setTimeout(()=>{
                self.display = false
            }, 3000)
        });
    }
}
</script>
