<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Onboarding</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">

    <div style="background-color: #ffffff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #333; text-align: center;">Welcome Onboard!</h1>
        <p style="color: #666; text-align: center;">Thank you for signing up. Please confirm your email address.</p>

        <hr style="border: 1px solid #ddd; margin: 20px 0;">

        <p style="color: #666;">Hello {{ $user->name }},</p>
        <p style="color: #666;">To complete your registration, please click the button below:</p>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{@routes("login")}}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px;">Login Now</a>
        </div>

        <hr style="border: 1px solid #ddd; margin: 20px 0;">

        <p style="color: #666;">Your login details:</p>
        <ul style="color: #666;">
            <li>Username: {{$user->email}}</li>
            <li>Password: {{$password}}</li>
        </ul>

        <p style="color: #666;">If you did not sign up for our website, please ignore this email.</p>
    </div>

    <p style="color: #999; text-align: center; margin-top: 20px;">© {{year("y")}} Zamfara State Project Monitoring Solution. All rights reserved.</p>
</body>

</html>