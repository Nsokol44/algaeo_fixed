<p>You have received a new contact form submission:</p>
<p><strong>Name:</strong> {{ $formData['name'] }}</p>
<p><strong>Email:</strong> {{ $formData['email'] }}</p>
@isset($formData['subject'])
    <p><strong>Subject:</strong> {{ $formData['subject'] }}</p>
@endisset
<p><strong>Message:</strong></p>
<p>{{ $formData['message'] }}</p>