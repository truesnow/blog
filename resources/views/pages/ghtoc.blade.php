@extends(theme_prefix() . 'layouts.app')

@section('title', '在线生成 GitHub README.md 目录')

@section('content')

<div class="row">
  <div class="col-md-6">
      <ul class="nav nav-tabs">
        <li class="active">
          <a data-tab href="#url-run">URL 生成</a>
        </li>
        <li>
          <a data-tab href="#markdown-content-run">Markdown 生成</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="url-run">
          <br>
          <form action="{{ route('ghtoc.run') }}" method="post" id="url-form">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="url">
          <div class="form-group">
            <label for="url">请输入 README.md 文档链接：</label>
            <input type="text" name="url" id="url" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">点击生成</button>
          <button type="button" class="btn btn-default" id="url-example-btn">使用示例 URL 生成</button>
          </form>
        </div>
        <div class="tab-pane" id="markdown-content-run">
          <br>
          <form action="{{ route('ghtoc.run') }}" method="post" id="content-form">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="content">
          <div class="form-group">
            <label for="content">请输入 README.md 文档内容：</label>
            <textarea name="content" id="content" cols="30" rows="20" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">点击生成</button>
          <button type="submit" class="btn btn-default" id="content-example-btn">使用示例 Markdown 生成</button>
          </form>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="toc">生成目录结果：</label>
      <button type="button" class="btn btn-primary" id="copy-btn" data-clipboard-action="copy" data-clipboard-target="#toc">复制</button>
      <textarea name="toc" id="toc" cols="30" rows="20" class="form-control"></textarea>
    </div>
  </div>
</div>

<div>
  <textarea name="example-markdown" id="example-markdown" cols="30" rows="10" class="hidden">
# Hello World
# 贡献者
# 致谢
# 版权声明
  </textarea>
</div>

@stop

@section("js")
<script src="{{ asset('vendor/clipboard/clipboard.min.js') }}"></script>
<script>
  $(function(){
    // 使用示例 url
    $('#url-example-btn').on('click', function (e) {
      $('#url').val('https://github.com/truesnow/X-Tools/blob/master/README.md');
      $('#url-form').submit();
    });
    // 使用示例 content
    $('#content-example-btn').on('click', function (e) {
      $('#content').val($('#example-markdown').val());
      $('#content-form').submit();
    });
    // 提交生成 toc
    $('form').on('submit', function(e) {
      var params = $(this).serialize();
      var action = $(this).attr('action');
      $.post(action, params, function (res) {
        $('#toc').val(res);
      });
      e.preventDefault();
    });
    // 初始化复制功能
    var clipboard = new ClipboardJS('#copy-btn');
    clipboard.on('success', function(e) {
      layer.msg('目录已复制');
    });
  });
</script>

@stop
