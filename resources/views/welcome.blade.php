@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">URL Shorten Form</div>
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
                        <form method="post" action="{{ url('/') }}" id="larashort_url_shorten_form" name="larashort_url_shorten_form">
                            @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="custom_slug">Custom Slug:</label>
                                        <input type="text" class="form-control" id="custom_slug" name="custom_slug" value="{{ old('custom_slug') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="redirect_url">Enter URL to shorten:</label>
                                        <input type="text" class="form-control" id="redirect_url" name="redirect_url" value="{{ old('redirect_url') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
