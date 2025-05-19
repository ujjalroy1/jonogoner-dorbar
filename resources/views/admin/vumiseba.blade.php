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
                                    <th>Transfer</th>
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
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $ovijog->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $ovijog->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="solved" {{ $ovijog->status === 'solved' ? 'selected' : '' }}>Solved</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">মুছুন</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="#">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Transfer</button>
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