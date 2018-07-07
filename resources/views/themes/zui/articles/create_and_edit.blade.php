@extends('themes.zui.layouts.app')

@section('title', '编辑文章')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.css') }}">
@stop

@section('content')

<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h1>
                <i class="icon-edit"></i> 文章 /
                @if($article->id)
                    编辑 #{{$article->id}}
                @else
                    创建
                @endif
            </h1>
        </div>

        @include('shares._errors')

        <div class="panel-body">
            @if($article->id)
                <form action="{{ route('articles.update', $article->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
            @else
                <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
            @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="form-group">
                <label for="title-field">标题</label>
                <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $article->title ) }}" />
            </div>
            <div class="form-group">
                <label for="subject_id-field">收录到专题</label>
                <select name="subject_id" id="subject_id-field" class="form-control">
                    @foreach ($subjects as $subject)
                    <optgroup label="{{ $subject->name }}">
                        @foreach ($subject->children as $child)
                        <option value="{{ $child->id }}" {{ $child->id == $article->subject_id ? 'selected' : '' }}>{{ $child->name }}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="article-editormd">
                <label for="content-field">内容</label>
                <textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $article->content ) }}</textarea>
            </div>
            <div class="form-group">
                <label for="excerpt-field">摘要</label>
                <textarea name="excerpt" id="excerpt-field" class="form-control" rows="3">{{ old('excerpt', $article->excerpt ) }}</textarea>
            </div>
            <div class="form-group">
                <label for="slug-field">SEO Slug</label>
                <input class="form-control" type="text" name="slug" id="slug-field" value="{{ old('slug', $article->slug ) }}" />
            </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                    <a class="btn btn-link pull-right" href="{{ route('articles.index') }}"><i class="icon-backward"></i>  返回文章页</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/editormd/editormd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/lrz/lrz.bundle.js') }}"></script>
    <script>
    var articleEditormd;

    $(function() {
        articleEditormd = editormd({
            id      : "article-editormd",
            width   : "100%",
            height  : 640,
            path    : "/vendor/editormd/lib/",
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : '{{ route('articles.editormd_upload_image') }}',
            imageParams: { _token: '{{ csrf_token() }}' }
        });

        function paste(event) {
            var clipboardData = event.clipboardData;
            var items, item, types;
            if (clipboardData) {
                items = clipboardData.items;
                if (!items) {
                    return;
                }
                // 保存在剪贴板中的数据类型
                types = clipboardData.types || [];
                for (var i = 0; i < types.length; i++) {
                    if (types[i] === 'Files') {
                        item = items[i];
                        break;
                    }
                }
                // 判断是否为图片数据
                if (item && item.kind === 'file' && item.type.match(/^image\//i)) {
                    // 读取该图片
                    var file = item.getAsFile(),
                            reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        //前端压缩
                        lrz(reader.result, {width: 1080}).then(function (res) {
                            $.ajax({
                                url: "{{ route('resources.editormd_paste_upload_image') }}",
                                type: 'post',
                                data: {
                                    "image": res.base64,
                                    "guid": new Date().getTime()
                                },
                                contentType: 'application/x-www-form-urlencoded;charest=UTF-8',
                                success: function (data) {
                                    console.log(data);
                                    if (data.success === 0) {
                                        alert(data.message);
                                    } else {
                                        var qiniuUrl = '![](' + data.url + ')';
                                        articleEditormd.insertValue(qiniuUrl);
                                    }
                                }
                            })
                        });
                    }
                }
            }
        }
        document.addEventListener('paste', function (event) {
            paste(event);
        })

    });
    </script>
@stop
