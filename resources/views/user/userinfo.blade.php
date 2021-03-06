@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url(elixir('css/user.css'))}}" type="text/css"/>
    <link rel="stylesheet" href="{{url(elixir('css/layer.css'))}}" type="text/css"/>
    <link rel="stylesheet" href="{{url(elixir('css/uploader/uploader.css'))}}" type="text/css"/>
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <a href="/">
                    <p>返回</p>
                </a>
            </div>
            <div class="top-name"><p>设置付款码</p></div>
        </header>
        
        <div class="panel-body demo-panel-files" id='demo-files1'>
            @if($_GET['type'] == 1)
            示例图片:<img src="{{ asset('/images/fkm.png') }}" alt="" width="100%">
            @else
            示例图片:<img src="{{ asset('/images/zfbskm.png') }}" alt="" width="100%">
            @endif
        </div>

        <div id="drag-and-drop-zone" class="uploader" style="border:0;padding:0;text-align: left;">
            <div class="browser" style="position:relative;text-align: center">
                <img src="{{ asset('/images/upload.png') }}" alt="">
                <input style="border: 0;" type="file" name="files[]"  accept="" title='Click to add Images'>
            </div>
        </div>
    </div>
    <div style="position: fixed;bottom: 0;width: 100%">
        <span class="layui-btn layui-btn layui-btn-danger submit" style="width: 100%">提交二维码</span>
    </div>
@endsection
@push('js')
<script>
    (function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>
<script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/demo-preview.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/dmuploader.js')}}"></script>
<script type="text/javascript">
      $('#drag-and-drop-zone').dmUploader({
        url: '/user/fileUpload',
        extraData: {
          userID: '{{ \Illuminate\Support\Facades\Auth::user()->id }}',
          type:'{{ $_GET['type'] }}',//收款码
          _token:'{{csrf_token()}}'
        },
        maxFileSize: 209712500,
        dataType: 'json',
        allowedTypes: '*',
        onInit: function(){
          // $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
        },
        onBeforeUpload: function(id){
          // $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

          $.danidemo.updateFileStatus(id, 'default', '正在上传...');
        },
        onNewFile: function(id, file){
            $.danidemo.addFile('#demo-files1', id, file);
          /*** Begins Image preview loader ***/
          if (typeof FileReader !== "undefined"){

            var reader = new FileReader();

            // Last image added
            var img = $('#demo-files1').find('.demo-image-preview').eq(0);

            reader.onload = function (e) {
              img.attr('src', e.target.result);
              img.attr('style', 'width:4rem;height:4rem');
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
            $('#demo-file'+parseInt(id-1)).remove();
            $('#demo-file'+id).children().filter('img').attr('data-id',data.img_id);
          // $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
          // $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
          // $.danidemo.addLog('#demo-debug', 'info', 'HouseID #' + data.houseImageID);
//           $.danidemo.updateFileStatus(id, 'success', '上传完成');
//           $.danidemo.updateFileProgress(id, '100%');
        },
        onUploadError: function(id, message){
          $.danidemo.updateFileStatus(id, 'error', message);

          // $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file){
          // $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
        },
        onFileSizeError: function(file){
          // $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
        },
        onFallbackMode: function(message){
          // $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
        }
      });
      layui.use('layer',function(){
          window.layer = layui.layer;
      });
      $('.submit').on('click',function () {
          if($('.demo-image-preview').length == 0){
            layer.alert('请上传收款码！');
            return false;
          }
          $.ajax({
            type:'post',
            dataType:'json',
            url:'/user/submitFile',
            data:{'img_id':$('.demo-image-preview').attr('data-id'),
                  'type':'{{ $_GET['type'] }}',
                  '_token':'{{csrf_token()}}'
            },
            success:function () {
              layer.alert('提交成功', {icon: 1});
              setTimeout("location.href = '/user'",1500);
            }
          })

      });
</script>
@endpush