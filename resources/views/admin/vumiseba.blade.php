<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>

    <!-- header -->
    @include('admin.header')
    <!-- header end -->
    <!-- sidebar -->

    @include('admin.sidebar')

    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success')}}

            </div>
            @endif
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom"> অভিযোগ Dashboard</h2>
            </div>
        </div>

        <div>
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">অভিযোগ তালিকা</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>ধরন</th>
                                    <th>বর্ণনা</th>
                                    <th>সংযুক্তি</th>
                                    <th>পরিচয়</th>
                                    <th>অবস্থা</th>
                                    <th>মুছুন</th>
                                    <th>স্থানান্তর</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ovijogs as $ovijog)
                                <tr>
                                    <td>{{ $ovijog->id }}</td>
                                    <td>ভূমি-সেবা</td>
                                    <td class="text-start" style="max-width: 300px; word-wrap: break-word;">
                                        {{ $ovijog->description }}
                                    </td>
                                    <td class="text-start">
                                        @php
                                        $attachments = json_decode($ovijog->attachment, true);
                                        @endphp
                                        @if (is_array($attachments))
                                        @foreach ($attachments as $file)
                                        <a href="{{ asset('storage/' . $file['path']) }}" download class="text-primary d-block">
                                            📎 {{ $file['original'] }}
                                        </a>
                                        @endforeach
                                        @else
                                        —
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ovijog->hide == 1)
                                        {{ $ovijog->user->name ?? 'N/A' }}
                                        @else
                                        N/A
                                        @endif
                                    </td>

                                    <td>
                                        <form method="POST" action="{{ url('admin/status-change',$ovijog->id) }}">
                                            @csrf

                                            <select name="status" class="form-select form-select-sm" style="
                                                @if($ovijog->status === 'pending') 
                                                background-color:#ff4d4d; color:white; 
                                                @elseif($ovijog->status === 'processing') 
                                                background-color:#ffc107; color:black; 
                                                @elseif($ovijog->status === 'solved') 
                                                 background-color:#28a745; color:white; 
                                                 @endif
                                                " onchange="this.form.submit()">
                                                <option value="pending" {{ $ovijog->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $ovijog->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="solved" {{ $ovijog->status === 'solved' ? 'selected' : '' }}>Solved</option>
                                            </select>

                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('vumiseba_delete',$ovijog->id) }}" class="btn btn-danger" onclick="return confirm('আপনি কি মুছে ফেলতে নিশ্চিত?')">বাতিল</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ url('admin/type-change', $ovijog->id) }}" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এটি পরিবর্তন করতে চান?');">
                                            @csrf

                                            <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="1" {{ $ovijog->type == 1 ? 'selected' : '' }}>ভূমি-সেবা</option>
                                                <option value="2" {{ $ovijog->type == 2 ? 'selected' : '' }}>স্বাস্থ্য-সেবা</option>
                                                <option value="3" {{ $ovijog->type == 3 ? 'selected' : '' }}>শিক্ষা-সেবা</option>
                                                <option value="4" {{ $ovijog->type == 4 ? 'selected' : '' }}>নিরাপত্তা ও শৃঙ্খলা</option>
                                                <option value="5" {{ $ovijog->type == 5 ? 'selected' : '' }}>পর্যটন ও ঐতিহ্য</option>
                                                <option value="6" {{ $ovijog->type == 6 ? 'selected' : '' }}>তথ্য অধিকার</option>
                                                <option value="7" {{ $ovijog->type == 7 ? 'selected' : '' }}>কর্মসম্পাদন ব্যবস্থাপনা</option>
                                                <option value="8" {{ $ovijog->type == 8 ? 'selected' : '' }}>মানব সম্পদ</option>
                                                <option value="9" {{ $ovijog->type == 9 ? 'selected' : '' }}>বাজেট ব্যবস্থাপনা</option>
                                                <option value="10" {{ $ovijog->type == 10 ? 'selected' : '' }}>আশ্রয়ণ প্রকল্প</option>
                                                <option value="11" {{ $ovijog->type == 11 ? 'selected' : '' }}>উদ্ভাবনী কার্যক্রম</option>
                                                <option value="12" {{ $ovijog->type == 12 ? 'selected' : '' }}>রাজস্ব সংক্রান্ত তথ্য</option>
                                            </select>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <!-- JavaScript files -->
    @include('admin.jss')
    <!-- end js -->

</body>

</html>