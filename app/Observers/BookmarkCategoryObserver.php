<?php

namespace App\Observers;

use App\Models\BookmarkCategory;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BookmarkCategoryObserver
{
    public function created(BookmarkCategory $bookmark_category)
    {
        // 排序值为空更新排序值为 ID 的值
        if (empty($bookmark_category->weight)) {
            $bookmark_category->weight = $bookmark_category->id;
            $bookmark_category->save();
        }
    }
}
