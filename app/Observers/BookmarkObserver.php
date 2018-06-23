<?php

namespace App\Observers;

use App\Models\Bookmark;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BookmarkObserver
{
    public function created(Bookmark $bookmark)
    {
        // 排序值为空更新排序值为 ID 的值
        if (empty($bookmark->weight)) {
            $bookmark->weight = $bookmark->id;
            $bookmark->save();
        }
    }
}
