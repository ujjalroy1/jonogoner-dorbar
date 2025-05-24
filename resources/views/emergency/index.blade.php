<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Emergency Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @include('home.css')
</head>

<body class="bg-gray-100 font-sans antialiased">
    @include('home.navigation')
    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">জরুরি বার্তা</h2>

            @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($emergencies as $emergency)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $emergency->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">{{ $emergency->type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($emergency->description, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($emergency->address, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($emergency->attachment)
                                <a href="{{ asset('storage/' . $emergency->attachment) }}" class="text-blue-600 hover:underline" target="_blank">View</a>
                                @else
                                None
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $emergency->rating ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($emergency->comment ?? 'N/A', 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 py-1 rounded-full text-xs capitalize
                                    @if($emergency->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($emergency->status == 'processing') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $emergency->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <form action="{{ route('emergency.updateStatus', $emergency->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-red-500">
                                        <option value="pending" {{ $emergency->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $emergency->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $emergency->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                                <form action="{{ route('emergency.delete', $emergency->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this emergency message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">No emergency messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $emergencies->links() }}
            </div>
        </div>
    </div>
    @include('home.footer')
    @include('home.jss')
</body>

</html>