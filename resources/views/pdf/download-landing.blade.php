<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Your Form</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f7;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            padding: 24px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            max-width: 460px;
            width: 100%;
            overflow: hidden;
        }

        .card-header {
            background-color: #b91c1c;
            padding: 32px 40px;
            text-align: center;
        }

        .card-header .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fca5a5;
            margin-bottom: 10px;
        }

        .card-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.3px;
        }

        .card-body {
            padding: 36px 40px 32px;
            text-align: center;
        }

        .icon-wrap {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #fef2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-wrap svg {
            width: 30px;
            height: 30px;
            color: #b91c1c;
        }

        .card-body p {
            font-size: 15px;
            line-height: 1.7;
            color: #6b7280;
            margin-bottom: 28px;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #b91c1c;
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            transition: background-color 0.15s ease;
            letter-spacing: 0.2px;
        }

        .btn-download:hover {
            background-color: #991b1b;
        }

        .btn-download svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .notice {
            margin-top: 20px;
            font-size: 13px;
            color: #9ca3af;
        }

        .card-footer {
            border-top: 1px solid #f3f4f6;
            background-color: #f9fafb;
            padding: 20px 40px;
            text-align: center;
        }

        .card-footer p {
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-header">
            <div class="badge">Blood Donor Program</div>
            <h1>Your Form is Ready</h1>
        </div>

        <div class="card-body">
            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#b91c1c"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>

            <p>Your completed donor screening form is ready. Click the button below to download your PDF.</p>

            <a href="{{ $downloadUrl }}" class="btn-download">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Download PDF Form
            </a>

            <p class="notice">This download link is active for 30 minutes from when you opened this page.</p>
        </div>

        <div class="card-footer">
            <p>If you didn't request this, you can safely close this page.<br>Please do not share this link with others.
            </p>
        </div>
    </div>

</body>

</html>
