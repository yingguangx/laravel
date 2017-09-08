@extends('staffLayOut')
@section('content')
    <table class="table-hover table-striped table-bordered table">
        <caption>奖项设置</caption>
        <thead>
            <tr>
                <th>奖品名称</th>
                <th>中奖概率(%)</th>
                <th>当日充值金额(元)</th>
                <th>送金币(万)</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>充值100元送60W金币</td>
                <td>30</td>
                <td>100</td>
                <td>60</td>
                <td><button class="btn btn-danger">删除</button></td>
            </tr>
        </tbody>
    </table>
@endsection