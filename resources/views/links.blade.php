@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Links</div>
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
                        @if(count($links))
                            <table class="table table-striped">
                                <tr>
                                    <th>Link Redirect URL</th>
                                    <th>Custom Slug</th>
                                    <th>Link Code</th>
                                    <th>Shortend URL</th>
                                    <th>Link Stats</th>
                                </tr>
                                @foreach($links as $link)
                                    <tr>
                                        <td>{{ $link->redirect_url }}</td>
                                        <td>{{ $link->custom_slug }}</td>
                                        <td>{{ $link->code }}</td>
                                        <td>
                                            <a href="{{ $link->shortened_url }}">
                                                {{ $link->shortened_url }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/links/{{ $link->id }}">
                                                Link Stats
                                            </a>
                                        </td>
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
    </div>
@endsection
