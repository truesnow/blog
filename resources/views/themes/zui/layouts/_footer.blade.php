<?php

use App\Models\Page;

$pages = Page::where('is_show', 1)->get();
?>

<footer class="page-footer">
    <div class="text-center">
        @if (count($pages))
        <div class="links">
            @foreach ($pages as $k => $page)
            <a href="/{{ $page->name }}">{{ $page->description }}</a>
            @endforeach
            <a href="{{ route('milestones.index') }}">里程碑</a>
            <a href="{{ route('messages.index') }}">留言</a>
        </div>
        @endif
        <div>
            &copy; 2018-{{ date('Y') }} <a href="/images/truesnow-wechat-qrcode.png" target="_blank" title="微信号：{{ env('AUTHOR_WECHAT', '') }}" class="wechat-qrcode">truesnow</a> - <a href="http://www.miibeian.gov.cn" target="_blank">{{ env('ICP', '') }}</a>
        </div>
    </div>
</footer>