<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
  <nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5">Dinajpur DC Office Admin</h1>
        <p>DC Office</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
      <li class="active"><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"> </i>হোম</a></li>

      <!-- <li><a href="{{ url('/teams') }}"> <i class="icon-grid"></i>Approve </a></li>
                <li><a href="{{ url('/teams_payments') }}"> <i class="icon-grid"></i>Payment List </a></li>
                <li><a href="{{ url('/message-form') }}"> <i class="fa fa-bar-chart"></i> Message </a></li>

                <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> -->
      <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ডিপার্টমেন্ট</a>
        <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
          <li><a href="{{ url('admin/vumiseba',1) }}">ভূমি-সেবা</a></li>
          <li><a href="{{ url('admin/vumiseba',2) }}">স্বাস্থ্য-সেবা</a></li>
          <li><a href="{{ url('admin/vumiseba',3) }}">শিক্ষা-সেবা</a></li>
          <li><a href="{{ url('admin/vumiseba',4) }}">নিরাপত্তা ও শৃঙ্খলা</a></li>
          <li><a href="{{ url('admin/vumiseba',5) }}">পর্যটন ও ঐতিহ্য</a></li>
          <li><a href="{{ url('admin/vumiseba',6) }}">তথ্য অধিকার</a></li>
          <li><a href="{{ url('admin/vumiseba',7) }}">কর্মসম্পাদন ব্যবস্থাপনা</a></li>
          <li><a href="{{ url('admin/vumiseba',8) }}">মানব সম্পদ</a></li>
          <li><a href="{{ url('admin/vumiseba',9) }}">বাজেট ব্যবস্থাপনা</a></li>
          <li><a href="{{ url('admin/vumiseba',10) }}">আশ্রয়ণ প্রকল্প</a></li>
          <li><a href="{{ url('admin/vumiseba',11) }}">উদ্ভাবনী কার্যক্রম</a></li>
          <li><a href="{{ url('admin/vumiseba',12) }}">রাজস্ব সংক্রান্ত তথ্য</a></li>
        </ul>
      </li>
      <li>
        <a href="#noticeDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="icon-windows"></i> নোটিশ
        </a>
        <ul id="noticeDropdown" class="collapse list-unstyled">
          <li><a href="{{ route('admin.notice') }}">নোটিশ যুক্ত করুন</a></li>
          <li><a href="{{ route('notice.show') }}">সব নোটিশ দেখুন</a></li>
        </ul>
      </li>
      <li><a href="{{ route('admin.chat.index') }}"></a></li>






      <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </ul>

  </nav>