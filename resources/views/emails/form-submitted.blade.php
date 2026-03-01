<h1>Hello, {{ $donorName }}!</h1>
<p>Thank you for filling out the donor screening form at our facility.</p>
<p>You can download your completed form as a PDF by clicking the button below. This link will expire in 24 hours.</p>

<a href="{!! $url !!}"
    style="background: #cc0000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
    Download PDF Form
</a>

<p>If you did not request this, please ignore this email.</p>
