@foreach ($kriterias as $kk => $v)
  @php
    $psk = $ps->where('kriteria_id','=',$v->id);
  @endphp


  <br>
    <hr>
    <div class="clearfix"></div>
  <h4><strong>{!! $v->nama_kriteria !!}</strong></h4>
  <table class="table table-responsive" id="sapiSubs-table">
    @if (!empty(count($psk)))
      <thead>
          <tr>
          <th>#</th>
          <th>Sapi1</th>
          <th>Nilai</th>
          <th>Sapi2</th>
          <th>Sub Kriteria</th>
              <th colspan="3">Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $no = 1;
        @endphp
      @foreach($psk as $sapiSub)
          <tr>
              <td>{!! $no++ !!}</td>
              <td>{!! $p[$sapiSub->sapi1_id] !!}</td>
              <td>{!! $sapiSub->nilai !!}</td>
              <td>{!! $p[$sapiSub->sapi2_id] !!}</td>
              <td>{!! $sapiSub->subKriteria->nama_sub_kriteria !!}</td>
              <td>
                  {!! Form::open(['route' => ['sapiSubs.destroy', $sapiSub->id], 'method' => 'delete']) !!}
                  <div class='btn-group'>
                      <a href="{!! route('sapiSubs.edit', [$sapiSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  </div>
              </td>
          </tr>
      @endforeach
      </tbody>
    @else
      Data Kosong
    @endif
  </table>
@endforeach
