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
            <div class="container">
                <h2 class="mb-4">নোটিশ এডিট করুন</h2>

                <form action="{{ route('notice.update', $notice->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">শিরোনাম</label>
                        <input type="text" name="title" value="{{ $notice->title }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">বর্ণনা</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ $notice->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">তারিখ</label>
                        <input type="text" name="date" value="{{ $notice->date }}" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">আপডেট করুন</button>
                </form>
            </div>



        </div>


    </div>

    <!-- JavaScript files -->
    @include('admin.jss')
    <!-- end js -->

</body>

</html>