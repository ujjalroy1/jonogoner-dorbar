<!DOCTYPE html>
<html lang="en">
<head>
    <title>Complaint List</title>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --header-bg: #1a365d;
            --primary-color: #2b6cb0;
            --text-dark: #2d3748;
            --text-light: #f7fafc;
        }

        .header-container {
            background: var(--header-bg);
            border-bottom: 3px solid #f6ad55;
        }

        .header-title {
            color: #ffffff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
            letter-spacing: 0.05em;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-pending { background: #fffaf0; color: #c05621; }
        .status-processing { background: #ebf8ff; color: #2b6cb0; }
        .status-solved { background: #f0fff4; color: #2f855a; }

        .rating-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .rating-1 { background: #FEE2E2; color: #B91C1C; }
        .rating-2 { background: #FEF3C7; color: #B45309; }
        .rating-3 { background: #FEF9C3; color: #A16207; }
        .rating-4 { background: #DCFCE7; color: #047857; }
        .rating-5 { background: #DBEAFE; color: #1D4ED8; }

        @media (max-width: 767px) {
            table {
                border: 0;
                width: 100%;
            }

            table thead {
                display: none;
            }

            table tr {
                display: block;
                margin-bottom: 1.5rem;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                background: white;
            }

            table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #e2e8f0;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--text-dark);
                margin-right: 1rem;
                text-align: left;
                flex: 1;
            }

            table td:last-child {
                border-bottom: 0;
            }

            .status-badge,
            .rating-badge {
                width: 100%;
                justify-content: flex-end;
            }
        }

        @media (min-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }

        .comment-text {
            color: #2d3748;
            line-height: 1.5;
            max-width: 250px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('home.navigation')
    <!-- End Navbar -->

    <div class="container py-5">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="header-container px-4 py-4 sm:px-6 sm:py-5">
                <h2 class="header-title text-xl sm:text-2xl font-bold">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    অভিযোগ তালিকা
                </h2>
            </div>

            <div class="px-4 py-4 sm:px-6 sm:py-6">
                <div class="table-responsive">
                    <table class="w-full">
                        <thead class="bg-gray-100 hidden sm:table-header-group">
                            <tr>
                                <th class="py-3 px-4 text-left">ID</th>
                                <th class="py-3 px-4 text-left">ধরন</th>
                                <th class="py-3 px-4 text-left">বর্ণনা</th>
                                <th class="py-3 px-4 text-left">সংযুক্তি</th>
                                <th class="py-3 px-4 text-left">পরিচয়</th>
                                <th class="py-3 px-4 text-left">মন্তব্য</th>
                                <th class="py-3 px-4 text-left">রেটিং</th>
                                <th class="py-3 px-4 text-left">অবস্থা</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $ovijog)
                            <tr class="block sm:table-row">
                                <!-- ID -->
                                <td data-label="ID" class="sm:table-cell py-3 px-4">
                                    {{ $ovijog->id }}
                                </td>

                                <!-- Type -->
                                <td data-label="ধরন" class="sm:table-cell py-3 px-4">
                                    ভূমি-সেবা
                                </td>

                                <!-- Description -->
                                <td data-label="বর্ণনা" class="sm:table-cell py-3 px-4">
                                    <div class="line-clamp-2 text-gray-800">
                                        {{ $ovijog->description }}
                                    </div>
                                </td>

                                <!-- Attachment -->
                                <td data-label="সংযুক্তি" class="sm:table-cell py-3 px-4">
                                    @if($ovijog->attachment)
                                        <div class="flex flex-col gap-2">
                                            @foreach(json_decode($ovijog->attachment, true) as $file)
                                                <a href="{{ asset('storage/' . $file['path']) }}" download 
                                                   class="flex items-center gap-2 text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-paperclip text-sm"></i>
                                                    <span class="text-sm break-all">{{ $file['original'] }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>

                                <!-- Identity -->
                                <td data-label="পরিচয়" class="sm:table-cell py-3 px-4">
                                    @if ($ovijog->hide == 1)
                                        <div class="flex items-center gap-2 text-gray-800">
                                            <i class="fas fa-user-circle text-gray-500"></i>
                                            {{ $ovijog->user->name ?? 'N/A' }}
                                        </div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>

                                <!-- Comment -->
                                <td data-label="মন্তব্য" class="sm:table-cell py-3 px-4">
                                    @if($ovijog->comment)
                                        <div class="comment-text">
                                            {{ $ovijog->comment }}
                                        </div>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <!-- Rating -->
                                <td data-label="রেটিং" class="sm:table-cell py-3 px-4">
                                    @if($ovijog->feedback)
                                        @php
                                            $ratingMap = [
                                                1 => ['text' => 'খুব খারাপ', 'color' => 'rating-1'],
                                                2 => ['text' => 'মোটামুটি', 'color' => 'rating-2'],
                                                3 => ['text' => 'ভালো', 'color' => 'rating-3'],
                                                4 => ['text' => 'খুব ভালো', 'color' => 'rating-4'],
                                                5 => ['text' => 'চমৎকার', 'color' => 'rating-5']
                                            ];
                                            $rating = $ratingMap[$ovijog->feedback];
                                        @endphp
                                        <div class="rating-badge {{ $rating['color'] }}">
                                            <i class="fas fa-star text-sm"></i>
                                            {{ $rating }}
                                        </div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td data-label="অবস্থা" class="sm:table-cell py-3 px-4">
                                    <div class="status-badge status-{{ $ovijog->status }}">
                                        @switch($ovijog->status)
                                            @case('pending')
                                                <i class="fas fa-clock text-sm"></i>
                                                Pending
                                            @break
                                            @case('processing')
                                                <i class="fas fa-sync-alt text-sm"></i>
                                                Processing
                                            @break
                                            @case('solved')
                                                <i class="fas fa-check-circle text-sm"></i>
                                                Solved
                                            @break
                                        @endswitch
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')
    <!-- End Footer -->

    @include('home.jss')
    <script>
        // Mobile-responsive line clamping
        document.querySelectorAll('.line-clamp-2').forEach(element => {
            element.style.display = '-webkit-box';
            element.style.webkitLineClamp = 2;
            element.style.webkitBoxOrient = 'vertical';
            element.style.overflow = 'hidden';
        });
    </script>
</body>
</html>