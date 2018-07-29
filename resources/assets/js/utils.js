import lrz from 'lrz'

$.extend({
    /**
 * 粘贴上传图片到 Markdown 编辑器
 * @param {*} event 粘贴事件
 * @param {*} editorElement Markdown 编辑器元素
 * @param {*} source 来源
 */
    pasteUploadImage: function (event, editorElement, source = 'articles') {
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
                    lrz(reader.result, { width: 1080 }).then(function (res) {
                        $.ajax({
                            url: "/resources/editormd_paste_upload_image",
                            type: 'post',
                            data: {
                                "image": res.base64,
                                "source": source,
                                "guid": new Date().getTime()
                            },
                            contentType: 'application/x-www-form-urlencoded;charest=UTF-8',
                            success: function (data) {
                                console.log(data);
                                if (data.success === 0) {
                                    alert(data.message);
                                } else {
                                    var qiniuUrl = '![](' + data.url + ')';
                                    editorElement.insertValue(qiniuUrl);
                                }
                            }
                        })
                    });
                }
            }
        }
    }
});