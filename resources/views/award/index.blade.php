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
                                @if (empty($user->adif))
                                    <div class="col-sm-4">
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Warning!</strong> Please upload your adif file first
                                        </div>
                                        <a href="{{ url('adif') }}" class="btn btn-success"> Upload</a>
                                    </div>
                                @else
                                    <div class="col-sm-2">
                                        <form method="POST" action="{{ route('award.sync') }}">
                                            @csrf
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-download"></i> Sync Data
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                @if ($user->role == 'admin')
                                    <div class="col-sm-2">
                                        <a href="{{ url('award/create') }}" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Add Award
                                        </a>
                                    </div>
                                @endif
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
