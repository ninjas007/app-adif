@extends('backend.layouts.app')

@section('title', 'Award')

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
                        @include('award.form')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
