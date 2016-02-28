@unless(Agent::isMobile())
<div id="wrapper" class="hidden-xs">
    <div id="slider">
        <div class="slide" style="background: url(images/static/slider1.jpg) no-repeat;background-size: cover">
            <div class="slide-block">
                <h4>Welcome {{ Auth::check() ? studly_case(Auth::user()->username) : "Guest" }}!</h4>
                <p>Heading south to avoid a bad case of global frostbite, a group of migrating misfit creatures embark on a hilarious quest to reunite a human baby with his tribe.</p>
            </div>
        </div>

        <div class="slide" style="background: url(images/static/slider2.jpg) no-repeat;background-size: cover">
            <div class="slide-block">
                <h4>For The Birds</h4>
                <p>For the Birds is an animated short film, produced by Pixar Animation Studios released in 2000. It is shown in a theatrical release of the 2001 Pixar feature film Monsters, Inc.</p>
            </div>
        </div>

        <div class="slide" style="background: url(images/static/slider3.jpg) no-repeat;background-size: cover">
            <div class="slide-block">
                <h4>UP</h4>
                <p>A comedy adventure in which 78-year-old Carl Fredricksen fulfills his dream of a great adventure when he ties thousands of balloons to his house and flies away to the wilds of South America.</p>
            </div>
        </div>

        <div class="slide" style="background: url(images/static/slider4.jpg) no-repeat;background-size: cover">
            <div class="slide-block">
                <h4>UP</h4>
                <p>A comedy adventure in which 78-year-old Carl Fredricksen fulfills his dream of a great adventure when he ties thousands of balloons to his house and flies away to the wilds of South America.</p>
            </div>
        </div>

    </div>
</div>
@endunless
