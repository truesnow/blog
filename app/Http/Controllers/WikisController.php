<?php

namespace App\Http\Controllers;

use App\Models\TextContent;
use App\Models\WikiCate;
use App\Models\WikiItem;
use App\Models\WikiSubject;
use Illuminate\Http\Request;

class WikisController extends Controller
{
    public function index() {
        $wikiSubjects = WikiSubject::allEnabledWikis();

        return $this->view('wikis.index', compact('wikiSubjects'));
    }

    public function show(WikiSubject $wikiSubject) {
        $wikiCates = WikiCate::allEnabledCates();
        $cateToItemCountMap = WikiItem::getCateToItemCountMapBySubject($wikiSubject->id);

        return $this->view('wikis.show', compact('wikiSubject', 'wikiCates', 'cateToItemCountMap'));
    }

    public function itemIndex(WikiSubject $wikiSubject, WikiCate $wikiCate) {
        $wikiItems = WikiItem::getSubjectAllItemsByCate($wikiSubject->id, $wikiCate->id);
        $wikiCates = WikiCate::allEnabledCates();
        $cateToItemCountMap = WikiItem::getCateToItemCountMapBySubject($wikiSubject->id);

        return $this->view('wikis.items_index', compact('wikiSubject', 'wikiCate', 'wikiCates', 'wikiItems', 'cateToItemCountMap'));
    }

    public function itemShow(WikiSubject $wikiSubject, WikiCate $wikiCate, WikiItem $wikiItem)
    {
        $wikiItems = WikiItem::getSubjectAllItemsByCate($wikiSubject->id, $wikiCate->id);
        $wikiCates = WikiCate::allEnabledCates();
        $cateToItemCountMap = WikiItem::getCateToItemCountMapBySubject($wikiSubject->id);
        $textContent = TextContent::find($wikiItem->content_id);

        return $this->view('wikis.items_show', compact('wikiSubject', 'wikiCate', 'wikiCates', 'wikiItems','cateToItemCountMap', 'wikiItem', 'textContent'));
    }
}
