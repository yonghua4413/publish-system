@extends("layouts.main")
@section("content")
    <div class="fly-panel">
        <div class="fly-panel-title fly-filter"><a>置顶</a></div>
        <ul class="fly-list">
            @foreach($recommend as $item)
                <li>@include("common.publishItem")</li>
            @endforeach
        </ul>
    </div>
    <div class="fly-panel" style="margin-bottom: 0;">

        <div class="fly-panel-title fly-filter">
            <span class="fly-filter-left layui-hide-xs">
                @if($type == 1)
                    <a href="/?type=1" class="layui-this">按最新</a>
                @else
                    <a href="/?type=1">按最新</a>
                @endif
                <span class="fly-mid"></span>
                @if($type == 2)
                    <a href="/?type=2" class="layui-this">按热门</a>
                @else
                    <a href="/?type=2">按热门</a>
                @endif
            </span>
        </div>

        <ul class="fly-list">
            @foreach($list as $item)
                <li>@include("common.publishItem")</li>
            @endforeach
        </ul>
    </div>
@endsection

@section("js")
@endsection