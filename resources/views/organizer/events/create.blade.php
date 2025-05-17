@extends('layouts.main')

@section('content')
<div class="container">
    <h1>{{ isset($event) ? 'Edit' : 'Create' }} Event</h1>

    <form method="POST"
          action="{{ route('organizer.events.store') }}"
          enctype="multipart/form-data">
        @csrf
        @isset($event) @method('PUT') @endisset

        <div class="mb-3">
            <label for="name" class="form-label">Event Title</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $event->name ?? '') }}" required>
             @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sport" class="form-label">Sport</label>
            <select name="sport" id="sport" class="form-select" required>
                <option value="">Select a Sport</option>
                @foreach(App\Models\EventSportif::SPORTS as $sport)
                    <option value="{{ $sport }}"
                        {{ old('sport') == $sport ? 'selected' : '' }}>
                        {{ ucfirst($sport) }}
                    </option>
                @endforeach
            </select>
            @error('sport')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>
                {{ old('description', $event->description ?? '') }}
            </textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date Range -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date*</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date*</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                       id="end_date" name="end_date" value="{{ old('end_date') }}" required
                       min="{{ old('start_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="{{ old('location', $event->location ?? '') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="logo" class="form-label">Event Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                @isset($event->logo)
                <div class="mt-2">
                    <img src="{{ Storage::url($event->logo->path) }}" width="100" class="img-thumbnail">
                </div>
                @endisset
            </div>
            <div class="col-md-6 mb-3">
                <label for="poster" class="form-label">Event Poster</label>
                <input type="file" class="form-control" id="poster" name="poster">
                @isset($event->poster)
                <div class="mt-2">
                    <img src="{{ Storage::url($event->poster->path) }}" width="100" class="img-thumbnail">
                </div>
                @endisset
            </div>
        </div>

        <!-- Status (Enum) -->
        <div class="mb-3">
            <label for="status" class="form-label">Status*</label>
            <select class="form-select @error('status') is-invalid @enderror"
                    id="status" name="status" required>
                @foreach(['open', 'closed', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($event) ? 'Update' : 'Create' }} Event
        </button>
    </form>
</div>
@endsection
