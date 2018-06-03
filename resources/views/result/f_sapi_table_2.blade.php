

<div class="clearfix"></div>
<div class="box box-primary">
    <div class="box-body">
        <table class="table table-responsive" id="kriteriaKriterias-table">
            <thead style="font-weight: bold">
            <tr>
                <td></td>
                @foreach($expert as $e)
                  <td>{!! $e->nama !!}</td>
                @endforeach
                <td>Total</td>
                <td>Bobot Akhir</td>
            </tr>
            </thead>
            <tbody>
            @php
            $x = 0;
            $tot = [];
            $totot = 0;
            $tArr = [];
            // $subsk = $subKriterias->where('kriteria_id', '=', $v->id)
            @endphp
            @foreach($pemasoks as $pm)
                @php
                  $tr1 = "pem-".$vsb->id;
                  $tr2 = "pem-to-".$vsb->id;
                @endphp
                <tr class={!! $tr1 !!}>
                    <!--menampilkan nama kriteria (paling kiri)-->
                    <td><strong>{!! $pm->nama_pemasok !!}</strong></td>
                    @php
                      // dd($subKriteria);
                    @endphp
                    <!--di sini menampilkan nilai-->
                    @foreach ($arrpm as $key => $vah)
                        @php
                        // dd($arrh);
                          try {
                            $j = $vah["vektor"] != null ? round(min($vah["vektor"][$x]), 3): 1;
                          } catch (Exception $e) {
                            $vah['vektor'][$x] = null;
                          }
                          // var_dump($vah["vektor"][$x]);
                        @endphp
                      <td>{!! $vah["vektor"][$x] != null ? round(min($vah["vektor"][$x]), 3): 0 !!}</td>
                      @php
                        $tot[$x][$key] =  $vah["vektor"][$x] != null ? min($vah["vektor"][$x]) : 0;
                      @endphp
                    @endforeach
                    <td>{!! $t = round(array_sum($tot[$x]),3) !!}</td>
                    @php
                      $x += 1;
                      $tArr[] = $t;
                      $totot += $t;
                      // dd($x);
                    @endphp
                </tr>
            @endforeach

            </tbody>
            <tfoot>
              <tr id="{!! $tr2!!}">
                <th colspan="4">Total</th>
                <th>{!! $totot !!}</th>
              </tr>
            </tfoot>
            @php

              // dd($h);
              $h = 0;
              foreach ($pemasoks as $ksk => $vsk) {
                $GLOBALS['bobotPemasokList'][$vsb->id][$ksk] = array_sum($tArr)>0 ? $tArr[$h]/array_sum($tArr) : 1;
                $h++;
              }
              // dd($bobotSubKriteriaList);
            @endphp
        </table>
    </div>
</div>

<script type="text/javascript">
  var rd = document.getElementsByClassName("{!! $tr1 !!}");
  var tArr = {!! json_encode($tArr) !!}
  var totalA = 0;
  var total = {!! array_sum($tArr) !!}
  for (var r in rd) {
    if (rd.hasOwnProperty(r)) {
      bar = rd[r];
      var newEl = document.createElement("td");
      newEl.setAttribute("id", "pesub-{!! $v->id !!}-{!! $vsb->id !!}-"+r)
      var isi = isNaN((tArr[r]/total)) ? 1 :(tArr[r]/total);
      newEl.innerHTML = isi.toPrecision(3);
      bar.appendChild(newEl);
      totalA += isi;
    }
  }
  var tro = document.getElementById("{!! $tr2 !!}");
  var newEl = document.createElement('th');
  newEl.innerHTML = isNaN(totalA) ? 1 : Math.round(totalA);
  tro.appendChild(newEl)

</script>
