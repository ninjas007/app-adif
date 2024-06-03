@extends('layouts.index')

@section('title', 'Home')
@section('description', '')
@section('keywords', '')
@section('og_title', '')
@section('og_site_name', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center" style="height: 80vh">
                <div class="mx-0">
                    @guest
                        <p class="text-center">Created By Community Radio Amateur Indonesia</p>
                        <p class="text-center">Please login to upload your adif file</p☻>
                    @else
                        <form method="POST" action="{{ route('adif.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="adif">Adif File</label>
                                <input type="file" name="adif" class="form-control" id="adif" required>
                            </div>
                            @error('adif')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-download"></i> Submit
                                </button>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
