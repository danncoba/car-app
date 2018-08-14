<template>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <div class="alert alert-success" v-if="succesfullLogin">
                                {{message}}
                            </div>
                            <error-messages></error-messages>
                            <form method="POST" action="" aria-label="Login">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" v-model="email" class="form-control" name="email" value="" required autofocus>
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" :type="'password'" v-model="password" class="form-control" name="password" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" :disabled="buttonDisabled" v-on:click="loginUser($event)" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import ErrorHandler from '../errorHandler'
    import ErrorMessages from './shared/ErrorMessages';
    export default {
        name: "Login",
        components: {
            'error-messages': ErrorMessages
        },
        data: function(){
            return{
                email: '',
                password: '',
                buttonDisabled: false,
                succesfullLogin: false,
                errorLogin: false,
                message: ''
            }
        },
        methods: {
            loginUser: function(ev) {
                ev.preventDefault();
                var self = this;
                self.buttonDisabled = true;
                var data = {
                    email: this.email,
                    password: this.password
                }
                $.ajax({
                    method: 'POST',
                    url: 'api/login',
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken
                    },
                    data: data,
                    success: function(response, status, request) {
                        self.buttonDisabled = false
                        self.succesfullLogin = true
                        self.message = "Successfully logged in. Redirecting to your dashboard"
                        setTimeout(function(){
                            if(response.type === 'admin') {
                                self.$router.push('/dashboard');
                            }else if(response.type === 'member') {
                                self.$router.push('dashboard-member')
                            }
                        }, 1500);
                    },
                    error: function(err){
                        self.buttonDisabled = false
                        ErrorHandler.displayErrors(err);
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
