@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Album Reports</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Total Albums</div>
                    <div class="card-body">
                        {{ $totalAlbums }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Average Album Rating</div>
                    <div class="card-body">
                        {{ $averageAlbumRating }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Albums by Format</div>
                    <div class="card-body">
                         <ul>
                            @foreach($albumsByFormat as $format => $count)
                                <li>{{ ucfirst($format) }}: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection