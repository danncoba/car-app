@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Categories</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('create_category') }}" aria-label="{{ __('Create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Ime kategorije') }}</label>

                            <div class="col-md-6">
                                <input id="ime" type="text" class="form-control{{ $errors->has('ime') ? ' is-invalid' : '' }}" name="ime" value="{{ old('ime') }}" required autofocus>

                                @if ($errors->has('ime'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ime') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Category') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
