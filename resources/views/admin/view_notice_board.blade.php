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
            <div class="container">
                <h2 class="mb-4">নোটিশ বোর্ড</h2>

                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>শিরোনাম</th>
                            <th>বর্ণনা</th>
                            <th>তারিখ</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notices as $notice)
                        <tr>
                            <td>{{ $notice->title }}</td>
                            <td>{{ $notice->description }}</td>
                            <td>{{ $notice->date }}</td>
                            <td>
                                <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-sm btn-primary">এডিট</a>
                                <a href="{{ route('notice.delete', $notice->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('আপনি কি মুছে ফেলতে চান?')">ডিলিট</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- JavaScript files -->
    @include('admin.jss')
    <!-- end js -->

</body>

</html>