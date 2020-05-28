@if($totalRow > $pageSize)
    <div class="laypage-main">
        @if($totalPage <= 10 || $page < 6)
            @if($page == 1)
                <span class="laypage-curr">1</span>
            @else
                <a href="?page=1">1</a>
            @endif
            @for($i = 2; $i < $totalPage; $i++)
                @if($page != $i)
                    <a href="?page={{$i}}">{{$i}}</a>
                @else
                    <a class="laypage-curr">{{$i}}</a>
                @endif
            @endfor
            @if($totalPage == $page)
                @if($totalPage < 10)
                    <a class="laypage-curr">{{$totalPage}}</a>
                @else
                    <a class="laypage-curr">尾页</a>
                @endif
            @else
                @if($totalPage < 10)
                    <a href="?page={{$totalPage}}">{{$totalPage}}</a>
                @else
                    <a href="?page={{$totalPage}}">尾页</a>
                @endif
            @endif
        @else
            @if($page == 1)
                <span class="laypage-curr">首页</span>
            @else
                <a href="?page=1">首页</a>
            @endif
            <span>…</span>
            <a href="?page={{$page-2}}">{{$page-2}}</a>
            <a href="?page={{$page-1}}">{{$page-1}}</a>
            <a class="laypage-curr" href="?page={{$page}}">{{$page}}</a>
            @if($page+1 < $totalPage)
                <a href="?page={{$page+1}}">{{$page+1}}</a>
            @endif
            @if($page+2 < $totalPage)
                <a href="?page={{$page+2}}">{{$page+2}}</a>
            @endif
            @if($totalPage-$page > 3)
                <span>…</span>
            @endif
            @if($page != $totalPage)
                <a href="?page={{$totalPage}}">{{$totalPage}}</a>
            @endif
        @endif
    </div>
@endif