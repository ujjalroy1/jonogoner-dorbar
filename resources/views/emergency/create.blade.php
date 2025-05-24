<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @include('home.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    @include('home.navigation')
    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">জরুরি সেবা</h2>

            @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('emergency.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">মোবাইল নম্বর</label>
                    <input type="text" name="phone" id="phone" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">ধরণ</label>
                    <select name="type" id="type" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                        <option value="">Select type</option>
                        <option value="ambulance">এ্যাম্বুলেন্স</option>
                        <option value="police">পুলিশ</option>
                        <option value="fire_service">দমকল</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">বর্ণনা

                    </label>
                    <textarea name="description" id="description" rows="4" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required></textarea>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">ঠিকানা</label>
                    <input type="text" name="address" id="address" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
                </div>

                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700">সংযুক্তি (যদি থাকে)</label>
                    <input type="file" name="attachment" id="attachment" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition">
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition transform hover:scale-105">
                        জরুরি বার্তা পাঠান
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('home.footer')
    @include('home.jss')
</body>
</html>