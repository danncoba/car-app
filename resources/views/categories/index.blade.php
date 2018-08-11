@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All categories</h2>
                    @include('partials.admin')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Ime</th>
                            <th>Akcije</th>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->ime}}</td>
                                    <td width="200">
                                        <a href="{{route('edit_category', ['category'=> $category->id])}}">Edit</a>
                                        <form method="POST" action="{{ route('delete_category', ['category' => $category->id]) }}">
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
