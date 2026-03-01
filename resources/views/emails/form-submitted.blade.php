<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Donor Screening Form</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation"
                    style="max-width: 600px; width: 100%;">

                    {{-- Header --}}
                    <tr>
                        <td
                            style="background-color: #b91c1c; border-radius: 12px 12px 0 0; padding: 36px 40px; text-align: center;">
                            <p
                                style="margin: 0 0 8px 0; font-size: 13px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: #fca5a5;">
                                Blood Donor Program</p>
                            <h1
                                style="margin: 0; font-size: 28px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">
                                Your Form is Ready</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 40px 40px 32px;">

                            <p style="margin: 0 0 8px 0; font-size: 18px; font-weight: 600; color: #111827;">Hello,
                                {{ $donorName }}!</p>
                            <p style="margin: 0 0 28px 0; font-size: 15px; line-height: 1.7; color: #6b7280;">
                                Thank you for completing the donor screening form. Your completed form is available as a
                                PDF and ready to download.
                            </p>

                            {{-- Divider --}}
                            <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 0 0 28px 0;">

                            {{-- CTA --}}
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td align="center" style="padding: 8px 0 32px;">
                                        <a href="{!! $url !!}"
                                            style="display: inline-block; background-color: #b91c1c; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 600; padding: 14px 36px; border-radius: 8px; letter-spacing: 0.3px;">
                                            Download PDF Form &rarr;
                                        </a>
                                        <p style="margin: 14px 0 0; font-size: 13px; color: #9ca3af;">This link will
                                            expire in <strong style="color: #6b7280;">7 days</strong>.</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td
                            style="background-color: #f9fafb; border-top: 1px solid #f3f4f6; border-radius: 0 0 12px 12px; padding: 24px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af; line-height: 1.6;">
                                If you did not request this, you can safely ignore this email.<br>
                                Please do not reply to this message.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
