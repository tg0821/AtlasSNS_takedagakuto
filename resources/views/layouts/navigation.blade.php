        <div id="head">
            <a href="{{ url('top') }}"><img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo"></a>
            <div id="menu-container">

                    <p class=user-name>{{ Auth::user()->username }}さん</p>

                <button id="menu-toggle" aria-expanded="false">∨</button>

                @if (Auth::user()->icon_image!="icon1.png")
                <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="User Icon" class="user-icon"/>
                @else
                <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" />
                @endif
                <ul id="accordion-menu" class="hidden">
                    <li><a href="{{ url('top') }}">ホーム</a></li>
                    <li><a href="{{ url('profile') }}">プロフィール</a></li>
                    <!-- ログアウト機能実施のためrouteに変更　web.phpの中に新たにログアウトのrouteを追加 -->
                    <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
                    </li>
                </ul>
            </div>
        </div>
<script src="{{ asset('js/script.js') }}"></script>
