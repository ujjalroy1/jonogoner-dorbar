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
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ধরন</th>
                                <th>স্থান</th>
                                <th>বর্ণনা</th>
                                <th>সংযুক্তি</th>
                                <th>পরিচয়</th>
                                <th>অবস্থা</th>
                                <th>রেটিং দিন</th>
                                <th>মুছুন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ovijogs as $item)
                            <tr>
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

                                <td>{{ $types[$item->type] ?? 'অজানা বিভাগ' }}</td>

                                <td>{{ $item->address }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="py-2 px-4">
                                    @php
                                    $attachments = json_decode($item->attachment, true);
                                    @endphp

                                    @if (is_array($attachments))
                                    @foreach ($attachments as $index => $file)
                                    <a href="{{ asset('storage/' . $file['path']) }}" download class="text-primary d-block">
                                        file{{ $index + 1 }}.{{ pathinfo($file['original'], PATHINFO_EXTENSION) }}
                                    </a>
                                    @endforeach
                                    @else
                                    —
                                    @endif
                                </td>
                                <td>{{ $item->hide == 0 ? 'লুকানো' : 'দেখানো' }}</td>
                                <td>
                                    @php
                                    $statusLabels = [
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'complete' => 'Complete'
                                    ];
                                    @endphp

                                    <button class="btn btn-sm 
          @if($item->status == 'pending') btn-secondary 
          @elseif($item->status == 'processing') btn-warning 
          @else btn-success 
          @endif"
                                        data-bs-toggle="modal" data-bs-target="#statusModal{{ $item->id }}">
                                        {{ $statusLabels[$item->status] ?? 'Unknown' }}
                                    </button>
                                </td>

                                <td>
                                    @if ($item->feedback)
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $item->id }}">
                                        {{ $item->feedback }} ⭐
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $item->id }}">
                                        Rate
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('ovijogs.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">মুছুন</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Status Info Modal -->
                            <div class="modal fade" id="statusModal{{ $item->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="statusModalLabel{{ $item->id }}">অবস্থার বিস্তারিত</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge {{ $item->status == 'pending' ? 'bg-secondary' : 'bg-light text-muted' }}">Pending</span>
                                                <span class="text-muted mx-2">→</span>
                                                <span class="badge {{ $item->status == 'processing' ? 'bg-warning' : 'bg-light text-muted' }}">Processing</span>
                                                <span class="text-muted mx-2">→</span>
                                                <span class="badge {{ $item->status == 'completed' ? 'bg-success' : 'bg-light text-muted' }}">Completed</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Feedback Modal -->
                            <div class="modal fade" id="feedbackModal{{ $item->id }}" tabindex="-1" aria-labelledby="feedbackLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('ovijogs.feedback', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="feedbackLabel{{ $item->id }}">ফিডব্যাক দিন</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="feedback" class="form-label">রেটিং (1-5)</label>
                                                    <select name="feedback" class="form-select" required>
                                                        <option value="">-- একটি নির্বাচন করুন --</option>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}" {{ $item->feedback == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য</label>
                                                    <textarea name="comment" class="form-control" rows="3" placeholder="আপনার মন্তব্য">{{ $item->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">জমা দিন</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">কোনো অভিযোগ নেই</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')
    @include('home.jss')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>