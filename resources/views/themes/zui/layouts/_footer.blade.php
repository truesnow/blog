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
        </div>
        @endif
        <div>
            CopyRight &copy; 2018 <a href="/images/truesnow-wechat-qrcode.png" target="_blank" title="微信号：541817418" class="wechat-qrcode">CX</a> - <a href="http://www.miibeian.gov.cn" target="_blank">赣ICP备16010520号-1</a>
        </div>
    </div>
</footer>