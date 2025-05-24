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
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
        </div>

        <div>
            <div class="container py-4">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📋 নোটিশ বোর্ড</h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>🔖 শিরোনাম</th>
                                        <th>📝 বর্ণনা</th>
                                        <th>📅 তারিখ</th>
                                        <th>✏️ এডিট</th>
                                        <th>🗑️ ডিলিট</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notices as $notice)
                                    <tr>
                                        <td>{{ $notice->title }}</td>
                                        <td>{{ $notice->description }}</td>
                                        <td>{{ $notice->date }}</td>
                                        <td>
                                            <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-sm btn-outline-primary w-100">
                                                এডিট
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('notice.delete', $notice->id) }}"
                                                class="btn btn-sm btn-outline-danger w-100"
                                                onclick="return confirm('আপনি কি মুছে ফেলতে চান?')">
                                                ডিলিট
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-muted">কোনো নোটিশ পাওয়া যায়নি।</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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