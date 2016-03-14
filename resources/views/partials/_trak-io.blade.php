 <script type="text/javascript">

 </script>

@if(Session::has('user.has.registered'))
    <script>
        calq.action.track(
                "User Registered",
                { "Email": "{{ Auth::user()->email }}" }
        );
        calq.user.identify("{{ Auth::user()->username }}");
        calq.user.profile(
                { "$full_name": "{{ Auth::user()->name }}",
                  "$email": "{{  Auth::user()->email }}",
                  "$gender": "{{ Auth::user()->gender }}"

                }
        );

        /*trak.io.track("User Registered");
        trak.io.identify("{{ Auth::user()->email }}");*/
    </script>
@endif


@if(Session::has('user.has.loggedin'))
    @if(Auth::check() && Auth::user()->banned == 0)
    <script>

        calq.action.track(
                "User Loggedin",
                { "Email": "{{ Auth::user()->email }}" }
        );
        calq.user.identify("{{ Auth::user()->username }}");
        calq.user.profile(
                { "$full_name": "{{ Auth::user()->name }}",
                    "$email": "{{  Auth::user()->email }}",
                    "$gender": "{{ Auth::user()->gender }}"
                }
        );

        /*trak.io.identify("{{ Auth::user()->email }}", {
            email: "{{ Auth::user()->email }}",
            username: "{{ Auth::user()->username }}",
            name: "{{ Auth::user()->name }}",
            gender: "{{ Auth::user()->gender }}"
        });*/
    </script>
    @endif
@endif

@if(Auth::check() && !Auth::user()->banned)
    <script>
        calq.user.identify("{{ Auth::user()->username }}");
        calq.user.profile(
                { "$full_name": "{{ Auth::user()->name }}",
                    "$email": "{{  Auth::user()->email }}",
                    "$gender": "{{ Auth::user()->gender }}"
                }
        );
    </script>
@endif

 @if(Session::has('user.has.loggedout'))
     <script>
         calq.action.track(
                 "User LoggedOut",
                 { "Email": "{{ Session::get('user.has.loggedout') }}" }
         );
         calq.user.clear();
     </script>
 @endif