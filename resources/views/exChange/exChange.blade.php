<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('css/new_file.css') }}" />
    <link rel="stylesheet" href="{{asset(("css/bootstrap.min.css"))}}">
    <script type="text/javascript" src="{{ asset('js/jquery-1.8.2.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/new_file.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('css/layer.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/viewer/viewer.min.css') }}" />
    <!-- <script type="text/javascript" src="{{ asset('js/layer.js') }}" ></script> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/weui.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/query-weui.css') }}">
 <script src="../lib/jquery-2.1.4.js"></script>
<script src="../lib/fastclick.js"></script>
<script src="../js/jquery-weui.js"></script> -->
    <title>集结号下分兑换</title>
    <link rel="stylesheet" href="{{url(elixir('css/uploader/uploader.css'))}}" type="text/css"/>
</head>
<style>
    .xiafenjine{
        color:red;
    }
    #drag-and-drop-zone{
        margin-top: 10px;
    }
    .demo-panel-files{
        position: relative;
    }
    .demo-panel-files img.demo-image-preview{
        width:6rem!important;
        height:6rem!important;
    }
    .demo-panel-files>div{
        position: absolute;
        margin-left: -4rem;
        left: 50%;
    }

</style>
<body>
<!--头部  star-->
<header>
    <a href="javascript:history.go(-1);">
        <div class="_left"><img src="{{ asset('images/return.png') }}"></div>
        下分兑换
    </a>
</header>
<!--头部 end-->
<div class="banner">
    <img src="{{ asset('images/exchange.png') }}" width="100%" height="80%"/>
</div>

<!--选择种类-->
<div class="sel_type">
    <div class="fl typeP">
        <p>选择游戏种类:</p>
    </div>
    <div class="fl typeSel">
        <select id="selType" name="selType" class="form-control" onchange="appendfor($(this).val())">
            <option value=""  >请选择游戏种类</option>
            <?php foreach ($games as $key => $game) {
           ?>
            <option value="{{$game->id }}">{{$game->name}}</option>
            <?php } ?>
        </select>
    </div>
    <div class="clear"></div>
</div>

<!--游戏ID-->
<div class="sel_type">
    <div class="fl typeP">
        <p>输入游戏ID:</p>
    </div>
    <div class="fl typeSel">
        <input type="text" class="form-input" placeholder="请输入游戏ID" name="play_id">
    </div>
    <div class="clear"></div>
</div>



<div class="panel-body demo-panel-files" id='demo-files1'>
</div>
<div id="drag-and-drop-zone" class="uploader" style="border:0;padding:0;text-align: left;">
    <div class="browser" style="position:relative;text-align: center">
        <img src="{{ asset('/images/upload.png') }}" alt="">
        <input style="border: 0;" type="file" name="files[]"  accept="" multiple="multiple" title='Click to add Images'>
    </div>
</div>
<!--每种游戏商家对应的id-->
<div class="sel_type xiafenid">
        <p class="xiafenjine"></p>
    <div class="clear"></div>
</div>
<!--每种游戏商家对应的比例-->
<div class="sel_type xiafenrate">
        <p class="xiafenjine"></p>
    <div class="clear"></div>
</div>

<!--自定义金额-->
<div class="sel_type hide" id="user_defined">
    <div class="fl typeP">
        <p>自定义分值:</p>
    </div>
    <div class="fl typeSel">
        <input type="text" class="form-input" placeholder="请输入金额">
    </div>
    <div class="clear"></div>
</div>

