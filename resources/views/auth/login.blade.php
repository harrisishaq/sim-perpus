@extends('layouts.auth')

@section('page-title', trans('Login'))

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        
    </div>
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-8 col-11 d-flex justify-content-center">
                <div class="card bg-authentication rounded-0 mb-0">
                    <div class="row m-0">
                        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                            <img src="../../../app-assets/images/pages/login.png" alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="card rounded-0 mb-0 px-2">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Login</h4>
                                    </div>
                                </div>
                                <p class="px-2">Welcome back, please login to your account.</p>
                                <div class="card-content">
                                    <div class="card-body pt-1">
                                        @include('partials.messages')
                                        <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off" class="mt-1">
                                            <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                                            @if (Request::has('to'))
                                            <input type="hidden" value="{{ Input::get('to') }}" name="to">
                                            @endif
                                            <div class="form-group">
                                                <label for="username" class="sr-only">@lang('Username')</label>
                                                <input type="text" name="username" id="username" class="form-control input-solid" placeholder="@lang('Email or Username')" value="{{ old('username') }}">
                                            </div>
                                            <div class="form-group password-field">
                                                <label for="password" class="sr-only">@lang('Password')</label>
                                                <input type="password" name="password" id="password" class="form-control input-solid" placeholder="@lang('Password')">
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                                                    @lang('Log In')
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@stop

@section('scripts')
    {!! HTML::script('login-assets/js/as/login.js') !!}
@stop
