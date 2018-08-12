@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add new car</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('member_create_car') }}" aria-label="{{ __('Create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label text-md-right">{{ __('Kategorija') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" value="{{ old('category_id') }}" required autofocus>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->ime}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ime" class="col-sm-4 col-form-label text-md-right">{{ __('Ime Auta') }}</label>

                            <div class="col-md-6">
                                <input id="ime" type="text" class="form-control{{ $errors->has('ime') ? ' is-invalid' : '' }}" name="ime" value="{{ old('ime') }}" required autofocus>

                                @if ($errors->has('ime'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cena" class="col-sm-4 col-form-label text-md-right">{{ __('Cena') }}</label>

                            <div class="col-md-6">
                                <input id="cena" type="number" class="form-control{{ $errors->has('cena') ? ' is-invalid' : '' }}" name="cena" value="{{ old('cena') }}" required autofocus>

                                @if ($errors->has('cena'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cena') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="godiste" class="col-sm-4 col-form-label text-md-right">{{ __('Godiste') }}</label>

                            <div class="col-md-6">
                                <input id="godiste" type="number" class="form-control{{ $errors->has('godiste') ? ' is-invalid' : '' }}" name="godiste" value="{{ old('godiste') }}" required autofocus>

                                @if ($errors->has('godiste'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('godiste') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="opis" class="col-sm-4 col-form-label text-md-right">{{ __('Opis') }}</label>

                            <div class="col-md-6">
                                <textarea id="opis" class="form-control{{ $errors->has('opis') ? ' is-invalid' : '' }}" name="opis" value="{{ old('opis') }}" autofocus></textarea>

                                @if ($errors->has('opis'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('opis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kilometraza" class="col-sm-4 col-form-label text-md-right">{{ __('Kilometraza') }}</label>

                            <div class="col-md-6">
                                <input id="kilometraza" type="number" class="form-control{{ $errors->has('kilometraza') ? ' is-invalid' : '' }}" name="kilometraza" value="{{ old('kilometraza') }}" required autofocus>

                                @if ($errors->has('kilometraza'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kilometraza') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slika" class="col-sm-4 col-form-label text-md-right">{{ __('Slika') }}</label>

                            <div class="col-md-6">
                                <input id="slika" type="file" class="form-control{{ $errors->has('slika') ? ' is-invalid' : '' }}" name="slika" value="{{ old('slika') }}" autofocus>

                                @if ($errors->has('slika'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('slika') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Auto') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
