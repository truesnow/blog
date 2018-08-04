
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
//

$.extend({
    /**
     * 滚动固定
     */
    scrollFixed: function (ele) {
        var eleOffset = ele.offset().top;
        $(window).scroll(function(){
            var scrollPos = $(window).scrollTop();
            if(scrollPos >= eleOffset){
                ele.addClass("fixed");
            }else{
                ele.removeClass("fixed");
            }
        });
    }
});

function footerFixed()
{
    // 页面高度小于浏览器高度时，设置为页脚在底部固定
    if ($(document.body).height() < $(window).height()) {
        $('.yield-content').css({
            marginBottom: '100px'
        });
        $('footer.page-footer').css({
            position: 'fixed',
            bottom: 0,
            width: '100%'
        });
    }
}

$(document).ready(function() {
    if ($(".menu").length) {
        $.scrollFixed($(".menu"));
    }
    footerFixed();
    // 点击 TAB 导航时固定底部导航
    $('.nav li').on('click', function () {
        footerFixed();
    });
    // 设置 Ajax 请求全局 loading，如无需 loading，在 ajax 方法中设置 global 为 false
    $(document).bind("ajaxSend", function () {
        ajax_loading_index = layer.load(1, {
            shade: [0.1, '#fff'], //0.1透明度的白色背景
            time: 15 * 1000
        });
    }).bind("ajaxComplete", function () {
        layer.close(ajax_loading_index);
    });
});
