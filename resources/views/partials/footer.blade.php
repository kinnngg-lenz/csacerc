<footer class="footer" style="    padding: 25px 0;
    background: #0b1e35;color: #f6f6f6">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <p class="copyright">
                    &copy; Department of Computer Science - ACERC, {{ date('Y') }}. All rights reserved.
                </p>

                <div class="text-muted small">
                    Proudly developed by <b>Students of CS Department ACERC - 3<sup>rd</sup> Year</b>
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
    </div>
</footer>