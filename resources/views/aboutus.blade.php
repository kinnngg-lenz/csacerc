@extends('layouts.app')
@section('title', 'About Us')
@section('styles')
    <style>
        .jumbotron {
            background: url('/images/static/head.png') #573e81;
            margin-top: -28px;
            border-radius: 0px !important;
            color: white;
        }
        .jumbotron pre {
            padding: 0px;
            border: none;
            border-radius: 0px;
        }
        pre
        {
            padding: 0px;
        }
        h1 {
            font-size: 300% !important;
        }
        .tiny {
            font-size: 14px !important;
        }
        .inspire
        {
            font-size:2rem !important;;
        }
        .text-lg
        {
            font-size: 1.5em !important;
            font-family: "Trebuchet MS", Verdana, sans-serif;
        }
        .stats
        {
            font-size:18px !important;
        }
        hr
        {
            margin: 0;
            margin-bottom:5px;
            border-top: 1px solid #FFFFFF;
        }
        .content {
            padding-top: 30px;
        }

        /* Testimonials */
        .col-md-9 blockquote {
            background: #f8f8f8 none repeat scroll 0 0;
            border: medium none;
            color: #666;
            display: block;
            font-size: 18px;
            padding: 15px;
            position: relative;
            margin-top: 30px;
            font-family:"Lato", Verdana, sans-serif;
            text-align: justify;
        }

        .fac-round {
            border: 1px solid #D4D4D4;
            border-radius: 100px !important;
            height: 180px;
            padding: 4px;
        }

        span.name {
            color: #673AB7;
            font-size: 20px;
            margin: 23px 0 7px;
        }

        span.post {
            color: #656565;
            font-size: 14px;
        }
        span.post.small
        {
            font-size: 12px;
        }

        .fac-box {
            box-shadow: rgb(255, 216, 0) 4px 5px inset;
            padding: 19px;
            background-color: white;
            border-radius: 5px;
            margin-bottom:10px;
        }
        .fac-box2{
            box-shadow: rgba(174, 174, 174, 0.63) -8px -5px 145px !important;
            -webkit-box-shadow: rgba(174, 174, 174, 0.63) -8px -5px 145px !important;
            -moz-box-shadow: rgba(174, 174, 174, 0.63) -8px -5px 145px !important;
            -o-box-shadow: rgba(174, 174, 174, 0.63) -8px -5px 145px !important;
            padding: 19px;
            background-color: white;
            border-radius: 0px;
            margin-bottom: 10px;
            font-family: helvetica;
            background-color: rgb(255, 255, 255);
            border-left: solid 14px aliceblue;
        }

        .card {
            padding-top: 20px;
            margin: 10px 0 20px 0;
            background-color: rgba(214, 224, 226, 0.2);
            border-top-width: 0;
            border-bottom-width: 2px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card .card-heading {
            padding: 0 20px;
            margin: 0;
        }

        .card .card-heading.simple {
            font-size: 20px;
            font-weight: 300;
            color: #777;
            border-bottom: 1px solid #e5e5e5;
        }

        .card .card-heading.image img {
            display: inline-block;
            width: 46px;
            height: 46px;
            margin-right: 15px;
            vertical-align: top;
            border: 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .card .card-heading.image .card-heading-header {
            display: inline-block;
            vertical-align: top;
        }

        .card .card-heading.image .card-heading-header h3 {
            margin: 0;
            font-size: 14px;
            line-height: 16px;
            color: #262626;
        }

        .card .card-heading.image .card-heading-header span {
            font-size: 12px;
            color: #999999;
        }

        .card .card-body {
            padding: 0 20px;
            margin-top: 20px;
        }

        .card .card-media {
            padding: 0 20px;
            margin: 0 -14px;
        }

        .card .card-media img {
            max-width: 100%;
            max-height: 100%;
        }

        .card .card-actions {
            min-height: 30px;
            padding: 0 20px 20px 20px;
            margin: 20px 0 0 0;
        }

        .card .card-comments {
            padding: 20px;
            margin: 0;
            background-color: #f8f8f8;
        }

        .card .card-comments .comments-collapse-toggle {
            padding: 0;
            margin: 0 20px 12px 20px;
        }

        .card .card-comments .comments-collapse-toggle a,
        .card .card-comments .comments-collapse-toggle span {
            padding-right: 5px;
            overflow: hidden;
            font-size: 12px;
            color: #999;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-comments .media-heading {
            font-size: 13px;
            font-weight: bold;
        }

        .card.people {
            position: relative;
            display: inline-block;
            width: 170px;
            height: 300px;
            padding-top: 0;
            margin-left: 20px;
            overflow: hidden;
            vertical-align: top;
        }

        .card.people:first-child {
            margin-left: 0;
        }

        .card.people .card-top {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            width: 170px;
            height: 150px;
            background-color: #ffffff;
        }

        .card.people .card-top.green {
            background-color: #53a93f;
        }

        .card.people .card-top.blue {
            background-color: #427fed;
        }

        .card.people .card-info {
            position: absolute;
            top: 150px;
            display: inline-block;
            width: 100%;
            height: 101px;
            overflow: hidden;
            background: #ffffff;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card.people .card-info .title {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            color: #404040;
        }

        .card.people .card-info .desc {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 12px;
            line-height: 16px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .card.people .card-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            display: inline-block;
            width: 100%;
            padding: 10px 20px;
            line-height: 29px;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card.hovercard {
            position: relative;
            padding-top: 0;
            overflow: hidden;
            text-align: center;
            background-color: rgba(214, 224, 226, 0.2);
            box-shadow: 1px 0px 10px -2px #d5d5d5;
            border: 2px solid white;
        }

        .card.hovercard .cardheader {
            background: url("/images/static/bg.jpg");
            background-size: cover;
            height: 100px;
        }

        .card.hovercard .avatar {
            position: relative;
            top: -50px;
            margin-bottom: -40px;
        }

        .card.hovercard .avatar img {
            width: 150px;
            height: 150px;
            max-width: 150px;
            max-height: 150px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.5);
        }

        .card.hovercard .info {
            padding: 4px 8px 10px;
        }

        .card.hovercard .info .title {
            margin-bottom: 4px;
            font-size: 15px;
            line-height: 1;
            color: #262626;
            vertical-align: middle;
        }

        .card.hovercard .info .desc {
            overflow: hidden;
            font-size: 12px;
            line-height: 20px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .card.hovercard .bottom {
            padding: 0 20px;
            margin-bottom: 17px;
        }
        .assitant{
            margin: 0% 25%;
        }
        .img-circle.faculties-l {
            height: 75px;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>About Us</h1>
                <p class="">About Department of Computer Science at Arya College of Engg. &amp; Research Center.</p>
                <p class="tiny text-muted"></p>
            </div>
            <!-- Page Content -->

            <div class="container content">
                <div class="row fac-box2">
                    <div class="col-md-3 text-center">
                        <img src="/images/static/pradeep_jha.jpg" class="img-circle fac-round" alt="hod">
                        <div class="text-center">
                            <span class="name">Pradeep Jha</span><br />
                            <span class="post">Head of Department</span><br>
                            <span class="post small">Computer Science Engineering, ACERC</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <blockquote><p>Nothing in the world is ever completely wrong. Even a stopped clock is right twice a day. ― Paulo Coelho, Brida</p>
                                <p>The way to get started is to quit talking and begin doing.
                                Through this website we hope to reach every student and be an inspiration and motivation for all to achieve heights.</p></blockquote>
                    </div>
                </div>

            </div>
            <!-- Navigation -->
            <!-- faculties -->



            <div class="container">
                <h3>Our Faculties</h3>
                <hr />
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/ShilpiMishra.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Shilpi Mishra</a>
                                </div>
                                <div class="desc">mishra.shilpi20@gmail.com</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card hovercard">
                            <div class="cardheader">
                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/SudhanshuVasistha.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Sudhanshu Vasistha</a>
                                </div>
                                <div class="desc">sudhanshu.vasistha85@gmail.com</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card hovercard">
                            <div class="cardheader">
                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/AditiAgarwal.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Aditi Agarwal</a>
                                </div>
                                <div class="desc">aditi170@gmail.com</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/AdityaUpadhyay.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Aditya Upadhyay</a>
                                </div>
                                <div class="desc">adityaupadhyay144@gmail.com</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card hovercard">
                            <div class="cardheader">
                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/BhavyaSareen.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Bhavya Sareen</a>
                                </div>
                                <div class="desc">gracy125@hotmail.com</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/VipinTomar.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Vipin Tomar</a>
                                </div>
                                <div class="desc">vipan_tomar32@yahoo.com</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/VivekJethani.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Vivek Jethani</a>
                                </div>
                                <div class="desc">vivek.jethani@aryaaiet.ac.in</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/ManojTiwari.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Manoj Tiwari</a>
                                </div>
                                <div class="desc">manojkumartiwari@rediffmail.com</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/NaveenTiwari.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Naveen Tiwari</a>
                                </div>
                                <div class="desc">tiwarinaveen1994@gmail.com</div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/ShrutiDadhich.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Shruti Dadhich</a>
                                </div>
                                <div class="desc">shruti.dadhich7@gmail.com</div>

                            </div>

                        </div>

                    </div>
                    {{--<div class="col-lg-3 col-sm-6">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="/images/static/MayankGautam.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a target="_blank" href="#">Mayank Gautam</a>
                                </div>
                                <div class="desc">er.mayankgautam@gmail.com</div>

                            </div>

                        </div>

                    </div>--}}
                </div>
            </div>

            <!-- Technician

            <div class="container">
                <h3>Technicians</h3>
                <hr />
                <div class="row assitant text-center">
                    <div class="col-md-4">
                        <img src="/images/static/techSushilChy.jpg" class="img-circle faculties-l" alt="faculty" />
                        <div class="info">
                            <div class="title">
                                <a target="_blank" href="#">Sushil Chy</a>
                            </div>
                            <div class="desc">---</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="/images/static/techSarveshPrashar.jpg" class="img-circle faculties-l" alt="faculty" />
                        <div class="info">
                            <div class="title">
                                <a target="_blank" href="#">Sarvesh Prashar</a>
                            </div>
                            <div class="desc">---</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="/images/static/techManojKumar.jpg" class="img-circle faculties-l" alt="faculty" />
                        <div class="info">
                            <div class="title">
                                <a target="_blank" href="#">Manoj Kumar</a>
                            </div>
                            <div class="desc">---</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /Technician -->

        </div>
    </div>
@endsection