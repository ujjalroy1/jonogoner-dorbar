<h2>New Emergency Alert</h2>
<p><strong>Type:</strong> {{ $emergency->type }}</p>
<p><strong>Description:</strong> {{ $emergency->description }}</p>
<p><strong>Address:</strong> {{ $emergency->address }}</p>
<p><strong>Phone:</strong> {{ $emergency->phone }}</p>
@if($emergency->attachment)
<p><strong>Attachment:</strong> {{ asset('storage/' . $emergency->attachment) }}</p>
@endif