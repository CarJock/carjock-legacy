@extends('frontend.layouts.app')
@section('content')
    <style>
        .blog-container {
            padding: 130px 10px 43px 10px;
            background-color: #f9f9f9;
        }



        #featured-blog {
            text-align: center;
            margin-bottom: 40px;
        }

        #featured-blog {
            padding: 0 200px;
            text-align: center;
        }

        #featured-blog h1 {
            font-size: 36px;
            margin: 20px 0;
            color: #333;
        }

        #featured-blog p {
            font-size: 18px;
            color: #444;
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 40px;
        }

        .featured-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
        }






        #posts {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        article {
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        article img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        article h2 {
            font-size: 18px;
            margin: 10px 0;
        }

        article p {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }

        article a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>


    <div class="blog-container">
        <section id="featured-blog">
            <img src="{{url('/storage/blogs/dummy_blog.jpg')}}"
                alt="Featured Blog Image" class="featured-image">
            <h1>Exploring Car Sales Growth in the USA</h1>
            <p>The U.S. automobile market has experienced significant growth over the past decade, with electric vehicles
                leading the charge. In 2023, sales surged as consumer demand for eco-friendly and technologically advanced
                cars skyrocketed. Major manufacturers like Tesla, Ford, and GM have expanded their EV offerings, catering to
                diverse needs and preferences. This boom in car sales reflects a shift towards sustainability and innovation
                in the automotive industry, as buyers increasingly prioritize fuel efficiency and cutting-edge technology.
            </p>
        </section>




        <section id="posts">
            <article>
                <img src="{{url('/storage/blogs/dummy_blog2.png')}}" alt="Car Image">
                <h2>THE BEST SPECIFICATION CAR 2017</h2>
                <p>April 9, 2024 | Posted by admin</p>
                <a href="#">View Post</a>
            </article>

            <article>
                <img src="{{url('/storage/blogs/dummy_blog3.jpg')}}" alt="Car Image">
                <h2>2024’s Best Cars to Drive</h2>
                <p>April 10, 2024 | Posted by admin</p>
                <a href="#">View Post</a>
            </article>
            <article>
                <img src="{{url('/storage/blogs/dummy_blog4.jpg')}}" alt="Car Image">
                <h2>2024’s Best Cars to Drive</h2>
                <p>April 10, 2024 | Posted by admin</p>
                <a href="#">View Post</a>
            </article>

            <!-- More relevant blogs here -->
        </section>
    </div>
@endsection
