@foreach($cars as $car)
    <div class="col-md-4 wow">
        <div class="about-col">
            <div class="img">
                <img src="/uploads/logos/{{$car->slika}}" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            </div>
            <h2 class="title"><a href="#">{{$car->ime}}</a></h2>
        </div>
    </div>
@endforeach

