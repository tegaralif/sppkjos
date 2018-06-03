<table class="table table-responsive" id="sapis-table">
  @if (!empty(count($sapis)))
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Sapi</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
        // dd($sapis);
      @endphp
    @foreach($sapis as $sapi)
        <tr>
            <td>{!! $no++ !!}</td>
            <td>{!! $sapi->nama_sapi !!}</td>
            <td>
                {!! Form::open(['route' => ['sapis.destroy', $sapi->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sapis.edit', [$sapi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
  @else
    Data Kosong
  @endif
</table>
