<div class="table-responsive">
    <table class="table table-bordered datatable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Rules</th>
                <th class="text-center" style="width: 200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($awards as $award)
                <tr>
                    <td>
                        <a href="{{ asset('storage/' . $award->path_image) }}" target="_blank">
                            <img src="{{ asset('storage/' . $award->path_image) }}" width="100" height="100"> <br>
                        </a>
                    </td>
                    <td>{{ $award->name }}</td>
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
                    <td class="text-center">
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.award.edit', $award->id) }}" class="btn btn-primary"
                                title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.award.destroy', $award->id) }}" class="btn btn-danger"
                                title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                        @if (!empty($award->usersAward))
                            @if (in_array(auth()->user()->id, $award->usersAward->pluck('user_id')->toArray()))
                                <a download="award.pdf" href="{{ asset('storage/' . $award->pdf) }}"
                                    class="btn btn-primary" title="Download">
                                    <i class="fa fa-download"></i>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
            @endforelse

        </tbody>

    </table>

</div>
