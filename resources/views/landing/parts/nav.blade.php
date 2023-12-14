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
                            <button class="btn btn-outline-success" data-toggle="modal"
                                    data-target="#modal-window" data-action="{{ route('forms.login') }}"
                                    data-title="Login">Log in</button>
                        </div>
                        <div class="btn-wrap">
                            <button class="btn btn-outline-success" data-toggle="modal"
                                    data-target="#modal-window" data-action="{{ route('forms.register') }}"
                                    data-title="Registration">Sing up</button>
                        </div>
                    </div>
                @else
                    <div class="auth-btns">
                        <div class="btn-wrap">
                            <button class="btn btn-outline-success" onclick="window.location='/home'">My bots</button>
                        </div>
                        <div class="btn-wrap">
                            <button class="btn btn-outline-info" onclick="$('#logout-form').submit()">Log out</button>
                            <form method="POST" action="/logout" id="logout-form">@csrf</form>
                            <script defer>
                                $(document).ready(function() {
                                    let token = localStorage.getItem('access_token');
                                    let form = $('#logout-form');
                                    form.append(`<input type="hidden" name="access_token" value="${token}"/>`);
                                    form.submit((event) => {
                                        localStorage.removeItem('access_token');
                                    });
                                });
                            </script>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>
