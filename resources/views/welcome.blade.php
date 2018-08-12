@extends('layout')

@section('content')
    <section id="about">
        <div class="container">

            <header class="section-header">
                <h3>Pretrazite auta</h3>
                <p>
                    Pretrazite auto koje vam odgovara
                    <br>
                    <br>
                    <select name="kategorije_auta" id="kategorije_auta">
                        <option value="">Izaberite marku automobile</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->ime}}</option>
                        @endforeach
                    </select>
                </p>
            </header>

            <div class="row about-cols">
                @foreach($cars as $car)
                    <div class="col-md-4 wow">
                        <div class="about-col">
                            <div class="img">
                                <img src="/uploads/logos/{{$car->slika}}" alt="" class="img-fluid">
                                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">{{$car->ime}}</a></h2>
                            {{--<p>--}}
                                {{--Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--}}
                            {{--</p>--}}
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section><!-- #about -->
@endsection
