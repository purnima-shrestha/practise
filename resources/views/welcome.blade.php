@extends('layouts.app')
@section('title', 'E-Lecture | Welcome')

@section('content')

    <body class="antialiased">
      <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
      <!-- body -->
      <div class="hero-full-container background-image-container white-text-container">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h1>E-Lecture Portal</h1>
              <p>A portal for all lecture file sharing</p>
              <br>
              @guest
              <a href="{{ route('login') }}" class="btn btn-default btn-lg" title="">Login</a>
              @endguest
            </div>
          </div>
        </div>
      </div>

      {{-- what is elearning --}}
      <div class="section-container">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
              <div class="text-center">
                <h2>What is E-Learning ?</h2>
                <p>A learning system based on formalised teaching but with the help of electronic resources is known as E-learning. 
                    While teaching can be based in or out of the classrooms, the use of computers and the Internet forms the major component of E-learning.
                </p>
              </div>
          </div>
          </div>
        </div>
      </div>
      

      {{-- Carousel --}}
      <div class="section-container">
        <div class="container">
          <div class="row">      
              <div class="col-xs-12">
                <div id="carousel-example-generic" class="carousel carousel-fade slide" data-ride="carousel">
                    
                    <div class="carousel-inner" role="listbox">

                        <div class="item active">
                            <img class="img-responsive" src="./assets/images/eteacher.jpg" alt="First slide">
                            <div class="carousel-caption card-shadow reveal">
                              
                              <h3>Teacher Benefits</h3>
                              {{-- buttons --}}
                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                              </a>
                              <p>
                              E-learning platforms allow teachers to stay connected to their students 
                              outside of school hours in order to exchange resources, videos, ideas, methodologies, and pedagogical practices
                              </p>
                              
                              <p>
                                Among the benefits of e-learning for teachers is the large variety of different resources such as videos
                                texts, presentations, and quizzes that they can use to adapt their tutoring methods to the learning styles of their students.
                              </p>
                              <a href="./project.html" class="btn btn-primary" title="">
                                Discover
                              </a>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="./assets/images/estudent.jpg" alt="First slide">
                            <div class="carousel-caption card-shadow reveal">

                              <h3>Student Benefits</h3>
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                  <span class="sr-only">Next</span>
                                </a>
                              <p>
                              Today's learners want relevant, mobile, self-paced, and personalized content. This need is fulfilled with 
                              the online mode of learning; here, students can learn at their own comfort and requirement. Let's have an
                              analytical look at the advantages of online learning.
                              </p>
                              
                              <p>
                                The online method of learning is best suited for everyone. This digital revolution has led to remarkable
                                changes in how the content is accessed, consumed, discussed, and shared.
                              </p>
                              <a href="./project.html" class="btn btn-primary" title="">
                                Discover
                              </a>
                            </div>
                        </div>
                    </div>
                  
                </div>
              </div>
            </div>      
        </div>
      </div>

    {{-- Courses --}}
    <div class="section-container">
      <div class="container text-center">
        <div class="row section-container-spacer">
          <div class="col-xs-12 col-md-12">
            <h2>Courses</h2>
            <p> Our Courses help students to specialise in all the vital subjects of international standard education. <br>Courses from top universities.</p>
          </div>  
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/sciencecourse.jpg" alt="" height="auto" class="reveal img-responsive reveal-content image-center">
            <h3>Science</h3>
            <p>the intellectual and practical activity encompassing the systematic study of the structure and behaviour of the physical
               and natural world through observation and experiment.</p>
          </div>
        
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/computercourse.webp" alt="" class="reveal img-responsive reveal-content image-center">
            <h3>Computer</h3>
            <p>Computer science applies the principles of mathematics, engineering, and logic to a plethora of functions, including
               algorithm formulation, software and hardware development, and artificial intelligence.</p>
          </div>
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/astrocourse.jpg" alt="" class="reveal img-responsive reveal-content image-center">
            <h3>Astronomy</h3>
            <p>Astronomy is the study of everything in the universe beyond Earth's atmosphere. That includes objects 
              we can see with our naked eyes, like the Sun , the Moon , the planets, and the stars .</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Teachers --}}
    <div class="section-container">
      <div class="container text-center">
        <div class="row section-container-spacer">
          <div class="col-xs-12 col-md-12">
            <h2>Teachers</h2>
            <p> Our teachers work in a creative team environment and have the opportunity to <br>use innovative teaching strategies to support authentic, rigorous student outcomes.</br></p>
          </div>  
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/scienceteacher.jpg" alt="potrait" height="200" class="reveal img-responsive reveal-content image-center">
            <h3>Dr. AK Dewan</h3>
            <p>Other qualities of a good science teacher include being passionate about teaching effective, 
              curriculum and standards-based science lessons, showing up for work early and helping their school excel.</p>
          </div>
        
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/computerteacher.jpg" alt="potrait" height="200" class="reveal img-responsive reveal-content image-center">
            <h3>Mr. Mark Manosa</h3>
            <p>Computer science applies the principles of mathematics, engineering, and logic to a plethora of functions, including
               algorithm formulation, software and hardware development, and artificial intelligence.</p>
          </div>
          <div class="col-xs-12 col-md-4">
            <img src="./assets/images/astroteacher.jpg" alt="" class="reveal img-responsive reveal-content image-center">
            <h3>Dr. James Snow</h3>
            <p>Become a professor of astronomy at the undergraduate or graduate level. Look for open positions at
               your local university or universities out of state. </p>
          </div>
        </div>
      </div>
    </div>
 
    {{-- contact --}}
  <div class="section-container contact-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="section-container-spacer">
            <h2 class="text-center">Get in touch</h2>
            <p class="text-center">Contact us for the best online learning and lecture resources to help you hone your skills.</p>
          </div>
          <div class="card-container">
            <div class="card card-shadow col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 reveal">
              <form action="" class="reveal-content">
                <div class="row">
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" rows="3" placeholder="Enter your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send message</button>
                  </div>
                  <div class="col-md-5">
                    <ul class="list-unstyled address-container">
                      <li>
                        <span class="fa-icon">
                          <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                        + 977 9818 505 260
                      </li>
                      <li>
                        <span class="fa-icon">
                          <i class="fa fa fa-map-o" aria-hidden="true"></i>
                        </span>
                        Jhamsikhel, Kathmandu
                      </li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
            {{-- <div class="card-image col-xs-12" style="background-image: url('/assets/images/img-02.jpg')"> --}}
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
        </div>
@endsection
