
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .status-badge {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .card-img {
        max-height: 200px;
        object-fit: cover;
    }

    .feedback {
        font-size: 0.95rem;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 6px;
    }
</style>
<div class="container py-4">
    <h2 class="mb-4 text-center">📬 আমার অভিযোগসমূহ</h2>

    <!-- Complaint Card Loop Start -->
    <!-- Repeat this card maximum 5 times -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div><i class="bi bi-exclamation-diamond"></i> অভিযোগ: রাস্তার গর্ত</div>
            <span class="status-badge bg-warning text-dark">Pending</span>
        </div>
        <div class="card-body">
            <p><strong>তারিখ:</strong> ১২ মে ২০২৫</p>
            <p><strong>বর্ণনা:</strong> আমাদের এলাকার রাস্তায় বড় গর্ত হয়েছে, যেটা দুর্ঘটনার কারণ হতে পারে।</p>
            <p><strong>ফরোয়ার্ড হওয়া দপ্তর:</strong> উপজেলা প্রকৌশলী কার্যালয়</p>
            <img src="https://via.placeholder.com/600x300" class="img-fluid rounded card-img mb-3" alt="অভিযোগ ছবি">

            <div class="feedback mb-2">
                <form>
                    <div class="mb-3">
                        <label for="rating" class="form-label"><strong>Feedback (Rating):</strong></label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="">রেটিং নির্বাচন করুন</option>
                            <option value="1">1 - খুব খারাপ</option>
                            <option value="2">2 - মোটামুটি</option>
                            <option value="3">3 - ভালো</option>
                            <option value="4">4 - খুব ভালো</option>
                            <option value="5">5 - চমৎকার</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="comment" class="form-label"><strong>Comment:</strong></label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="আপনার মন্তব্য লিখুন..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">✅ সাবমিট করুন</button>
                </form>
            </div>


            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-outline-primary btn-sm">✏️ Edit</button>
                <button class="btn btn-outline-danger btn-sm">🗑️ Delete</button>
            </div>
        </div>
    </div>

    <!-- Example 2nd Card (Resolved) -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div><i class="bi bi-check-circle"></i> অভিযোগ: পানির পাইপ লিক</div>
            <span class="status-badge bg-light text-success">Resolved</span>
        </div>
        <div class="card-body">
            <p><strong>তারিখ:</strong> ১০ এপ্রিল ২০২৫</p>
            <p><strong>বর্ণনা:</strong> পানির পাইপ ফেটে গিয়েছে, অনেক পানি অপচয় হচ্ছে।</p>
            <p><strong>ফরোয়ার্ড হওয়া দপ্তর:</strong> জনস্বাস্থ্য প্রকৌশল অধিদপ্তর</p>
            <img src="https://via.placeholder.com/600x300" class="img-fluid rounded card-img mb-3" alt="অভিযোগ ছবি">

            <div class="feedback mb-2">
                <form>
                    <div class="mb-3">
                        <label for="rating" class="form-label"><strong>Feedback (Rating):</strong></label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="">রেটিং নির্বাচন করুন</option>
                            <option value="1">1 - খুব খারাপ</option>
                            <option value="2">2 - মোটামুটি</option>
                            <option value="3">3 - ভালো</option>
                            <option value="4">4 - খুব ভালো</option>
                            <option value="5">5 - চমৎকার</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="comment" class="form-label"><strong>Comment:</strong></label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="আপনার মন্তব্য লিখুন..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">✅ সাবমিট করুন</button>
                </form>
            </div>

        </div>
    </div>

    <!-- Repeat up to 5 cards... -->

    <!-- See More Button -->
    <div class="text-center mt-4">
        <a href="/user/complaints" class="btn btn-outline-secondary">
            আরও অভিযোগ দেখুন <i class="bi bi-arrow-right-circle"></i>
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>