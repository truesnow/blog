<!--
    Markdown 内容显示公共视图
    传入参数: title content
 -->
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.preview.css') }}">
@stop

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
                <h1 class="text-center">{{ $title }}</h1>
            </header>
            <section class="content" id="article-editormd-view">
                <textarea>{!! $content !!}</textarea>
            </section>
        </article>
    </div>
</div>

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
            htmlDecode: "style,script,iframe", // you can filter tags decode
            emoji: true,
            taskList: true,
            tex: true, // 默认不解析
            flowChart: true, // 默认不解析
            sequenceDiagram: true, // 默认不解析
            tocContainer: "#custom-toc-container",
            tocDropdown: false
        });
    });
</script>
@stop