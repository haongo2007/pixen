<!DOCTYPE html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Introduce</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/all.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/slick.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/jquery.rateyo.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/daterangepicker.css">
    <link  rel="stylesheet" href="{{ asset('css') }}/home.css">
</head>
<body>
    <!-- start content -->
    <div class="container-fluid introduce has-btn-footer">
        <div class="introduce__content">
            <a href="javascript:history.back()" class="back">&lt; Back</a>
            <div class="d-flex">
                <h1>
                    픽센
                </h1>
                <div class="introduce__reason">
                    <p class="title">Why should you trust our member?</p>
                    <div class="introduce__reason introduce__reason-1">
                        <p class="sub">An evaluation system</p>
                        <p>This system has as its goal to evaluate our members and to give them an indicative grade based on their level of satisfaction.</p>
                    </div>
                    <div class="introduce__reason introduce__reason-2">
                        <p class="sub">Branding</p>
                        <div class="level">
                            <div class="row">
                                <div class="col-9">Begin</div>
                                <span class="dot"></span>
                            </div>
                            <div class="row"><div class="col-9">Intermediate</div>  <span class="dot"></span><span class="dot"></span></div>
                            <div class="row"><div class="col-9">Advanced </div><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="introduce__reason-single">
                <div class="introduce__reason introduce__reason-3">
                    <p class="sub">What to do in case there is a problem?</p>
                    <p>If the traveler has to cancel his trip or has a transportation problem, he needs to make it known as soon as possible to the requester (preferably via the message on the site for the reasons explained above).</p>
                </div>
            </div>
            <div class="introduce__reason-single">
                <div class="introduce__reason introduce__reason-3">
                    <p class="sub">Rules for a successful delivery</p>
                    <p>- Respect - "I only deliver what I can see" that mean Never accept a closed package.- Set up a meeting in a public place.- Answer messages: Answer all of your messages, even if you are unable to carry out the delivery or the trip in order that the other party knows what to expect.- Have to give all information about the items: whether it's the traveler or the requester, the users will be the more reassured when they are well informed about what they are transporting and who they are dealing with.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content -->
</body>
</html>
