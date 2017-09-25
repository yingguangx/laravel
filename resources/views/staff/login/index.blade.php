@extends('staffLayOut')

@section('content')
    <style>
        .headerStyle {
            background-color: #fafafa;
            border-color: #F1F4F5;
            color: #797979;
            width:90%;
            height:70px;
            margin-left:10px;
        }
    </style>

    <span style="font-size: 20px;margin-left: 10px;"><b>欢迎光临！</b></span>

    <div class="row headerStyle m-t-15">
        <span style="margin-left: 20px;margin-top: 20px;display: block;">
            您的角色：
            <span style="color: blue;">
            @if(session('staff_role') == 1)
                超级管理员
            @else
                管理员
            @endif
            </span>
        </span>
    </div>
@endsection

@section('jquery')
@endsection
