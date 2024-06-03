@extends('backend.layouts.app')

@section('title', 'General Dashboard')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Award</h1>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    @if (!empty($user->adif))
                                        <form method="POST" action="{{ route('award.sync') }}">
                                            @csrf
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <i class="fa fa-download"></i> Sync Data
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Warning!</strong> Please upload your adif file first
                                        </div>
                                        <a href="{{ url('adif') }}" class="btn btn-primary btn-block"> Upload</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    {{-- @include('award.search') --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @include('award.table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
