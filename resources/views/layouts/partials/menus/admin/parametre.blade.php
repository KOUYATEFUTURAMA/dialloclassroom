<li class="menu-item menu-item-submenu {{request()->is('parametre/*') ? 'menu-item-here menu-item-open' : ''}}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
            <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:D:\xampp\htdocs\keenthemes\legacy\keen\theme\demo1\dist/../src/media/svg/icons\Home\Key.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon-->
            </span>
        </span>
        <span class="menu-text">
            Parametre
        </span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item {{Route::currentRouteName() === 'parametre.categories.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('parametre.categories.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Cat&eacute;gorie des cours</span>
                </a>
            </li>
            <li class="menu-item {{Route::currentRouteName() === 'parametre.modes.index' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('parametre.modes.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Mode des cours</span>
                </a>
            </li>
            <li class="menu-item {{Route::currentRouteName() === 'parametre.categorie-blog' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('parametre.categorie-blog')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Cat&eacute;gorie blog</span>
                </a>
            </li>
        </ul>
    </div>
</li>
