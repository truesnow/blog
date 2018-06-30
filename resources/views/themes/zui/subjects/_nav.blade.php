<div class="subjects-wrap">
  <h3><i class="icon-folder-close-alt"></i> 专题</h4>
  <nav class="menu" data-ride="menu" style="width: 200px">
    <ul id="treeMenu" class="tree tree-menu" data-ride="tree">
      @foreach ($subjects as $subject)
        <li>
          <a href="#">{{ $subject->name }}</a>
          <ul>
            @foreach ($subject->children as $child)
            <li><a href="#{{ $child->id }}">{{ $child->name }}</a></li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
  </nav>
</div>