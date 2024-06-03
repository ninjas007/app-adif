<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Operator</th>
                <th>Call</th>
                <th>Qso Date</th>
                <th>Time On</th>
                <th>Band</th>
                <th>Freq</th>
                <th>Mode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adif as $val)
                <tr>
                    <td>{{ $val->operator ?? 'N/A' }}</td>
                    <td>{{ $val->call }}</td>
                    <td>{{ !empty($val->qso_date) ? formatDate($val->qso_date) : 'N/A' }}</td>
                    <td>{{ !empty($val->time_on) ? formatTime($val->time_on) : 'N/A' }}</td>
                    <td>{{ $val->band }}</td>
                    <td>{{ $val->freq }}</td>
                    <td>{{ $val->mode }}</td>
                </tr>
            @endforeach
        </tbody>
        @if (!empty($adif))
            <tfoot class="bg-light">
                <tr>
                    <td class="text-center" colspan="5">{{ $adif->links() }}</td>
                    <td class="text-center" colspan="2">Total Record of QSO {{ $adif->total() }}</td>
                </tr>
            </tfoot>
        @else
            <tfoot>
                <tr>
                    <td class="text-center" colspan="7">No Record</td>
                </tr>
            </tfoot>
        @endif
    </table>

</div>
