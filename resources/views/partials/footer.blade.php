<style>
    .subscriber_email_input
    {
        font-size:14px;
    }
    @media (max-width: 767px)
    {
        .subscriber_email_input
        {
            font-size:12px;
        }
        .copyright
        {
            font-size:14px;
        }
        .developed_by
        {
            font-size: 12px;
            padding-bottom: 10px;
        }
    }
</style>
<footer class="footer" style="    padding: 25px 0;
    background: #0b1e35;color: #f6f6f6">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <p class="copyright">
                    <i class="fa fa-copyright"></i> Department of Computer Science - ACERC, {{ date('Y') }}. Some rights
                    reserved.
                </p>

                <div class="developed_by text-muted small">
                    <strong><i class="fa fa-2x fa-code"></i></strong>&nbsp; by students of CS department ACERC - 3<sup>rd</sup> Year
                </div>
            </div>

            <div class="col-md-5">
                {{ Form::open(['name' => 'newsletter', 'route' => ['newsletter.subscribe']]) }}
                <div class="{{ $errors->has('subscriber_email') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input name="subscriber_email" class="subscriber_email_input form-control" value="{{ old('subscriber_email') }}" type="text" placeholder="{{ Agent::isMobile() ? "Opt for Newsletter" : "Opt for the Weekly Newsletter" }}" required>
                                    <span class="add-on input-group-btn">
                                        <button class="btn btn-info">
                                            Subscribe
                                        </button>
                                    </span>
                        </div>
                        @if ($errors->has('subscriber_email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('subscriber_email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>

        <div class="text-center hidden-xs">
        <a class="btn btn-sm btn-primary" href="mailto:zishanansari1337@gmail.com"><i class="fa fa-bug"></i> Bug Report</a>
            <a class="btn btn-sm btn-primary" target="_blank" href="https://github.com/kinnngg-lenz/csacerc"><i
                        class="fa fa-github"></i> View Source</a>
        </div>
    </div>
</footer>