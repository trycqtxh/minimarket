@inject('menu', 'App\Helpers\Navigation\Contract\NavigationContract')

<p></p>
getmenu <br>
{{var_dump($menu->getMenu())}}
<p></p>
getmenu 1<br>
{{var_dump($menu->getMenu()['0'])}}
<p></p>
@foreach($menu->getMenu() as $keyMenu => $valueMenu)
    {{var_dump($valueMenu)}}

    <p></p>
    @foreach($valueMenu['submenus'] as $keySubmenu => $valSubmenu)

    @endforeach
@endforeach