<li class="menu-item menu-item-submenu {{request()->is('site/*') ? 'menu-item-here menu-item-open' : ''}}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
            <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:D:\xampp\htdocs\keenthemes\legacy\keen\theme\demo1\dist/../src/media/svg/icons\Home\Key.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
                    </g>
                </svg><!--end::Svg Icon-->
            </span>
        </span>
        <span class="menu-text">
            Site
        </span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item {{Route::currentRouteName() === 'site.comments.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('site.comments.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Commentaires</span>
                </a>
            </li>
            <li class="menu-item {{Route::currentRouteName() === 'site.messages.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('site.messages.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Messages</span>
                </a>
            </li>
            <li class="menu-item {{Route::currentRouteName() === 'site.sliders.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('site.sliders.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Slider</span>
                </a>
            </li>
            <li class="menu-item {{Route::currentRouteName() === 'site.videos.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('site.videos.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Vid&eacute;os</span>
                </a>
            </li>
        </ul>
    </div>
</li>
