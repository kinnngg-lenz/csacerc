@extends('layouts.app')
@section('styles')
    <style>
        .red{
            color:red;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div>
            <br style="clear:both">
            <div class="form-group col-md-4 ">
                <label id="messageLabel" for="message">Message </label>
                <textarea class="form-control input-sm " type="textarea" id="message" placeholder="Message" rows="7"></textarea>
                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
            </div>
            <br style="clear:both">
            <div class="form-group col-md-2">
                <button class="form-control btn btn-success disabled" id="btnSubmit" name="btnSubmit" type="button"> Send</button>
            </div>
        </div>
        </div>

@endsection

@section('scripts')
            <script>
                $(document).ready(function(){
                    $('#characterLeft').text('1500 characters left');
                    $('#message').keyup(function () {
                        var max = 1500;
                        var len = $(this).val().length;
                        console.log(max-len);
                        if (len >= max) {
                            var ch = max - len;
                            $('#characterLeft').text(ch + ' characters left');
                            $('#characterLeft').addClass('red');
                            $('#btnSubmit').addClass('disabled');
                        }
                        else {
                            var ch = max - len;
                            $('#characterLeft').text(ch + ' characters left');
                            $('#btnSubmit').removeClass('disabled');
                            $('#characterLeft').removeClass('red');
                        }
                    });
                });
            </script>
@endsection