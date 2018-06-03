@php
$bobotKriteria = $GLOBALS['bobotKriteriaList'];
$bobotSubKriteria = $GLOBALS['bobotSubKriteriaList'];
$bobotSapi = $GLOBALS['bobotSapiList'];
// dd($bobotSubKriteria);
$bobotFixSub = [];
  foreach ($subKriterias as $kker => $vaker) {
    foreach ($kriterias as $kkl => $vkl) {
      // dd($bobotSubKriteria[$vkl->id][$vaker->id]);
      try {
        $bobotFixSub[$vaker->id] = $bobotSubKriteria[$vkl->id][$vaker->id] * $bobotKriteria[$vkl->id];
      } catch (Exception $e) {

      }
    }
  }
// dd($bobotSapi);
@endphp
{!! Charts::styles() !!}


              @php
                $listRank = null;
              @endphp
          @foreach ($sapis as $kmo => $vamo)
            @php
              $oke = null;
            @endphp
            @foreach ($bobotFixSub as $ksx => $vasx)
              @php
              if($oke==null)$oke=0;
                $oke += $vasx * $bobotSapi[$ksx][$kmo];
              @endphp
            @endforeach
            @php
              $listRank[$vamo->nama_sapi] = $oke;
            @endphp
          @endforeach
          @php
            // dd($listRank);

          @endphp
          @if ($listRank != null)
            @php
            $namaP = [];
            $bobotP = [];
            foreach ($listRank as $y => $ue) {
              $namaP[] = $y;
              $bobotP[] = $ue;
            }
            // $colors = [];
            // foreach ($bobotP as $bk => $bv) {
            //   $colors[] = rgb(0,$bv, 1);
            // }
            // dd($colors);
            $chart->title('Rangking Sapi')
                  ->labels($namaP)
                  ->values($bobotP)
                  ->elementLabel('Sapi');
              arsort($listRank);
              $no = 1;
            @endphp
      <div class="clearfix"></div>
        <div class="box box-primary">
          <div class="box-body">
            <div class="chart">
              {!! $chart->html() !!}
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
          <div class="box box-primary">
              <div class="box-body">
            <table class="table table-responsive" id="hasil-table">

                <thead style="font-weight: bold">
                <tr>
                  <th>Peringkat</th>
                  <th>Nama Sapi</th>
                  <th>Bobot</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($listRank as $kli => $vli)
                  <tr>
                    <td>{!! $no++ !!}</td>
                    <td>{!! $kli !!}</td>
                    <td>{!! round($vli,5) !!}</td>
                  </tr>
                @endforeach

            </tbody>
        </table>
      @endif
        <hr>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
