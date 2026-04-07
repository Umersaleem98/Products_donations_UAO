<section class="slider_section mb-3">
   <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">

      <div class="carousel-inner">

         <!-- Slide 1 -->
         <div class="carousel-item active">
            <img class="first-slide" src="{{ asset('templates/images/banner2.jpg') }}" alt="Slide 1">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>
                     Give Hope <br>
                     <strong class="yellow_bold">Donate Today</strong>
                  </h1>
                  <p>Turn unused items into a student’s future.</p>
                  <a href="{{ url('donate') }}">Donate Now</a>
               </div>
            </div>
         </div>

         <!-- Slide 2 -->
         <div class="carousel-item">
            <img class="second-slide" src="{{ asset('templates/images/banner2.jpg') }}" alt="Slide 2">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>
                     Small Help <br>
                     <strong class="yellow_bold">Big Change</strong>
                  </h1>
                  <p>Your old gadgets can change lives.</p>
                  <a href="{{ url('donate') }}">Make Impact</a>
               </div>
            </div>
         </div>

         <!-- Slide 3 -->
         <div class="carousel-item">
            <img class="third-slide" src="{{ asset('templates/images/banner2.jpg') }}" alt="Slide 3">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>
                     Share Knowledge <br>
                     <strong class="yellow_bold">Spread Smiles</strong>
                  </h1>
                  <p>Donate books, laptops, and opportunities.</p>
                  <a href="{{ url('donate') }}">Start Giving</a>
               </div>
            </div>
         </div>

      </div>

      <!-- Controls -->
      <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
         <i class="fa fa-angle-left"></i>
      </a>

      <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
         <i class="fa fa-angle-right"></i>
      </a>

   </div>
</section>