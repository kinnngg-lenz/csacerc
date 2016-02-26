<script type="text/javascript">
    // TRAK IO EMBED JS
</script>

@if(Session::has('user.has.registered'))
    <script>
        trak.io.track("User Registered");
        trak.io.identify("{{ Auth::user()->email }}");
    </script>
@endif


@if(Session::has('user.has.loggedin'))
    <script>
        trak.io.identify("{{ Auth::user()->email }}", {
            email: "{{ Auth::user()->email }}",
            username: "{{ Auth::user()->username }}",
            name: "{{ Auth::user()->name }}",
            gender: "{{ Auth::user()->gender }}"
        });
    </script>
@endif
