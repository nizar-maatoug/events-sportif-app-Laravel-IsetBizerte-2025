@extends('layouts.main')
@section('content')
   <h2>Organizer Dashboard</h2>
   <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">
            Create New Event
    </a>
   @include('layouts.list-events')
@endsection
