<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Award</th>
                <th>Description</th>
                <th>Rules</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($awards as $award)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $award->image) }}" width="150"> <br>
                        {{ $award->name }}
                    </td>
                    <td>{{ $award->description }}</td>
                    <td>
                        @if (!empty($award->rules))
                            @php
                                $rules = json_decode($award->rules, true);
                            @endphp

                            @foreach ($rules as $key => $rule)
                                <div>{{ $key }}: {{ $rule }}</div>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if (!empty($award->user_award))
                            <a href="" class="btn btn-primary btn-sm">Download</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Data</td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>
