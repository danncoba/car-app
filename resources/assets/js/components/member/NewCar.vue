<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add new car</h2>
                </div>
            </div>
            <shared-links></shared-links>
            <div class="row">
                <div class="col-md-12">
                    <error-messages></error-messages>
                    <div v-if="success" class="alert alert-success">{{successMessage}}</div>
                    <form method="POST" @submit="createNewCar($event)" enctype="multipart/form-data" aria-label="Napravi">
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label text-md-right">Kategorija</label>

                            <div class="col-md-6">
                                <select id="category_id" v-model="car.category_id" class="form-control" name="category_id" required autofocus>
                                    <option v-for="category in categories" :value="category.id">{{category.ime}}</option>
                                </select>

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ime" class="col-sm-4 col-form-label text-md-right">Ime Auta</label>

                            <div class="col-md-6">
                                <input id="ime" type="text" v-model="car.ime" class="form-control" name="ime" required autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cena" class="col-sm-4 col-form-label text-md-right">Cena</label>

                            <div class="col-md-6">
                                <input id="cena" type="number" v-model="car.cena" class="form-control" name="cena"  required autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="godiste" class="col-sm-4 col-form-label text-md-right">Godiste</label>

                            <div class="col-md-6">
                                <input id="godiste" type="number" v-model="car.godiste" class="form-control" name="godiste" required autofocus>

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="opis" class="col-sm-4 col-form-label text-md-right">Opis</label>

                            <div class="col-md-6">
                                <textarea id="opis" v-model="car.opis" class="form-control" name="opis" autofocus></textarea>

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kilometraza" class="col-sm-4 col-form-label text-md-right">Kilometraza</label>

                            <div class="col-md-6">
                                <input id="kilometraza" v-model="car.kilometraza" type="number" class="form-control" name="kilometraza" required autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slika"  class="col-sm-4 col-form-label text-md-right">Slika</label>

                            <div class="col-md-6">
                                <div v-if="!image">
                                    <h2>Select an image</h2>
                                    <input type="file" @change="onFileChange">
                                </div>
                                <div v-else>
                                    <img :src="image" width="100" />
                                    <button @click="removeImage">Remove image</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Napravi Auto
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
import SharedLinks from './SharedLinks'
import ErrorHandler from '../../errorHandler'
import ErrorMessages from '../shared/ErrorMessages'
export default {
    name: 'NewCar',
    components: {
        'shared-links': SharedLinks,
        'error-messages': ErrorMessages
    },
    mounted() {
        self = this;
        $.ajax({
            method: 'GET',
            url: '/member/cars/new',
            success: function(response) {
                self.categories = response;
            },
            error: function(err){
                ErrorHandler.displayErrors(err);
            }
        });
    },
    data: function(){
        return{
            car: {

            },
            categories: [],
            image: '',
            allFiles: [],
            success: false,
            successMessage: ''
        }
    },
    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.allFiles = files;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
        },
        createNewCar: function(ev){
            var self = this;
            ev.preventDefault();
            if(self.allFiles.length > 0){
                self.uploadFile(function(imageUrl){
                    self.createCarOnBackend(imageUrl);
                });
            }else{
                self.createCarOnBackend();
            }
        },
        createCarOnBackend(image = "/uploads/logos/avatar.jpg"){
            self.car.slika = image
            $.ajax({
                method: 'POST',
                url: '/member/cars',
                headers: {
                    'X-CSRF-TOKEN': Laravel.csrfToken
                },
                data: self.car,
                success: function(response) {
                    self.success = true
                    self.successMessage = 'Uspijesno napravljen auto'
                },
                error: function(err){
                    ErrorHandler.displayErrors(err);
                }
            });
        },
        uploadFile(success){
            var self = this;
            if (!self.allFiles.length){
                return
            }
            var data = new FormData();
            data.append('slika', self.allFiles[0]);
            $.ajax({
                method: 'POST',
                url: '/member/upload',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': Laravel.csrfToken
                },
                data: data,
                success: function(response) {
                    success(response);
                },
                error: function(err){
                    ErrorHandler.displayErrors(err);
                }
            });
        }
    }
}
</script>
