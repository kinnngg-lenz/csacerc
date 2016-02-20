@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.carousel')

        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <h2>Hey! {{ Auth::check() ? Auth::user()->name : "Guest" }}.</h2>
                <h2>Welcome to Department of Computer Science - ACERC</h2>
                <p>This Project is Under Development
                    <a class="btn btn-primary btn-sm"a target="_blank" href="https://github.com/kinnngg-lenz/csacerc" role="button">View Source</a>
                </p>
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
                        <li>Director, ARYA College of Engg. & Research Center</li>
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
                        <li>Principal, ARYA College of Engg. & Research Center</li>
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
                        <li>Registrar, ARYA College of Engg. & Research Center</li>
                    </ul>
                </div>
            </li>

            <li>
                <p>
                    “ Knowledge is power. Information is liberating. Education is
                    the premise of progress. In every society, In every Family ”
                </p>
                <p>
                    It is an ecstasy to re-announce the beginning of the newsletter ‘Voyage’ from Computer Science
                    Department. It is my immense pleasure to dedicate this premiere issue to our prestigious Arya
                    family. Through this newsletter we hope to reach every student and be an inspiration and
                    motivation for all to achieve heights.
                </p>
                <div class="cd-author">
                    <img src="/images/static/sanjay_tiwari.jpg" alt="Author image">
                    <ul class="cd-author-info">
                        <li>Dr. Sanjay Tiwari</li>
                        <li>HOD CS Dept, ARYA Institute of Engg. & Technology</li>
                    </ul>
                </div>
            </li>

        </ul> <!-- cd-testimonials -->

        <a href="#0" class="cd-see-all">See all</a>
    </div> <!-- cd-testimonials-wrapper -->

    <div class="cd-testimonials-all">
        <div class="cd-testimonials-all-wrapper">
            <ul>
                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit totam saepe iste maiores neque animi molestias nihil illum nisi temporibus.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore nostrum nisi, doloremque error hic nam nemo doloribus porro impedit perferendis. Tempora, distinctio hic suscipit. At ullam eaque atque recusandae modi fugiat voluptatem laborum laboriosam rerum, consequatur reprehenderit omnis, enim pariatur nam, quidem, quas vel reiciendis aspernatur consequuntur. Commodi quasi enim, nisi alias fugit architecto, doloremque, eligendi quam autem exercitationem consectetur.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quibusdam eveniet, molestiae laborum voluptatibus minima hic quasi accusamus ut facere, eius expedita, voluptatem? Repellat incidunt veniam quaerat, qui laboriosam dicta. Quidem ducimus laudantium dolorum enim qui at ipsum, a error.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero voluptates officiis tempore quae officia! Beatae quia deleniti cum corporis eos perferendis libero reiciendis nemo iusto accusamus, debitis tempora voluptas praesentium repudiandae laboriosam excepturi laborum, nisi optio repellat explicabo, incidunt ex numquam. Ullam perferendis officiis harum doloribus quae corrupti minima quia, aliquam nostrum expedita pariatur maxime repellat, voluptas sunt unde, inventore.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit totam saepe iste maiores neque animi molestias nihil illum nisi temporibus.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>


                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, dignissimos iure rem fugiat consequuntur officiis.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis iusto sapiente, excepturi velit, beatae possimus est tenetur cumque fugit tempore dolore fugiat! Recusandae, vel suscipit? Perspiciatis non similique sint suscipit officia illo, accusamus dolorum, voluptate vitae quia ea amet optio magni voluptatem nemo, natus nihil.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>

                <li class="cd-testimonials-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque tempore ipsam, eos suscipit nostrum molestias reprehenderit, rerum amet cum similique a, ipsum soluta delectus explicabo nihil repellat incidunt! Minima magni possimus mollitia deserunt facere, tempore earum modi, ea ipsa dicta temporibus suscipit quidem ut quibusdam vero voluptatibus nostrum excepturi explicabo nulla harum, molestiae alias. Ab, quidem rem fugit delectus quod.</p>

                    <div class="cd-author">
                        <img src="/images/static/Female.jpeg" alt="Author image">
                        <ul class="cd-author-info">
                            <li>MyName</li>
                            <li>CEO, CompanyName</li>
                        </ul>
                    </div> <!-- cd-author -->
                </li>
            </ul>
        </div>	<!-- cd-testimonials-all-wrapper -->

        <a href="#0" class="close-btn">Close</a>
    </div> <!-- cd-testimonials-all -->
    </div>
    {{-- Testimonial Ends --}}

    </div>
@endsection
