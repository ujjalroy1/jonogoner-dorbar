<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>অভিযোগ তালিকা</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center mb-4">অভিযোগ তালিকা</h3>
        <div class="table-responsive">
            <table id="complaintTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>ধরন</th>
                        <th>বর্ণনা</th>
                        <th>সংযুক্তি</th>
                        <th>পরিচয়</th>
                        <th>মন্তব্য</th>
                        <th>রেটিং</th>
                        <th>অবস্থা</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ovijog)
                    <tr>
                        <td>{{ $ovijog->id }}</td>
                        <td>ভূমি-সেবা</td>
                        <td class="text-start">{{ $ovijog->description }}</td>
                        <td>
                            @if($ovijog->attachment)
                            @foreach(json_decode($ovijog->attachment, true) as $file)
                            <a href="{{ asset('storage/' . $file['path']) }}" download class="d-block text-decoration-none text-primary">
                                <i class="fas fa-paperclip"></i> {{ $file['original'] }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if ($ovijog->hide == 1)
                            <i class="fas fa-user-circle text-secondary"></i> {{ $ovijog->user->name ?? 'Annonymus' }}
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $ovijog->comment ?? '—' }}</td>
                        <td>
                            @php
                            $ratingMap = [
                            1 => ['text' => 'খুব খারাপ', 'color' => 'rating-1'],
                            2 => ['text' => 'মোটামুটি', 'color' => 'rating-2'],
                            3 => ['text' => 'ভালো', 'color' => 'rating-3'],
                            4 => ['text' => 'খুব ভালো', 'color' => 'rating-4'],
                            5 => ['text' => 'চমৎকার', 'color' => 'rating-5']
                            ];
                            $rating = $ovijog->feedback ? $ratingMap[$ovijog->feedback] : null;
                            @endphp
                            @if($rating)
                            <span class="rating-badge {{ $rating['color'] }}">
                                <i class="fas fa-star"></i> {{ $rating['text'] }}
                            </span>
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @switch($ovijog->status)
                            @case('pending')
                            <span class="status-badge status-pending"><i class="fas fa-clock"></i> Pending</span>
                            @break
                            @case('processing')
                            <span class="status-badge status-processing"><i class="fas fa-sync-alt"></i> Processing</span>
                            @break
                            @case('solved')
                            <span class="status-badge status-solved"><i class="fas fa-check-circle"></i> Solved</span>
                            @break
                            @default
                            <span class="text-muted">N/A</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Description/Attachment Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">বিস্তারিত</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Dynamic content here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/gh/kidwai/pdfmake-bangla-fonts@latest/build/vfs_fonts.js"></script> -->
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#complaintTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        customize: function(doc) {
                            console.log('Customizing PDF');
                            // Set font
                            doc.defaultStyle = {
                                font: 'kalpurush'
                            };
                            // Fallback to Roboto if kalpurush fails
                            if (!pdfMake.fonts['kalpurush']) {
                                console.warn('kalpurush font not found, falling back to Roboto');
                                doc.defaultStyle.font = 'Roboto';
                            }
                            // Adjust table to span 90% of page width and center it
                            doc.content.forEach(function(item) {
                                if (item.table) {
                                    // Center the table (90% of 595pt = 535pt, margin = (595-535)/2 = 30pt)
                                    item.margin = [30, 0, 30, 0];
                                    // Set column widths to distribute evenly (8 columns)
                                    item.table.widths = ['*', '*', '*', '*', '*', '*', '*', '*'];
                                    // Optional: Center text in cells and add padding
                                    item.table.body.forEach(function(row) {
                                        row.forEach(function(cell) {
                                            if (typeof cell === 'object') {
                                                cell.alignment = 'center';
                                                cell.margin = [5, 5, 5, 5]; // Add padding inside cells
                                            }
                                        });
                                    });
                                    // Add table border for clarity
                                    item.table.layout = {
                                        hLineWidth: function(i, node) {
                                            return 1;
                                        },
                                        vLineWidth: function(i, node) {
                                            return 1;
                                        },
                                        hLineColor: function(i, node) {
                                            return 'black';
                                        },
                                        vLineColor: function(i, node) {
                                            return 'black';
                                        }
                                    };
                                }
                            });
                        }
                    }
                ]
            });

            // Define fonts for pdfmake
            pdfMake.fonts = {
                kalpurush: {
                    normal: 'kalpurush.ttf',
                    bold: 'kalpurush.ttf',
                    italics: 'kalpurush.ttf',
                    bolditalics: 'kalpurush.ttf'
                },
                Roboto: {
                    normal: 'Roboto-Regular.ttf',
                    bold: 'Roboto-Medium.ttf',
                    italics: 'Roboto-Italic.ttf',
                    bolditalics: 'Roboto-MediumItalic.ttf'
                }
            };

            // Handle modal view
            $('#complaintTable tbody').on('click', 'td', function() {
                const columnIndex = $(this).index();
                if (columnIndex === 2 || columnIndex === 3) {
                    const content = $(this).html();
                    $('#modalBodyContent').html(content);
                    new bootstrap.Modal(document.getElementById('detailModal')).show();
                }
            });
        });
    </script>
</body>

</html>