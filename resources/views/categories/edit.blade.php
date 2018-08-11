@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Categories {{ $category->ime }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="/dashboard/categories/{{$category->id}}/update" aria-label="{{ __('Update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Ime kategorije') }}</label>

                            <div class="col-md-6">
                                <input id="ime" type="text" value="{{$category->ime}}" class="form-control{{ $errors->has('ime') ? ' is-invalid' : '' }}" name="ime" value="{{ old('ime') }}" required>

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
                                    {{ __('Update Category') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
