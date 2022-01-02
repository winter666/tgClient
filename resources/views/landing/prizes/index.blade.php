@extends('landing.index')

@section('css-links')
    <style>
        .content-block .tasks {
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    @include('landing.parts.nav')
    <div class="header-block d-flex flex-column justify-content-end">
        <div class="container">
            <div class="ml-2">
                <h1>Prizes on Service</h1>
                <p>Get prizes by completing tasks</p>
            </div>
        </div>
    </div>
    <div class="content-block">
        <div class="container">
            <h2>How it works?</h2>
            <p>After you sign up and choose a plan,
                several tasks will be available to you,
                for the passage of which you will receive prizes</p>
            <p>
                Prizes can be discount on a subscription or an additional bot.
            </p>
            <div>
                <span>Start now and get your prizes!</span>
            </div>
            <div class="tasks d-flex flex-wrap justify-content-between">
                <div class="card w-25">
                    <div class="card-header">
                        <h4>Follow on Instagram</h4>
                    </div>
                    <div class="card-body">
                        <p>+ 1 bot</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success"
                                @guest
                                onclick="window.location = '/login'"
                                @else
                                onclick="window.location = '/home/prizes'"
                            @endguest>Get started</button>
                    </div>
                </div>
                <div class="card w-25">
                    <div class="card-header">
                        <h4>Join on Telegram channel</h4>
                    </div>
                    <div class="card-body">
                        <p>+ 1 bot</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success"
                                @guest
                                onclick="window.location = '/login'"
                                @else
                                onclick="window.location = '/home/prizes'"
                            @endguest>Get started</button>
                    </div>
                </div>
                <div class="card w-25">
                    <div class="card-header">
                        <h4>Invite a friends</h4>
                    </div>
                    <div class="card-body">
                        <p>10% discount for one friend, 15% for two and 20% for three</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success"
                                @guest
                                onclick="window.location = '/login'"
                                @else
                                onclick="window.location = '/home/prizes'"
                            @endguest>Get started</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
