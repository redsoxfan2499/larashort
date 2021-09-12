@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Link Stats</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card-body">
                    @if($linkstats->isNotEmpty())
                        <table class="table table-striped">
                            <tr>
                                <th>Link ID</th>
                                <th>Custom Slug</th>
                                <th>Link Code</th>
                                <th>Shortend URL</th>
                                <th>Requested Count</th>
                                <th>Last Requested Date</th>
                            </tr>
                            @foreach($linkstats as $linkstat)
                                <tr>
                                    <td>{{ $linkstat->id }}</td>
                                    <td>{{ $linkstat->custom_slug }}</td>
                                    <td>{{ $linkstat->code }}</td>
                                    <td>{{ $linkstat->shortened_url }}</td>
                                    <td>{{ $linkstat->requested_count }}</td>
                                    <td>{{ $linkstat->last_requested_date }}</td>
                                </tr>
                            @endforeach

                        </table>
                    @else
                        <div class="alert alert-warning">
                            There are no links.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
