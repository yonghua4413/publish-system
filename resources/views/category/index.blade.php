@extends("layouts.main")

@section("content")
    <div class="fly-panel" style="margin-bottom: 0;">

        <ul class="fly-list">
            @foreach($list as $item)
                <li>@include("common.publishItem")</li>
            @endforeach
        </ul>

        <!-- <div class="fly-none">没有相关数据</div> -->
        <div style="text-align: center">
            @include("common.page")
        </div>

    </div>
@endsection