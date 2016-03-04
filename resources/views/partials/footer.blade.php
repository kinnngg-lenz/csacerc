<style>
    .subscriber_email_input {
        font-size: 14px;
    }

    @media (max-width: 767px) {
        .subscriber_email_input {
            font-size: 12px;
        }
        .footer-social-icon
        {
            margin-top:13px !important;
        }

        .copyright {
            font-size: 14px;
        }

        .developed_by {
            font-size: 12px;
            padding-bottom: 10px;
        }
    }

    .animate-heart {
        font-size: 2rem;
        /*-webkit-animation: fa-beat 2s infinite linear;
        animation: fa-beat 2s infinite linear;*/
    }
    /*
    @-webkit-keyframes fa-beat {
        0% {
            font-size: 1em;
        }
        100% {
            font-size:2em;
        }
    }
    @keyframes fa-beat {
        0% {
            font-size: 1em;
        }
        100% {
            font-size: 2em;
        }
    }*/
</style>
<footer class="footer" style="    padding: 25px 0;
    background: #232323;color: #f6f6f6">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <p class="copyright">
                    <i class="fa fa-copyright"></i> Department of Computer Science - ACERC, {{ date('Y') }}. All rights
                    reserved. Yes! All of them
                </p>

                <div class="developed_by text-muted small">
                    <i class="fa fa-2x fa-code" style="color: #3498DB;"></i> by Dept. of Computer Science at Arya College of Engg &amp; Research Center
                </div>
            </div>

            @unless(csrf_token() == null)
                <div class="col-md-5">
                    {{ Form::open(['name' => 'newsletter', 'route' => ['newsletter.subscribe']]) }}
                    <div class="{{ !isset($errors) || is_null($errors) || $errors=='' ? '' : $errors->has('subscriber_email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <div class="input-group">
                                {{ Form::text('subscriber_email',null,['class' => 'subscriber_email_input form-control', 'placeholder' => Agent::isMobile() ? "Opt for Newsletter" : "Opt for the Weekly Newsletter"]) }}
                                <span class="add-on input-group-btn">
                                        <button class="btn btn-info">
                                            Subscribe
                                        </button>
                                    </span>
                            </div>
                            @if (isset($errors) && $errors->has('subscriber_email'))
                                <span class="help-block">
                            <strong>{{!isset($errors) || is_null($errors) || $errors=='' ? '' : $errors->first('subscriber_email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            @endunless
        </div>

        <div class="row">
            <div class="col-md-8 hidden-xs">
                <a data-toggle="tooltip" title="Bug Report or Feedback" class="btn btn-xs btn-primary" href="mailto:zishanansari1337@gmail.com"><i class="fa fa-bug"></i></a>
                <a data-toggle="tooltip" title="View Source Code" class="btn btn-xs btn-primary" target="_blank" href="https://github.com/kinnngg-lenz/csacerc"><i
                            class="fa fa-github"></i></a>
            </div>
            <div class="col-md-4 text-right footer-social-icon" style="margin-left:-10px;">
                <a class="facebookBtn" target="_blank" data-toggle="tooltip" title="Our Facebook Page"
                   href="http://acerc.org"><i class="fa fa-2x fa-facebook"></i></a>
                <a class="googleBtn" target="_blank" data-toggle="tooltip" title="Our Google+ Page"
                   href="http://acerc.org"><i class="fa fa-2x fa-google"></i></a>
                <a class="twitterBtn" target="_blank" data-toggle="tooltip" title="Our Twitter Page"
                   href="http://acerc.org"><i class="fa fa-2x fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

@include('partials._google-analytics')
