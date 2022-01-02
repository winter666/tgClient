<div class="sticky-top">
    <div class="navigation-block">
        <div class="container">
            <div class="navigation-block__inner">
                <div class="navigation">
                    <div class="nav">
                        <div class="nav-item">
                            <a class="nav-link" href="/">Main</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/#about" id="about-link" data-target="about">About</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/#pricing" id="pricing-link" data-target="pricing">Pricing</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/prizes">Prizes</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/term-of-service">Term of Service</a>
                        </div>
                    </div>
                </div>
                @guest
                    <div class="auth-btns">
                        <div class="btn-wrap">
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modal-window">Log in</button>
                        </div>
                        <div class="btn-wrap">
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modal-window">Sing up</button>
                        </div>
                    </div>
                @else
                    <div class="auth-btns">
                        <div class="btn-wrap">
                            <button class="btn btn-outline-success" onclick="window.location='/home/my-bots'">My bots</button>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        // TODO: написать скрипт для получения и отправки формы для авторизации и регистрации
    </script>
@endsection
