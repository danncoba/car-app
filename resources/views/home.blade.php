@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @include('partials.admin')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
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
                                    @if($car->odobren === 0)
                                    <form method="POST" action="{{ route('approve_car', ['car' => $car->id]) }}">
                                        @csrf
                                        <a href="javascript:;" onclick="parentNode.submit();">Odobri</a>
                                    </form>
                                    @else
                                        <span style="color:green;">Odobren</span>
                                    @endif
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
