<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item has-treeview {{ $item['submenu_class'] }}">

    {{-- Menu toggler --}}
    <a class="nav-link {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="" {!! $item['data-compiled'] ?? '' !!}>
        @if($item['icon'])
        <img src="{{url('../img/',$item['icon'] ?? 'setting.png')}}" alt="">
        @else
        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>
        @endif
        <p>
            {{ $item['text'] }}
            <i class="fas fa-angle-left right"></i>

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </p>

    </a>
    @if($item['text']=='Staffs')
    @php
            
    
        $item['submenu'] = \App\Models\Role_master::getMenu();
      
          
        @endphp
    @endif
    {{-- Menu items --}}
    <ul class="nav nav-treeview">
        @each('adminlte::partials.sidebar.menu-item', $item['submenu'], 'item')
    </ul>

</li>
