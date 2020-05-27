<div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
    <h3 class="fly-panel-title">活跃用户</h3>
    <dl>
        @foreach($hot_user as $item)
        <dd>
            <a href="/user/publish{{$item['user_id']}}">
                <img src="{{$item['head_img']}}"><cite>{{$item['user_name']}}</cite><i>{{$item['num']}} 次发布</i>
            </a>
        </dd>
        @endforeach
    </dl>
</div>