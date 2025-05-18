<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HSTU-RDPC Schedule</title>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body>
    <!-- navbar -->
    @include('home.navigation')
    <!-- endnavbar -->

    <div class="container py-5 mt-5">
      <!-- Page Header -->
      <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-dark mb-3">Event Schedule</h1>
        <p class="lead text-muted">Important dates and deadlines for all RDPC events</p>
      </div>

      <!-- Event Cards Grid -->
      <div class="row">
        <!-- Programming Contest -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card border-left-primary shadow-lg h-100 hover-effect">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <div class="icon-square bg-primary text-white rounded-circle p-3 mr-3">
                  <i class="fas fa-code fa-2x"></i>
                </div>
                <h3 class="card-title mb-0">Programming Contest</h3>
              </div>
              <div class="schedule-dates">
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-primary">
                      <i class="far fa-calendar-alt mr-2"></i>Registration
                    </h5>
                    <p class="text-muted mb-0">10 - 15 April</p>
                  </div>
                </div>
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-info">
                      <i class="fas fa-clipboard-check mr-2"></i>Mock
                    </h5>
                    <p class="text-muted mb-0">24 April</p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 text-success">
                      <i class="fas fa-flag-checkered mr-2"></i>Final
                    </h5>
                    <p class="text-muted mb-0">25 April</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Project Showcasing -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card border-left-success shadow-lg h-100 hover-effect">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <div class="icon-square bg-success text-white rounded-circle p-3 mr-3">
                  <i class="fas fa-project-diagram fa-2x"></i>
                </div>
                <h3 class="card-title mb-0">Project Showcase</h3>
              </div>
              <div class="schedule-dates">
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-primary">
                      <i class="far fa-calendar-alt mr-2"></i>Registration
                    </h5>
                    <p class="text-muted mb-0">20 - 22 April</p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 text-success">
                      <i class="fas fa-presentation mr-2"></i>Final
                    </h5>
                    <p class="text-muted mb-0">25 April</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quiz Competition -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card border-left-warning shadow-lg h-100 hover-effect">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <div class="icon-square bg-warning text-white rounded-circle p-3 mr-3">
                  <i class="fas fa-question-circle fa-2x"></i>
                </div>
                <h3 class="card-title mb-0">Quiz Competition</h3>
              </div>
              <div class="schedule-dates">
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-primary">
                      <i class="far fa-calendar-alt mr-2"></i>Registration
                    </h5>
                    <p class="text-muted mb-0">15 - 22 April</p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 text-success">
                      <i class="fas fa-trophy mr-2"></i>Final
                    </h5>
                    <p class="text-muted mb-0">23 April</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Gaming Contest -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card border-left-danger shadow-lg h-100 hover-effect">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <div class="icon-square bg-danger text-white rounded-circle p-3 mr-3">
                  <i class="fas fa-gamepad fa-2x"></i>
                </div>
                <h3 class="card-title mb-0">Gaming Contest</h3>
              </div>
              <div class="schedule-dates">
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-primary">
                      <i class="far fa-calendar-alt mr-2"></i>Registration
                    </h5>
                    <p class="text-muted mb-0">10 - 20 April</p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 text-success">
                      <i class="fas fa-chess mr-2"></i>Final
                    </h5>
                    <p class="text-muted mb-0">20 April</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Poster Presentation -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card border-left-info shadow-lg h-100 hover-effect">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <div class="icon-square bg-info text-white rounded-circle p-3 mr-3">
                  <i class="fas fa-image fa-2x"></i> <!-- Icon for Poster Presentation -->
                </div>
                <h3 class="card-title mb-0">Poster Presentation</h3>
              </div>
              <div class="schedule-dates">
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0 text-primary">
                      <i class="far fa-calendar-alt mr-2"></i>Registration
                    </h5>
                    <p class="text-muted mb-0">18 - 22 April</p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 text-success">
                      <i class="fas fa-images mr-2"></i>Final
                    </h5>
                    <p class="text-muted mb-0">24 April</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Legend Section -->
      <div class="row mt-5">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-4">Color Legend</h5>
              <div class="row text-center">
                <div class="col-6 col-md-3 mb-3">
                  <span class="legend-dot bg-primary"></span>
                  <p class="mb-0 text-muted small">Programming</p>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <span class="legend-dot bg-success"></span>
                  <p class="mb-0 text-muted small">Projects</p>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <span class="legend-dot bg-warning"></span>
                  <p class="mb-0 text-muted small">Quiz</p>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <span class="legend-dot bg-danger"></span>
                  <p class="mb-0 text-muted small">Gaming</p>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <span class="legend-dot bg-info"></span>
                  <p class="mb-0 text-muted small">Poster</p>
                </div>
              </div>
            </div>
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

    <style>
      .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
      }
      .icon-square {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .legend-dot {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-bottom: 5px;
      }
      .border-left-primary { border-left: 4px solid #4e73df; }
      .border-left-success { border-left: 4px solid #1cc88a; }
      .border-left-warning { border-left: 4px solid #f6c23e; }
      .border-left-danger { border-left: 4px solid #e74a3b; }
      .border-left-info { border-left: 4px solid #36b9cc; } <!-- Added for Poster Presentation -->
      .card-title {
        color: #2d3748;
        font-weight: 600;
      }
      /* Fix for navigation overlap */
      body { 
        padding-top: 80px; 
      }
      .container {
        margin-top: 20px;
      }
    </style>
  </body>
</html>