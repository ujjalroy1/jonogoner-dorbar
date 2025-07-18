<!DOCTYPE html>
<html lang="en">

<head>
  <title>Complaints</title>
  @include('home.css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  @include('home.navigation')

  <div class="container py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>অভিযোগের তালিকা</h2>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#complaintModal">Create</button>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-light">
              <tr>
                <th>No.</th>
                <th>ধরন</th>
                <th>স্থান</th>
                <th>বর্ণনা</th>
                <th>সংযুক্তি</th>
                <th>পরিচয়</th>
              </tr>
            </thead>
            <tbody>
              @if($ovijogs->isEmpty())
              <tr>
                <td colspan="6" class="text-center text-muted">কোনো অভিযোগ নেই</td>
              </tr>
              @else
              @php
              $types = [
              1 => 'ভূমি-সেবা',
              2 => 'স্বাস্থ্য-সেবা',
              3 => 'শিক্ষা-সেবা',
              4 => 'নিরাপত্তা ও শৃঙ্খলা',
              5 => 'পর্যটন ও ঐতিহ্য',
              6 => 'তথ্য অধিকার',
              7 => 'কর্মসম্পাদন ব্যবস্থাপনা',
              8 => 'মানব সম্পদ',
              9 => 'বাজেট ব্যবস্থাপনা',
              10 => 'আশ্রয়ণ প্রকল্প',
              11 => 'উদ্ভাবনী কার্যক্রম',
              12 => 'রাজস্ব সংক্রান্ত তথ্য'
              ];
              @endphp

              @foreach ($ovijogs as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $types[$item->type] ?? 'অজানা বিভাগ' }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
                <td class="py-2 px-4">
                  @php
                  $attachments = json_decode($item->attachment, true);
                  @endphp
                  @if (is_array($attachments))
                  @foreach ($attachments as $i => $file)
                  <a href="{{ asset('storage/' . $file['path']) }}" download class="text-primary d-block">
                    file{{ $i + 1 }}.{{ pathinfo($file['original'], PATHINFO_EXTENSION) }}
                  </a>
                  @endforeach
                  @else
                  —
                  @endif
                </td>
                <td>{{ $item->hide == 0 ? 'লুকানো' : 'দেখানো' }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Complaint Modal -->
  <div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('ovijogs.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="complaintModalLabel">অভিযোগ জমা দিন</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="type" class="form-label">ধরন</label>
              <select name="type" id="type" class="form-select" required>
                <option disabled selected>একটি পছন্দ করুন</option>
                <option value="1">ভূমি-সেবা</option>
                <option value="2">স্বাস্থ্য-সেবা</option>
                <option value="3">শিক্ষা-সেবা</option>
                <option value="4">নিরাপত্তা ও শৃঙ্খলা</option>
                <option value="5">পর্যটন ও ঐতিহ্য</option>
                <option value="6">তথ্য অধিকার</option>
                <option value="7">কর্মসম্পাদন ব্যবস্থাপনা</option>
                <option value="8">মানব সম্পদ</option>
                <option value="9">বাজেট ব্যবস্থাপনা</option>
                <option value="10">আশ্রয়ণ প্রকল্প</option>
                <option value="11">উদ্ভাবনী কার্যক্রম</option>
                <option value="12">রাজস্ব সংক্রান্ত তথ্য</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">স্থান</label>
              <input type="text" name="address" id="address" class="form-control" placeholder="বাশেরহাট, দিনাজপুর" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">বর্ণনা</label>
              <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="mb-4">
              <label class="form-label">সংযুক্তি (যদি থাকে)</label>
              <input type="file" name="attachment[]" class="form-control" multiple>
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" name="hide" value="1" class="form-check-input" id="hideCheckbox">
              <label for="hideCheckbox" class="form-check-label">পরিচয় গোপন রাখতে টিক দিন</label>
            </div>

            <input type="hidden" name="status" value="0">
            <input type="hidden" name="feedback">
            <input type="hidden" name="comment">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
            <button type="submit" class="btn btn-primary">জমা দিন</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('home.footer')
  @include('home.jss')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>