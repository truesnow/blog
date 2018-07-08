@extends('themes.zui.layouts.app')
@section('title', $page->description)

@section('content')

<div id="editormd-view">
    <textarea name="" id="append-article" style="display:none;">{!! $page->content !!}</textarea>
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
var editormdView;
$(function() {
    editormdView = editormd.markdownToHTML("editormd-view", {
        htmlDecode      : "style,script,iframe",  // you can filter tags decode
        emoji           : true,
        taskList        : true,
        tex             : true,  // 默认不解析
        flowChart       : true,  // 默认不解析
        sequenceDiagram : true,  // 默认不解析
        // tocContainer : "#custom-toc-container",
        // tocDropdown   : false
    });
});
</script>

@stop
