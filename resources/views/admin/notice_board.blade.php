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
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
        </div>

        <div>
            <form action="{{ route('notice.store') }}" method="POST">
                @csrf

                <div class="card shadow-sm p-4 mb-4 bg-light rounded">
                    <h4 class="mb-4 text-center text-primary">নতুন নোটিশ যোগ করুন</h4>

                    <div class="mb-3">
                        <label for="title" class="form-label">শিরোনাম</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="নোটিশের শিরোনাম লিখুন" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">বিবরণ</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="নোটিশের বিবরণ লিখুন" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">তারিখ</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">সংরক্ষণ করুন</button>
                    </div>
                </div>
            </form>




        </div>


    </div>

    <!-- JavaScript files -->
    @include('admin.jss')
    <!-- end js -->

</body>

</html>