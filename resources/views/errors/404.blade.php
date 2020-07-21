@extends(theme_prefix() . 'layouts.app')

@section('title', '404 页面不存在')

@section('content')
对不起，您访问的页面：{{ request()->path() }} 不存在，如有问题，请联系站长反馈。
@stop