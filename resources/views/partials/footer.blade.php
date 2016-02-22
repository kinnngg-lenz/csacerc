<footer class="footer" style="    padding: 25px 0;
    background: #0b1e35;color: #f6f6f6">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <p class="copyright">
                    <i class="fa fa-copyright"></i> Department of Computer Science - ACERC, {{ date('Y') }}. Some rights
                    reserved.
                </p>

                <div class="text-muted small">
                    <i class="fa fa-code"></i> Developed by <b>Students of CS Department ACERC - 3<sup>rd</sup> Year</b>
                </div>
            </div>

            <div class="col-md-5">
                {{ Form::open(['route' => ['newsletter.subscribe']]) }}
                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input name="email" class="form-control" value="{{ old('email') }}" type="text" placeholder="Signup for the Weekly Newsletter" required>
                                    <span class="add-on input-group-btn">
                                        <button class="btn btn-info">
                                            Subscribe
                                        </button>
                                    </span>
                        </div>
                        @if ($errors->has('ends_at'))
                            <span class="help-block">
                            <strong>{{ $errors->first('ends_at') }}</strong>
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