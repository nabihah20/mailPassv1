<div>
    {!! $content !!}
</div>

@if ($decryptedContent)
<div class="border-t">
    <h2 class="mt-6 mb-2">Decrypted Content</h2>
    <img src="data:image/png;base64,{!! base64_encode($decryptedContent) !!}" alt="">
</div>

<a href="/download" class="inline-block mt-2">Download Image</a>
@endif

<p>This email is sent by {{ $email }}</p>
<p>via <code>MailPass.com</code> - Secured mail's attachment</p>
