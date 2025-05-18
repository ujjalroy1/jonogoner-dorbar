@php
  $departments = [
    ['name' => 'রেজিস্ট্রার দপ্তর', 'desc' => 'শিক্ষার্থীদের ভর্তি, রেজিস্ট্রেশন ও নথি সংরক্ষণ', 'phone' => '01711-123456', 'email' => 'registrar@university.ac.bd'],
    ['name' => 'পরীক্ষা নিয়ন্ত্রক অফিস', 'desc' => 'পরীক্ষা সংক্রান্ত যাবতীয় কার্যক্রম', 'phone' => '01722-654321', 'email' => 'exam@university.ac.bd'],
    ['name' => 'ছাত্র পরামর্শ ও নির্দেশনা অফিস', 'desc' => 'ছাত্রদের সাপোর্ট, বৃত্তি ও পরামর্শ', 'phone' => '01733-987654', 'email' => 'guidance@university.ac.bd'],
    ['name' => 'আইটি সাপোর্ট সেন্টার', 'desc' => 'ইউনিভার্সিটির আইটি সংক্রান্ত সমস্যা সমাধান', 'phone' => '01744-112233', 'email' => 'itsupport@university.ac.bd'],
  ];
@endphp

<style>
  .dept-card {
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(13, 110, 253, 0.1);
      transition: all 0.3s ease;
      background-color: #ffffff;
  }
  .dept-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
  }
  .dept-name {
      font-size: 1.2rem;
      font-weight: 700;
      color: #0d6efd;
  }
  .dept-contact i {
      color: #6610f2;
  }
  .dept-contact a {
      color: #333;
      text-decoration: none;
      font-weight: 500;
  }
  .dept-contact a:hover {
      color: #0d6efd;
  }
</style>

<div class="container py-5">
    <h4 class="mb-5 text-primary fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-building"></i> 🏢 বিভিন্ন দপ্তরের লিস্ট ও প্রয়োজনীয় যোগাযোগ
    </h4>

    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
      @foreach ($departments as $dept)
        <div class="col">
          <div class="card dept-card h-100 p-3">
            <div class="card-body">
              <h5 class="dept-name mb-2">{{ $dept['name'] }}</h5>
              <p class="text-muted">{{ $dept['desc'] }}</p>
            </div>
            <div class="card-footer bg-white border-0 dept-contact">
              <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i><a href="tel:{{ $dept['phone'] }}">{{ $dept['phone'] }}</a></p>
              <p><i class="bi bi-envelope-fill me-2"></i><a href="mailto:{{ $dept['email'] }}">{{ $dept['email'] }}</a></p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
</div>
