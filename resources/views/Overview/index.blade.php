@extends('home')

@section('section')
    <div class="overview__albums">
        <div class="album">
            <div class="album__tracks">
                <div class="tracks">
                    <comments-component></comments-component>
                    <div class="container">
                        <div class="row unfinished">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Nesplněné úkoly</h3>
                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                        <tr>
                                            <th>Název</th>
                                            <th>Popis</th>
                                            <th>datum splnění</th>
                                            <th>status</th>
                                            <th>vytvořeno</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($unfinishedTasks as $unfinished)
                                            <tr>
                                                <td>{{ $unfinished->title }}</td>
                                                <td>{{ $unfinished->description }}</td>
                                                <td>{{ $unfinished->due_date }}</td>
                                                <td>{{ $unfinished->status->name }}</td>
                                                <td>{{ $unfinished->created_at }}</td>
                                                <td class="col-md-2">
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=edit">Edit</a>
                                                        <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=remove">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row planned">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Naplánované úkoly</h3>
                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                        <tr>
                                            <th>Název</th>
                                            <th>Popis</th>
                                            <th>datum splnění</th>
                                            <th>status</th>
                                            <th>vytvořeno</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($todayTasks as $today)
                                            <tr>
                                                <td>{{ $today->title }}</td>
                                                <td>{{ $today->description }}</td>
                                                <td>{{ $today->due_date }}</td>
                                                <td>{{ $today->status->name }}</td>
                                                <td>{{ $today->created_at }}</td>
                                                <td class="col-md-2">
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=edit">Edit</a>
                                                        <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=remove">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
