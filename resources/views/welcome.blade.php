@extends('layouts.app')
@section('title', 'Home')
@section('styles')
    <style>
        #didyouknow
        {
            font-weight:300;
        }
        @media (max-width: 767px) {
            .quote-container {
                margin-top: -28px;
            }

            .grid-item {
                width: 100%;
            }
        }

        @media screen and (min-width: 768px) {
            .grid-item {
                width: 380px;
            }
        }

        .quote-container {
            -webkit-border-radius: 0px !important;
            -moz-border-radius: 0px !important;
            border-radius: 0px !important;
            padding: 10px !important;
        }

        .text-lg {
            font-size: 1.5em !important;
            font-family: "Trebuchet MS", Verdana, sans-serif;
        }

        .thumbnail {
            border-radius: 0px !important;
            margin: 0;
        }

        .no-border {
            border: none !important;
        }

        .panel, .panel-heading {
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }
        .font14
        {
            font-size: 14px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.carousel')

            <div class="jumbotron text-center quote-container">
                <p id="ajaxinspire">
                    <span class="inspire text-{{ ['warning','success','info', 'danger', 'yellow', 'pink', 'green', 'violet', 'muted'][array_rand([0,1,2,3,4,5,6,7,8])] }}"><span
                                class="text-lg">&#8220;</span> {{ Illuminate\Foundation\Inspiring::quote() }} <span
                                class="text-lg">&#8221;</span></span>
                </p>
            </div>

            <div class="col-md-12">
                <div class="container" style="padding: 0;">
                    <div class="grid">

                        {{--News Starts--}}
                        <div class="col-sm-7 grid-item col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Latest News</b></div>
                                <div class="panel-body no-padding">
                                    <div class="thumbnail no-border">
                                        <img data-src="holder.js/100%x200" alt="100%x200"
                                             src="{{ route('make.thumbnail',[$news->photo->url]) }}" data-holder-rendered="true"
                                             style="height: 100%; width: 500px; display: block;">
                                        <div class="caption">
                                            <p class="blockquote-reverse">
                                        <span class="text-small">
                                            {{ $news->created_at->toDayDateTimeString() }} <br>
                                            {{--({{ $news->created_at->diffForHumans() }}) <br>--}}
                                        </span>
                                            </p>
                                            <h3 class="text-bold padding10 title">{{ $news->title }}</h3>
                                            <i class="padding10 small text-muted">By {{ $news->user->name }}</i>
                                            <p class="padding10 text-justify">
                                                {!! nl2br($news->description) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--News Ends--}}

                        {{--Event Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Latest Event</b></div>
                                <div class="panel-body no-padding">
                                    <div class="thumbnail no-border">
                                        <img data-src="holder.js/100%x200" alt="100%x200"
                                             src="{{ route('make.thumbnail',[$event->photo->url]) }}" data-holder-rendered="true"
                                             style="height: 100%; width: 500px; display: block;">
                                        <div class="caption">
                                            <h4>{{ $event->name }}</h4>
                                            <p class="text-justify">
                                                {!! nl2br($event->description) !!}
                                            </p>
                                            <p class="blockquote-reverse">
                                                <b>Venue:</b> {{ $event->venue }}<br>
                                        <span class="text-small">
                                            {{ $event->date->toFormattedDateString() }}
                                            <br> ({{ $event->date->diffForHumans() }})</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Event Ends--}}

                        {{--CodeWar Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Latest Codewars</b></div>
                                <div class="panel-body no-padding">
                                    @foreach($codewars as $codewar)
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <a href="{{ route('codewar.show',$codewar->slug) }}">
                                                    <h4>{{ $codewar->title }}</h4></a>
                                                <p class="blockquote-reverse">
                                                    <span class="text-muted">Total Answers: </span>
                                                    <i>
                                    <span class="badge">
                                        {{  $codewar->answers->count() }}
                                    </span>
                                                    </i><br>
                                                <p class="blockquote-reverse">
                                                    <i><span class="text-small">Started {{  $codewar->created_at->diffForHumans() }}</span></i>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--CodeWar Ends--}}

                        {{--Question Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Latest Questions</b></div>
                                <div class="panel-body no-padding">
                                    @foreach($questions as $question)
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <a href="{{ route('questions.show',$question->slug) }}">
                                                    <h4>{{ str_limit($question->question,50) }}</h4></a>
                                                <p class="blockquote-reverse">
                                                    <i><span class="text-small">Asked {{  $question->created_at->diffForHumans() }}</span></i>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--Question Ends--}}

                        {{--Latest Signups Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Latest Members</b></div>
                                <div class="panel-body no-padding">
                                    @foreach($users as $user)
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <a href="{{ route('users.profile.show',$user->username) }}">
                                                    <h4>
                                                        <img class="img" src="{{ $user->photo_id == null ? "/images/".$user->getProfilePicUrl() : "/image/".$user->getProfilePicUrl()."/thumbnail/30" }}" width="20" height="20"/>
                                                            {{ $user->name }}
                                                        <i class="small">{{ "@".$user->username }}</i>
                                                    </h4></a>
                                                <p class="blockquote-reverse">
                                                    <i><span class="text-small">Joined {{  $user->created_at->diffForHumans() }}</span></i>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--Latest Signups Ends--}}

                        @foreach($aluminis as $alumini)
                            {{--Alumini 1 Starts--}}
                            <div class="col-sm-6 grid-item col-md-4">
                                <blockquote class="example-{{ ['obtuse','right','wrong'][array_rand([0,1,2])] }}">
                                    <p class="text-justify font14">
                                        {!! nl2br(htmlentities($alumini->speech)) !!}
                                    </p>
                                </blockquote>
                                <p>
                                    <b> - {{ $alumini->speaker }}</b><br>
                                        <span class="text-small">
                                            {{ $alumini->department->name }} ({{ $alumini->batch }}) <br> ({{ $alumini->profession }} {{ $alumini->organisation_id != null ? "at ".$alumini->organisation->name : "" }})</span>
                                </p>
                            </div>
                            {{--Alumini 1 Ends--}}
                        @endforeach

                        @unless(is_null($technews))
                        {{--Tech News Starts--}}
                        <div class="col-sm-7 grid-item col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Technology News</b></div>
                                <div class="panel-body no-padding">
                                    <div class="thumbnail no-border">
                                        <img data-src="holder.js/100%x200" alt="100%x200"
                                             src="{{ route('make.thumbnail',[$technews->photo->url]) }}" data-holder-rendered="true"
                                             style="height: 100%; width: 500px; display: block;">
                                        <div class="caption">
                                            <p class="blockquote-reverse">
                                        <span class="text-small">
                                            {{ $technews->created_at->toDayDateTimeString() }} <br>
                                            {{--({{ $news->created_at->diffForHumans() }}) <br>--}}
                                        </span>
                                            </p>
                                            <h3 class="text-bold padding10 title">{{ $technews->title }}</h3>
                                            <i class="padding10 small text-muted">By {{ $technews->user->name }}</i>
                                            <p class="padding10 text-justify">
                                                {!! nl2br($technews->description) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Tech News Ends--}}
                        @endunless

                        {{--Quote of the Day Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Quote of the day</b></div>
                                <div class="panel-body no-padding text-center">
                                    <h4 id="quoteofday">
                    <i class="inspire text-{{ ['success','info', 'green', 'violet', 'muted', 'primary'][array_rand([0,1,2,3,4,5])] }}">{!! ($qotd) !!}</i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        {{--Quote of the Day Ends--}}

                        {{--Pic of the Day Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Picture of the day</b></div>
                                <div class="panel-body no-padding text-center">
                                    <div class="thumbnail no-border">
                                        <a href="/images/{{ $picture->url }}" target="_blank">
                                        <img data-src="holder.js/100%x200" alt="100%x200"
                                             src="{{ route('make.thumbnail',[$picture->url]) }}" data-holder-rendered="true"
                                             style="height: 100%; width: 500px; display: block;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Pic of the Day Ends--}}

                        {{--Did you Know API Starts--}}
                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Did you know?</b></div>
                                <div class="panel-body padding10 text-center">
                                    <h4 id="didyouknow">
                                        78 is the atomic number of platinum.
                                    </h4>
                                </div>
                            </div>
                        </div>
                        {{--Did you Know API Ends--}}

                    </div>
                </div>
            </div>

        </div>

        {{-- Testimonial Starts --}}
        <div class="testimonial row">
            <div class="cd-testimonials-wrapper cd-container">
                <ul class="cd-testimonials">
                    <li>
                        <p>The Society for Educational
                            Excellence has always aimed to achieve high standards
                            in technical education. Arya College of Engineering
                            and Research Centre under its flagship is doing very
                            well. We at ACERC work tirelessly to produce best
                            technical work force to stand against highly competitive
                            global challenging world.</p>
                        <p>
                            I congratulate the educational board to come up with
                            this first issue of quarterly newsletter "VOYAGE" which
                            highlight the multi diversity sectors where we are
                            working. I convey my message to the team and expect
                            similar enriched quarterly newsletter in future.
                        </p>
                        <div class="cd-author">
                            <img src="/images/static/arvind_agarwal.jpg" alt="Author image">
                            <ul class="cd-author-info">
                                <li>Dr Arvind Agarwal</li>
                                <li>President, ARYA Group of Colleges</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <p>It is my immense pleasure to introduce
                            the first issue of newsletter of Computer science
                            engineering “VOYAGE”. The newsletter is a source of
                            motivation for both student and faculties.
                        </p>
                        <p>
                            Every aspect of this newsletter will help us in enhancing
                            our knowledge in every aspect.
                        </p>
                        <p>
                            I would like to congratulate the Team of editors for their
                            efforts in collecting and compiling information & for
                            bringing up such a piece of work.
                        </p>
                        <div class="cd-author">
                            <img src="/images/static/pooja_agarwal.jpg" alt="Author image">
                            <ul class="cd-author-info">
                                <li>Dr. Puja Agarwal</li>
                                <li>Director, ACERC</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <p>
                            Enthralled with the excellence
                            and perseverance of the students of ACERC, the
                            CS Department has commenced the newsletter
                            “Voyage” to guide them towards a better and
                            bright path. The ever increasing & constant
                            updation of technology can not be provided a
                            better platform. I heartily congratulate all the
                            students and faculties of CS Department of
                            ACERC for one of the finest newsletter. We wish
                            them luck & all our support & best wishes will
                            always be with them.
                        </p>
                        <div class="cd-author">
                            <img src="/images/static/pn_singhal.jpg" alt="Author image">
                            <ul class="cd-author-info">
                                <li>Prof. P.N. Singhal</li>
                                <li>Principal, ACERC</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <p>
                            I am very glad to announce
                            the beginning of new chapter of ACERC. I
                            would like to congratulate the students &
                            Faculties for their effort in bringing out the
                            newsletter VOYAGE.
                        </p>
                        <p>
                            I hope the activities of the chapter will give
                            an opportunity to the students to learn new
                            aspects about computer science
                            engineering. Wishing best of luck to all
                            members for the new venture.
                        </p>
                        <div class="cd-author">
                            <img src="/images/static/himanshu_arora.jpg" alt="Author image">
                            <ul class="cd-author-info">
                                <li>Dr. Himanshu Arora</li>
                                <li>Registrar, ACERC</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <p>
                            “ Knowledge is power. Information is liberating. Education is
                            the premise of progress. In every society, In every Family ”
                        </p>
                        <p>
                            It is an ecstasy to re-announce the beginning of the newsletter ‘Voyage’ from Computer
                            Science
                            Department. It is my immense pleasure to dedicate this premiere issue to our prestigious
                            Arya
                            family. Through this newsletter we hope to reach every student and be an inspiration and
                            motivation for all to achieve heights.
                        </p>
                        <div class="cd-author">
                            <img src="/images/static/pradeep_jha.jpg" alt="Author image">
                            <ul class="cd-author-info">
                                <li>Er. Pradeep Jha</li>
                                <li>HOD CS Dept, ACERC</li>
                            </ul>
                        </div>
                    </li>

                </ul> <!-- cd-testimonials -->

                <a href="#0" class="cd-see-all" style="display: none">See all</a>
            </div> <!-- cd-testimonials-wrapper -->

            <div class="cd-testimonials-all" style="display: none">
                <div class="cd-testimonials-all-wrapper">
                    <ul>
                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit totam saepe iste maiores
                                neque animi molestias nihil illum nisi temporibus.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore nostrum nisi, doloremque
                                error hic nam nemo doloribus porro impedit perferendis. Tempora, distinctio hic
                                suscipit. At ullam eaque atque recusandae modi fugiat voluptatem laborum laboriosam
                                rerum, consequatur reprehenderit omnis, enim pariatur nam, quidem, quas vel reiciendis
                                aspernatur consequuntur. Commodi quasi enim, nisi alias fugit architecto, doloremque,
                                eligendi quam autem exercitationem consectetur.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quibusdam
                                eveniet, molestiae laborum voluptatibus minima hic quasi accusamus ut facere, eius
                                expedita, voluptatem? Repellat incidunt veniam quaerat, qui laboriosam dicta. Quidem
                                ducimus laudantium dolorum enim qui at ipsum, a error.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero voluptates officiis
                                tempore quae officia! Beatae quia deleniti cum corporis eos perferendis libero
                                reiciendis nemo iusto accusamus, debitis tempora voluptas praesentium repudiandae
                                laboriosam excepturi laborum, nisi optio repellat explicabo, incidunt ex numquam. Ullam
                                perferendis officiis harum doloribus quae corrupti minima quia, aliquam nostrum expedita
                                pariatur maxime repellat, voluptas sunt unde, inventore.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit totam saepe iste maiores
                                neque animi molestias nihil illum nisi temporibus.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>


                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, dignissimos iure
                                rem fugiat consequuntur officiis.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis iusto sapiente,
                                excepturi velit, beatae possimus est tenetur cumque fugit tempore dolore fugiat!
                                Recusandae, vel suscipit? Perspiciatis non similique sint suscipit officia illo,
                                accusamus dolorum, voluptate vitae quia ea amet optio magni voluptatem nemo, natus
                                nihil.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>

                        <li class="cd-testimonials-item">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque tempore ipsam, eos
                                suscipit nostrum molestias reprehenderit, rerum amet cum similique a, ipsum soluta
                                delectus explicabo nihil repellat incidunt! Minima magni possimus mollitia deserunt
                                facere, tempore earum modi, ea ipsa dicta temporibus suscipit quidem ut quibusdam vero
                                voluptatibus nostrum excepturi explicabo nulla harum, molestiae alias. Ab, quidem rem
                                fugit delectus quod.</p>

                            <div class="cd-author">
                                <img src="/images/static/Female.jpeg" alt="Author image">
                                <ul class="cd-author-info">
                                    <li>MyName</li>
                                    <li>CEO, CompanyName</li>
                                </ul>
                            </div> <!-- cd-author -->
                        </li>
                    </ul>
                </div>    <!-- cd-testimonials-all-wrapper -->

                <a href="#0" class="close-btn">Close</a>
            </div> <!-- cd-testimonials-all -->
        </div>
        {{-- Testimonial Ends --}}

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.carouFredSel-6.2.0-packed.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/nav-scroll.js') }}"></script>
    <script type="text/javascript">

        // Quotes AJAX load
            function update_div()
            {
                $('#ajaxinspire').fadeOut('normal', function()
                {
                    $('#ajaxinspire').load('/inspire');
                    //Did you know
                    $('#ajaxinspire').fadeIn(3000, function()
                    {
                        $('#didyouknow').load('/dyk');
                        window.setTimeout("update_div()", 8000);
                    });
                });
            }
            update_div();


        // Carousel Function
        $(function() {
            $('#slider').carouFredSel({
                width: '100%',
                align: false,
                items: 3,
                items: {
                    width: $('#wrapper').width() * 0.15,
                    height: 500,
                    visible: 1,
                    minimum: 1
                },
                scroll: {
                    items: 1,
                    timeoutDuration : 5000,
                    onBefore: function(data) {

                        //	find current and next slide
                        var currentSlide = $('.slide.active', this),
                                nextSlide = data.items.visible,
                                _width = $('#wrapper').width();

                        //	resize currentslide to small version
                        currentSlide.stop().animate({
                            width: _width * 0.15
                        });
                        currentSlide.removeClass( 'active' );

                        //	hide current block
                        data.items.old.add( data.items.visible ).find( '.slide-block' ).stop().fadeOut();

                        //	animate clicked slide to large size
                        nextSlide.addClass( 'active' );
                        nextSlide.stop().animate({
                            width: _width * 0.7
                        });
                    },
                    onAfter: function(data) {
                        //	show active slide block
                        data.items.visible.last().find( '.slide-block' ).stop().fadeIn();
                    }
                },
                onCreate: function(data){

                    //	clone images for better sliding and insert them dynamacly in slider
                    var newitems = $('.slide',this).clone( true ),
                            _width = $('#wrapper').width();

                    $(this).trigger( 'insertItem', [newitems, newitems.length, false] );

                    //	show images
                    $('.slide', this).fadeIn();
                    $('.slide:first-child', this).addClass( 'active' );
                    $('.slide', this).width( _width * 0.15 );

                    //	enlarge first slide
                    $('.slide:first-child', this).animate({
                        width: _width * 0.7
                    });

                    //	show first title block and hide the rest
                    $(this).find( '.slide-block' ).hide();
                    $(this).find( '.slide.active .slide-block' ).stop().fadeIn();
                }
            });

            //	Handle click events
            $('#slider').children().click(function() {
                $('#slider').trigger( 'slideTo', [this] );
            });

            //	Enable code below if you want to support browser resizing
            $(window).resize(function(){

                var slider = $('#slider'),
                        _width = $('#wrapper').width();

                //	show images
                slider.find( '.slide' ).width( _width * 0.15 );

                //	enlarge first slide
                slider.find( '.slide.active' ).width( _width * 0.7 );

                //	update item width config
                slider.trigger( 'configuration', ['items.width', _width * 0.15] );
            });

        });

        /**
         * Masonry
         */
        $(window).load(function(){
            $('.grid').masonry({
                itemSelector: ".grid-item",
                "columnWidth": 380
            });
        });
    </script>
@endsection