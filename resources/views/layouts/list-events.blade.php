<div class="container-fluid m-3">
    <div class="row row-cols-3 row-cols-md-4 row-cols-sm-12 d-flex justify-content-around gy-4 ">
        @foreach ($eventSportifs as $eventSportif)
            <div class="card col m-b-2" style="width: 18rem;">
                <img src="{{$eventSportif->poster->url}}" class="card-img-top" width="200" height="200" alt="{{$eventSportif->nom}}">
                <div class="card-body">
                    <h5 class="card-title">{{$eventSportif->nom}}</h5>
                    <p class="card-text">{{$eventSportif->description}}</p>
                {{-- a href="{{route('events.show',[$eventSportif])}}" class="btn btn-primary">Détails</a>--}}
                </div>
                <div class="card-footer">
                    <a href="{{route('eventSportifs.show',[$eventSportif])}}" class="btn btn-primary">Détails</a>
                    @if(auth()->user() && auth()->user()->isOrganizer())
                        <a href="{{route('organizer.events.edit',[$eventSportif])}}" class="btn btn-warning">Modifier</a>
                    @endif
                </div>
            </div>

        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">

        {{ $eventSportifs->links() }}
    </div>

</div>
