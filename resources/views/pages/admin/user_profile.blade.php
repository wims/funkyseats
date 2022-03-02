<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')

 <div class="panel panel-inverse">
        <div class="panel-heading ui-sortable handle">
            <h3 class="panel-title"> Roles and stats</h3>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <div class="panel-body p-0 roles_stats">
                <h3>{{$user->name}}</h3>
                <br>
                <h6> {{$user->email}} </h6> 
                <div class="row roles_stats">
                    <div class="col-6">
                        <h5> Hours this month: {{$checkins->total}}</h5>
                    </div>
                    <div class="col-6">
                        <h5> Hours this week: {{$checkins->week}}</h5>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <h5> Forced: {{$checkins->forced}}</h5>
                    </div>
                    <div class="col">
                        <h5> Mon: {{$checkins->Monday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Tue: {{$checkins->Tuesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Wed: {{$checkins->Wednesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Thu: {{$checkins->Thursday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Fri: {{$checkins->Friday}}</h5>
                    </div>
                </div>
                    
                </div>

                <hr>
                <div class="row roles_row">
                    <div class="row roles_buttons_row">
                        <div class="col-3"> <h5 class="role_header"> Add Role: </h5> </div>
                        @foreach ($user->roles as $role)
                        <div class="col-2">
                               <button class="submit-changes-btn roles_btn"> 
                               <a href="/profile/{{$user->id}}/toggle/{{$role->name}}"> {{Str::title ($role->name)}} <i class="fas fa-plus"></i></a>
                               </button>
                        </div>
                        @endforeach

                    </div>
                    <div class="row roles_buttons_row">
                        <div class="col-3"> <h5 class="role_header"> Remove Role: </h5> </div>
                        @foreach ($roles as $role) 
                        <div class="col-2">
                                <button class="submit-changes-btn roles_btn remove">Veileder 
                                <a href="/profile/{{$user->id}}/toggle/{{$role->name}}"><i class="fas fa-minus"></i></a>
                                </button>
                        </div>
                        @endforeach
                    </div>
                </div> 
                
                <hr>
                <div class="row delete_buttons">
                    <div class="col">
                        <button class="submit-changes-btn delMake_btn"><a href="/profile/{{$user->id}}/delete'">Delete <i class="fas fa-trash"></i></a>
                        </button>
                    </div>
                    <div class="col">
                        <button class="submit-changes-btn delMake_btn">
                        <a href="/profile/{{$user->id}}/anonymize">Anonymize <i class="fas fa-user-secret"></i></a>
                        </button>
                    </div>
                </div>
        </div> 
        
    </div>

    <link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <script defer src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script defer src="../assets/plugins/tag-it/js/tag-it.min.js"></script>

@endsection