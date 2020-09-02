<div id="sidebar-wrapper">
    <div class="sidebar">

        <div id="sidebar-logo">
            <a class=" sidebar-toggler d-sm-none ">
                <i class="fa fa-chevron-right text-primary"></i>
            </a>
            <a id="sidebar-brand"   href="#!" class="d-block w-100">BiBC</a>
        </div>

        <div class="sidebar-content">
            <ul class="sidebar-list">

                @foreach($sidebar['menu']['items'] as $item)
                    <li class="sidebar-item">
                        <a href="{{$item['href']}}" class="sidebar-link {!!((isset($active) && $active==$item['name']) ? 'active' : '')!!}">
                            <i class="fa {{$item['icon']}} fa-fw ml-2 fa-lg"></i>{{$item['title']}}</a>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>
</div>