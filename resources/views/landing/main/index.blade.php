@extends('landing.index')

@section('css-links')
    <link href="{{ asset('/css/landing/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/landing/about.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/landing/pricing.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    @include('landing.parts.header')
    <div class="content-block">
        <div class="container">
            <div id="about">
                <h2>About Project</h2>
                <div class="d-flex flex-column">
                    <p>Join us and make your telegram - bot</p>
                    <div class="about-info__img-width">
                        <div id="about-animation"></div>
                        <img src="{{ asset('/img/telegram-chatbot-1.png') }}" alt="telegram picture"/>
                    </div>
                    <div>
                        <h3 class="mt-4">What bots can I make?<strong>*</strong></h3>
                        <p>
                            <strong>*At the moment, it is possible to create only chat bots.</strong>
                        </p>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="w-50">
                                <div class="h-75 d-flex flex-column justify-content-center">
                                    <h4>Telegram chat-bot</h4>
                                    <p>By customizing the logic and algorithms of communication with your users,
                                        you can create a telegram chat bot</p>
                                </div>
                            </div>
                            <div class="w-50 d-flex justify-content-center">
                                <div class="about-info__img-height">
                                    <img src="{{ asset('/img/chat.png') }}" alt="telegram chat bot picture"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($pricing->count())
                <div id="pricing">
                    <h2>Pricing</h2>
                    <div id="pricing-items" class="d-flex justify-content-between">
                        @foreach($pricing as $price)
                            <div class="card pricing-item">
                                <div class="card-body">
                                    <h4 class="font-weight-bold">{{ $price->name }}</h4>
                                    <p>{{ $price->description }}</p>
                                    <div>
                                        <div>price: {{ $price->price }}</div>
                                    </div>
                                    <div>
                                        <div>count of bot at account: {{ $price->bot_count }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        @auth
                                            <button class="btn btn-success">Subscribe</button>
                                        @else
                                            <button class="btn btn-info">Get started</button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        const scrollLink = (event) => {
            event.preventDefault();
            let target = event.currentTarget;
            let linkTo = target.dataset.target;
            let block = document.getElementById(linkTo);
            let blockY = block.getBoundingClientRect().y;
            let bodyY = document.body.getBoundingClientRect().y;
            let blockPosition = blockY - bodyY;
            window.scrollTo({left: 0, top: blockPosition, behavior: 'smooth'});
        }

        let aboutAnimBlock = document.getElementById('about-animation');
        aboutAnimBlock.style.position = 'absolute';
        aboutAnimBlock.style.top = "20%";
        aboutAnimBlock.style.left = "25%";
        aboutAnimBlock.style.transition = '.7s';
        aboutAnimBlock.style.opacity = '0';
        const animationAboutLabel = (event) => {
            let screenWidth = window.innerWidth;
            let windowY = event.currentTarget.scrollY;
            let aboutBlockY = aboutAnimBlock.getBoundingClientRect().y
            let aboutBlockPosY = aboutBlockY - windowY;
            let fontSize = "3rem";
            if (screenWidth >= 993) {
                fontSize = "11rem";
            } else if (screenWidth >= 992) {
                fontSize = "10rem";
            } else if (screenWidth >= 768) {
                fontSize = "8rem";
            } else if (screenWidth >= 575) {
                fontSize = "6rem";
            } else if (screenWidth <= 574 && screenWidth >= 421) {
                fontSize = "5rem";
            } else if (screenWidth > 320 && screenWidth <= 420) {
                fontSize = "4rem";
            }

            aboutAnimBlock.innerHTML = `<span style="font-size: ${fontSize}; color: #3f3f3f;">About</span>`;
            if (aboutBlockPosY < 0 && windowY !== 0) {
                aboutAnimBlock.style.opacity = '3';
            }
        }

        const onScrollHandlers = (event) => {
            animationAboutLabel(event);
        }

        window.onscroll = onScrollHandlers;

        let aboutLink = document.getElementById('about-link');
        aboutLink.addEventListener('click', scrollLink);
        let pricingLink = document.getElementById('pricing-link');
        pricingLink.addEventListener('click', scrollLink);

    </script>
@endsection
