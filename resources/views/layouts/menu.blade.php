<li class="{{ Request::is('sapis*') ? 'active' : '' }}">
    <a href="{!! route('result') !!}"><i class="fa fa-bar-chart"></i><span>Hasil</span></a>
</li>

<li class="{{ Request::is('kriterias*') ? 'active' : '' }}">
    <a href="{!! route('kriterias.index') !!}"><i class="fa fa-check-square-o"></i><span>Kriteria</span></a>
</li>

<li class="{{ Request::is('experts*') ? 'active' : '' }}">
    <a href="{!! route('experts.index') !!}"><i class="fa fa-user"></i><span>Pakar</span></a>
</li>
<li class="{{ Request::is('sapis*') ? 'active' : '' }}">
    <a href="{!! route('sapis.index') !!}"><i class="fa fa-child"></i><span>Sapi</span></a>
</li>
