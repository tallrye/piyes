@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="jumbotron">
                    <h1>About Piyes</h1>
                    <p>
                        <a class="githubLink" href="https://github.com/tallrye/piyes" target="_blank">
                            <i class="fa fa-github"> Check The Code On Github</i>
                        </a>
                    </p>
                    
                    <hr>
                    <p>
                        Login credentials are: <br>
                        <strong>email:</strong> s_uzuncavdar@hotmail.com <br>
                        <strong>pass:</strong> dummydum
                        <br>
                        <br>
                        <a href="{{ route('login') }}" class="btn btn-primary fullWidth"><i class="fa fa-sign-in"></i> Login Now</a>
                    </p>
                    <hr>
                    <h3>Built with Laravel 5.4</h3>
                    <p>I've used Laravel's latest release to build Piyes. I've also implemented following PHP components:</p>
                    <ul>
                        <li>intervention/image</li>
                        <li>laravelcollective/html</li>
                        <li>mcamara/laravel-localization</li>
                        <li>nesbot/carbon</li>
                    </ul>
                    <hr>
                    <h3>Mailing</h3>
                    <p>I've used Mailtrap.io for development, Mailgun on production.</p>
                    <hr>
                    <h3>Google Analytics API</h3>
                    <p>Thanks to <a class="link" href="https://github.com/spatie/laravel-analytics" target="_blank">spatie/laravel-analytics</a>, all Google Analytics data in the dashboard comes from my <a class="link" target="_blank" href="http://serhatuzuncavdar.com">personal website</a></p>
                    <img src="{{ url('piyes/img/screenshots/google_api.png') }}" class="img-responsive fullWidth" alt="">
                    <hr>
                    <h3>Contact Form Messages Goes To Inbox</h3>
                    <p>All forms are editable from the Piyes. Once you create a contact form, you can also specify where those messages should be redirected to. Surely, a developer touch is required to connect right form from right page. But this way, once website is built, you can always manage recievers seperately, form by form.</p>
                    <img src="{{ url('piyes/img/screenshots/forms.png') }}" class="img-responsive fullWidth" alt="">
                    <br>
                    <p>And all those messages are accessible through the Inbox. You can always access messages from your website using Piyes Inbox</p>
                    <img src="{{ url('piyes/img/screenshots/inbox.png') }}" class="img-responsive fullWidth" alt="">
                    <br>
                    <p>You can reply a message, compose new message, mark as imporant or move to trash. Basic stuff...</p>
                    <hr>
                    <h3>User Management, Roles &amp; Permissions</h3>
                    <p>You can invite new users, block existing user, give them roles, and give roles permissions.</p> 
                    <p>Alson, user's can follow standart "Forgot Password" steps to re-generate their passwords. This is basic Laravel.</p>
                    <hr>
                    <h3>Basic To-Do App</h3>
                    <p>Piyes comes also with basic to-do planner. You should check it out! Create, update and complete tasks with ease-of-use, using Jquery UI.</p>
                    <hr>
                    <h3>Some Front-End Features</h3>
                    <p>This is application focused on front-end skills, however, here are some technologies I've enjoyed while crafting Piyes:</p>
                    <ul>
                        <li>Vue JS</li>
                        <li>ChartJS</li>
                        <li>Select2</li>
                        <li>JCrop</li>
                        <li>DataTables</li>
                        <li>Bootstrap Datetime-Picker</li>
                    </ul>
                    <hr>
                    <a href="{{ route('login') }}" class="btn btn-primary fullWidth"><i class="fa fa-sign-in"></i> Login Now</a>
                </div>
            </div>
            <div class="col-md-3">
                @include('_aside')
            </div>
        </div>
    </div>
</div>
@endsection