<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Jonogoner Dorbar</title>
  @include('home.css')
  </head>
  <body>
    
     <!-- navbar -->
	  @include('home.navigation')
	  <!-- endnavbar -->
    
        <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-11">
        <h4 class="mb-5 text-primary fw-bold d-flex align-items-center gap-2">
          <i class="bi bi-megaphone-fill fs-4"></i> 📣 নোটিশ বোর্ড
        </h4>

        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">

         
          @foreach ($notices as $notice)

          <div class="col">
            <div class="card notice-card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">
                  <a href="#" class="notice-title">
                    📌 {{ $notice['title'] }}
                  </a>
                </h5>
                <p class="notice-summary mt-2">
                  {{ $notice['description'] }}
                </p>
                <div class="mt-auto">
                  <div class="notice-date">
                    <i class="bi bi-calendar-event"></i> {{ $notice['date'] }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>


      </div>
    </div>
  </div>





     <!-- footer -->
	    @include('home.footer')
	  <!-- end footer -->
  

  <!-- loader -->
  <!-- js -->
   @include('home.jss')
  <!-- end js -->

    
  </body>
</html>