<!--充值列表-->
<div class="person_wallet_recharge">
 
    <div class="pic"><input type="text" placeholder="分值必须为10万分以上" id="txt" oninput="inputfor($(this).val(),$('#selType').val())" /><span>万</span>&nbsp&nbsp&nbsp&nbsp<span class="xiafenjine appendjine">对应金额为：0元</span></div>
    <div class="botton wantxiafen1">我要下分</div>
    <div class="agreement"><p>点击我要下分，即您已经表示同意<a>《下分活动协议》</a></p></div>
    <div class="f-overlay"></div>

    <!--支付选择-->
    {{--<div class="addvideo" style="display: none;">--}}
        {{--<h3>本次充值<span>2000</span>元</h3>--}}
        {{--<ul>--}}
            {{--<li><a>微信支付</a></li>--}}
            {{--<li><a>支付宝支付</a></li>--}}
            {{--<li class="cal">取消</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
</div>
</body>
<script type="text/javascript" src="{{asset('/js/layui/layui.all.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/demo-preview.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/dmuploader.js')}}"></script>
<script src="{{ asset('js/viewer/viewer.min.js') }}"></script>
<script type="text/javascript">
    var file_path = '';
    $('#drag-and-drop-zone').dmUploader({
        url: '/exChange/uploadFile',
        extraData: {
            userID: '{{ \Illuminate\Support\Facades\Auth::user()->id }}',
            _token:'{{csrf_token()}}'
        },
        maxFileSize: 209712500,
        dataType: 'json',
        allowedTypes: 'image/*',
        onInit: function(){
            // $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
        },
        onBeforeUpload: function(id){
            $.danidemo.updateFileStatus(id, 'default', '正在上传...');
        },
        onNewFile: function(id, file){
            $('.demo-panel-files').css('height','8rem');
            $.danidemo.addSingleFile('#demo-files1', id, file);
            /*** Begins Image preview loader ***/
            if (typeof FileReader !== "undefined"){

                var reader = new FileReader();

                // Last image added
                var img = $('#demo-files1').find('.demo-image-preview').eq(0);

                reader.onload = function (e) {
                    img.attr('src', e.target.result);
                    img.attr('style', 'width:4rem;height:4rem');
                    $(".demo-image-preview").viewer();
                }

                reader.readAsDataURL(file);

            } else {
                // Hide/Remove all Images if FileReader isn't supported
                $('#demo-files1').find('.demo-image-preview').remove();
            }
            /*** Ends Image preview loader ***/

        },
        onComplete: function(){
            // $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
        },
        onUploadProgress: function(id, percent){
            var percentStr = percent + '%';

            $.danidemo.updateFileProgress(id, percentStr);
        },
        onUploadSuccess: function(id, data){
           if(data.code==200){
               file_path = data.data;
           }
        },
        onUploadError: function(id, message){
            $.danidemo.updateFileStatus(id, 'error', message);

            // $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file){
             layer.alert(file.name+'不是一个有效的图片文件!');
        },
        onFileSizeError: function(file){
            layer.alert(file.name+'超出了'+this.maxFileSize+'的大小限制');
        },
        onFallbackMode: function(message){
            // $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
        }
    });


</script>
<script>
window.onload = function(){ 
     obj1 = [];
　  $.ajax({
            url: "/getGamesinfo",
            type: "POST",
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                obj1 = data.result1;
                }
        });
} 

    function appendfor(id) {
        // console.log(obj1[id]['name']);
        // return false;
         $('.xiafenid').find('.xiafenjine').text(obj1[id]['name']+'下分id为'+obj1[id]['business_id']);  
         $('.xiafenrate').find('.xiafenjine').text(obj1[id]['name']+'下分比例为'+obj1[id]['hhwx_rate']);  
         inputfor($('#txt').val(),id)

    }

    function inputfor(value,id)
    {
        var rate = obj1[id]['hhwx_rate'];
        var money = parseInt(value/rate);
     
        $('.appendjine').text('对应金额为'+money+'元');

    }

    $('.wantxiafen1').click(function(e){
        e.preventDefault();
        var play_sort = $('#selType').val();
        var play_id = $('input[name="play_id"]').val();
        var txt = $('#txt').val();
        var hhwx_rate = '';
        if($('#selType').val()){
             hhwx_rate = obj1[$('#selType').val()]['hhwx_rate'] || '';
        }
        if (hhwx_rate!='' && play_sort != '' && play_id != '' && txt != '' && file_path!='') {
             $.ajax({
                url: "/xiafensubmit",
                type: "POST",
                dataType: "json",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: { 
                    'play_sort':play_sort,
                    'play_id':play_id,
                    'txt':txt,
                    'hhwx_rate':hhwx_rate,
                    'file_path':file_path,
                },
                success: function (data) {
                    console.log(data);
                        if(data.result1){
                           window.location.reload();
                        }
                    }
            });
        }else if(play_sort == '' || hhwx_rate=='') {
            layer.alert('请选择游戏种类');
        } else if(play_id == ''){
            layer.alert('请输入游戏ID');
        } else if(file_path == ''){
            layer.alert('请上传交易截图!');
        }
    })
    function userDefined() {
        $('#user_defined').show();
    }

    $('.selInput').click(function () {
        $('#user_defined').hide();
    })

</script>
</html>
