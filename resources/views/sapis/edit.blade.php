@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sapi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sapi, ['route' => ['sapis.update', $sapi->id], 'method' => 'patch']) !!}

                        @include('sapis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection