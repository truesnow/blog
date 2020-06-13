<?php

namespace App\Admin\Actions\Abbr;

use App\Models\Abbr;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class BatchCreate extends Action
{
    protected $selector = '.batch-create';

    public function handle(Request $request)
    {
        // 每行一个 A = B = C 格式的数据，空行跳过
        $data = $request->data;
        if ($data == '') {
            return $this->response()->warning('请输入数据');
        }
        $dataArr = explode("\n", $data);
        $abbrs = [];
        $failLine = [];
        foreach ($dataArr as $data) {
            if (empty($data)) {
                continue;
            }
            $abbrArr = explode("=", $data);
            if (count($abbrArr) != 3) {
                // 非 A=B=C 格式
                $failLine[] = $data;
                continue;
            }
            $abbr = [
                'abbr' => trim($abbrArr[0]),
                'full_name' => trim($abbrArr[1]),
                'cn_name' => trim($abbrArr[2]),
            ];
            $abbrs[] = $abbr;
        }
        Abbr::insert($abbrs);

        $total = count($dataArr);
        $success = count($abbrs);
        if ($total == $success) {
            return $this->response()->success('批量新增成功')->refresh();
        }
        $msg = sprintf('导入结果：%d/%d，失败%d条：<br>%s', count($abbrs), count($dataArr), count($failLine), implode("<br>", $failLine));

        return $this->response()->warning($msg)->refresh();
    }

    public function form() {
        $this->textarea('data', '填入数据（每行一条，格式：A = B = C）');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success batch-create">批量新增</a>
HTML;
    }
}