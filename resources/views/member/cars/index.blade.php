@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Sva auta</h2>
                </div>
            </div>
            @include('member_partials.links')
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Slika</th>
                            <th>Ime</th>
                            <th>Kilometraza</th>
                            <th>Cena</th>
                            <th>Akcije</th>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td><img width="50" height="50" src="/uploads/logos/{{$car->slika}}" /></td>
                                <td>{{$car->ime}}</td>
                                <td>{{$car->kilometraza}}</td>
                                <td>{{$car->cena}}</td>
                                <td width="200">
                                    <a href="/member/cars/{{$car->id}}">Edit</a>
                                    <form method="POST" action="{{ route('member_delete_car', ['car' => $car->id]) }}">
                                        @csrf
                                        <a href="javascript:;" onclick="parentNode.submit();">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
