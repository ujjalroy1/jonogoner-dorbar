@php
  $departments = [
    ['name' => 'রেজিস্ট্রার দপ্তর', 'desc' => 'শিক্ষার্থীদের ভর্তি, রেজিস্ট্রেশন ও নথি সংরক্ষণ', 'phone' => '01711-123456', 'email' => 'registrar@dinajpurdc.ac.bd'],
    ['name' => 'ভূমি প্রশাসন দপ্তর', 'desc' => 'ভূমি রেকর্ড, খতিয়ান ও জমির কাগজপত্র সংরক্ষণম', 'phone' => '01722-654321', 'email' => ' land@dinajpurdc.gov.bd'],
    ['name' => 'শিক্ষা ও গণশিক্ষা দপ্তর', 'desc' => 'বিদ্যালয় ও কলেজ পর্যায়ের শিক্ষা কার্যক্রম তদারকি', 'phone' => '01733-987654', 'email' => 'education@dinajpurdc.gov.bd'],
    ['name' => 'স্বাস্থ্য ও পরিবার কল্যাণ দপ্তর', 'desc' => 'জেলা স্বাস্থ্যসেবা ও হাসপাতাল ব্যবস্থাপনা', 'phone' => '01744-112233', 'email' => 'health@dinajpurdc.gov.bd'],
    ['name' => 'কৃষি সম্প্রসারণ দপ্তর', 'desc' => 'চাষাবাদ, কৃষি উপকরণ ও কৃষক সহায়তা', 'phone' => '01744-112233', 'email' => 'agriculture@dinajpurdc.gov.bd'],
    ['name' => 'শিল্প ও বাণিজ্য দপ্তর', 'desc' => 'ক্ষুদ্র ও মাঝারি শিল্প উন্নয়ন এবং ব্যবসায়িক নিবন্ধন', 'phone' => '01744-112233', 'email' => 'industry@dinajpurdc.gov.bd'],
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
