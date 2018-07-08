@extends('themes.zui.layouts.app')

@section('title', $article->title)

@section('description', $article->excerpt)

@section('css')

<link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.preview.css') }}">

@stop

@section('content')

<div class="row">
  <div class="col-md-3">
    <div id="sidebar" class="article-sidebar hidden-sm hidden-xs">
        <h1>文章目录</h1>
        <div class="markdown-body editormd-preview-container" id="custom-toc-container">#custom-toc-container</div>
    </div>
  </div>
  <div class="col-md-9">
    <article class="article">
      <header>
        <h1 class="text-center">{{ $article->title }}</h1>
        <dl class="dl-inline">
          <dt>作者：</dt>
          <dd>{{ $article->user->name }}</dd>
          <dt>发布于：</dt>
          <dd>{{ $article->created_at->diffForHumans() }}</dd>
          <dt>收录于：</dt>
          <dd><a href="{{ route('subjects.show', $article->subject_id) }}">{{ $article->subject->name }}</a></dd>
          <dt></dt>
          <dd class="pull-right"><span class="label label-danger"><i class="icon-eye-open"></i> {{ $article->view_count }}</span> <span class="label label-info"><i class="icon-comment"></i>{{ $article->reply_count }}</span> </dd>
        </dl>
        <section class="abstract">
          <p><strong>摘要：</strong>{{ $article->excerpt }}</p>
        </section>
      </header>
      <section class="content" id="article-editormd-view">
        <textarea name="" id="append-article" style="display:none;">{!! $article->content !!}</textarea>
      </section>
      <footer>
        <div class="operate">
            @can('update', $article)
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span>编辑</a>
            @endcan
            @can('destroy', $article)
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span>删除</button>
            </form>
            @endcan
        </div>
      </footer>
    </article>
    @include('themes.zui.articles._reply_list', compact('replies'))

  </div>
</div>

@stop

@section('js')

<script src="{{ asset('vendor/editormd/lib/marked.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/lib/prettify.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/lib/raphael.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/lib/sequence-diagram.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/lib/flowchart.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/lib/jquery.flowchart.min.js') }}"></script>
<script src="{{ asset('vendor/editormd/editormd.min.js') }}"></script>
<script type="text/javascript">
var articleEditormdView;
$(function() {
    articleEditormdView = editormd.markdownToHTML("article-editormd-view", {
        htmlDecode      : "style,script,iframe",  // you can filter tags decode
        emoji           : true,
        taskList        : true,
        tex             : true,  // 默认不解析
        flowChart       : true,  // 默认不解析
        sequenceDiagram : true,  // 默认不解析
        tocContainer : "#custom-toc-container",
        tocDropdown   : false
    });
});
</script>

@stop



