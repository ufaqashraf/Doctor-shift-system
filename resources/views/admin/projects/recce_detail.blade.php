@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Employees</h1>
    </section>
@stop
@section('stylesheet')

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Project Detail</h3>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>

        </div>
        <div class="text-center">
            <h3 style="font-weight: bold; text-decoration: underline;">{{$Project->name}}</h3>
        </div>
        <h2 class="text-center">Recce Details</h2>
        <!-- /.box-header -->
        <div class="panel-body pad table-responsive">
            <table class="table  table-bordered">
                <thead>
                <tr>
                    <th> Select</th>
                    <th> Duration</th>
                    <th> Scene</th>
                    <th> Location</th>
                    <th> Camera</th>
                    <th> Artist</th>
                    <th> Desc</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recceNotes as $key => $val)
                <tr>
                    <td>{{$val->duration}}</td>
                </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    </div>


@stop

@section('javascript')

@endsection