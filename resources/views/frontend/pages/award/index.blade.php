@extends('layouts.index')

@section('title', 'Award')
@section('description', '')
@section('keywords', '')
@section('og_title', '')
@section('og_site_name', '')

@section('css')
<style>
    table tr td {
        padding: 2px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" style="height: 100%">
                <div class="mx-2">
                    <div class="card mb-3">
                        <div class="card-body">
                            <table style="width: 100%">
                                <tr>
                                    <td width="15%">User</td>
                                    <td>:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td width="15%">Email</td>
                                    <td>:</td>
                                    <td>{{ $user->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td width="15%">Callsign</td>
                                    <td>:</td>
                                    <td>{{ $user->callsign ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            @if (empty($contents))
                                <p>No Data</p>
                            @else
                                {{-- @foreach ($contents as $content)
                                    <div>Callsign: {{ $content['call'] }}</div>
                                @endforeach --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
