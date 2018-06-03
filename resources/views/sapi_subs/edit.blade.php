@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pemasok Sub
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sapiSub, ['route' => ['sapiSubs.update', $sapiSub->id], 'method' => 'patch']) !!}

                        @include('sapi_subs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection