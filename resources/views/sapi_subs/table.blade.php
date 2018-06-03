<table class="table table-responsive" id="pemasokSubs-table">
    <thead>
        <tr>
            <th>Sapi1 Id</th>
        <th>Nilai</th>
        <th>Sapi2 Id</th>
        <th>Kriteria Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sapiSubs as $sapiSub)
        <tr>
            <td>{!! $sapiSub->sapi1_id !!}</td>
            <td>{!! $sapiSub->nilai !!}</td>
            <td>{!! $sapiSub->sapi2_id !!}</td>
            <td>{!! $sapiSub->kriteria_id !!}</td>
            <td>
                {!! Form::open(['route' => ['sapiSubs.destroy', $sapiSub->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sapiSubs.show', [$sapiSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sapiSubs.edit', [$sapiSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>