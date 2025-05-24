<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>নোটিশ বোর্ড ডেমো</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .notice-card {
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }
        .notice-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(13, 110, 253, 0.3);
        }
        .notice-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0d6efd;
            transition: color 0.3s ease;
            text-decoration: none;
        }
        .notice-title:hover {
            color: #6610f2;
            text-decoration: underline;
        }
        .notice-summary {
            font-size: 0.95rem;
            color: #555;
            min-height: 60px;
        }
        .notice-date {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }
        .btn-see-more {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(102, 16, 242, 0.4);
            transition: background 0.3s ease;
        }
        .btn-see-more:hover {
            background: linear-gradient(90deg, #6610f2, #0d6efd);
        }
          .stat-card {
        border-radius: 1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
      <h4 class="mb-5 text-primary fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-megaphone-fill fs-4"></i> 📣 নোটিশ বোর্ড
      </h4>

      <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">

        @php
          $notices = [
            ['title' => 'পরীক্ষার সময়সূচি প্রকাশিত হয়েছে', 'description' => 'আগামী মাসের পরীক্ষা শুরু হবে ১লা জুন থেকে। বিস্তারিত সময়সূচি অফিসিয়াল ওয়েবসাইটে পাওয়া যাবে।', 'date' => '15 মে ২০২৫'],
            ['title' => 'বিশ্ব পরিবেশ দিবস উদযাপন', 'description' => '৬ই জুন বিশ্ব পরিবেশ দিবস উপলক্ষে বিভিন্ন কর্মসূচি গ্রহণ করা হয়েছে। সবাই অংশগ্রহণ করুন।', 'date' => '10 মে ২০২৫'],
            ['title' => 'বিদ্যুৎ বিভ্রাটের জন্য ক্ষমা প্রার্থনা', 'description' => 'গতকাল রাতে এলাকায় বিদ্যুৎ বিভ্রাটের কারণে সকলকে দুঃখিত। দ্রুত সমস্যার সমাধান করা হচ্ছে।', 'date' => '12 মে ২০২৫'],
            ['title' => 'নতুন গ্রন্থাগারের উদ্বোধন', 'description' => 'বিশ্ববিদ্যালয়ের নতুন গ্রন্থাগার আগামী সপ্তাহ থেকে চালু হবে। শিক্ষার্থীরা ব্যবহার করতে পারবে।', 'date' => '08 মে ২০২৫'],
            ['title' => 'ছাত্রছাত্রীদের জন্য অনলাইন ক্লাস', 'description' => 'করোনা পরিস্থিতির কারণে আগামী দুই সপ্তাহ অনলাইন ক্লাস চালু থাকবে। সময়সূচি ওয়েবসাইটে রয়েছে।', 'date' => '05 মে ২০২৫'],
          ];
        @endphp

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

      <div class="text-center mt-5">
        <a href="#" class="btn btn-see-more px-4 py-2 rounded-pill text-white shadow-sm">
          আরও নোটিশ দেখুন <i class="bi bi-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</div>


<div class="row text-center my-4 g-3">
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-light shadow-sm p-3">
            <div class="icon-circle bg-primary mx-auto">
                <i class="bi bi-clipboard-data"></i>
            </div>
            <h6 class="text-secondary">মোট অভিযোগ</h6>
            <h2 class="text-dark fw-bold">1,245</h2>
            <a href="{{ route('all_ovijogs',1) }}" class="stretched-link"></a>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card stat-card bg-light shadow-sm p-3">
            <div class="icon-circle bg-success mx-auto">
                <i class="bi bi-check-circle"></i>
            </div>
            <h6 class="text-secondary">সমাধান হয়েছে</h6>
            <h2 class="text-dark fw-bold">985</h2>
            <a href="{{ route('all_ovijogs',2) }}" class="stretched-link"></a>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card stat-card bg-light shadow-sm p-3">
            <div class="icon-circle bg-warning mx-auto">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h6 class="text-secondary">চলমান অভিযোগ</h6>
            <h2 class="text-dark fw-bold">210</h2>
            <a href="{{ route('all_ovijogs',3) }}" class="stretched-link"></a>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card stat-card bg-light shadow-sm p-3">
            <div class="icon-circle bg-danger mx-auto">
                <i class="bi bi-x-circle"></i>
            </div>
            <h6 class="text-secondary">বাতিল হয়েছে</h6>
            <h2 class="text-dark fw-bold">50</h2>
            <a href="{{ route('all_ovijogs',4) }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


