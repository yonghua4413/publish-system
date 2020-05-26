<div class="fly-panel fly-link">
    <h3 class="fly-panel-title">友情链接</h3>
    <dl class="fly-panel-main">
        @foreach($blogroll as $item)
        <dd><a href="{{$item['link']}}" target="_blank">{{$item['name']}}</a><dd>
        @endforeach
    </dl>
</div>