<?php
$param = json_decode(file_get_contents("php://input"));
$secret = '6LdV8ygTAAAAAKNOz5sH3S4hWbAjIlvQtf2f3EVP';
$response = $param->response;
$input = $param->fields;
$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
$responseData = json_decode($verifyResponse);
if ($responseData->success) {
    $name = filter_var($input->name, FILTER_SANITIZE_STRING);
    $location = filter_var($input->location, FILTER_SANITIZE_STRING);
    $email = filter_var($input->email, FILTER_SANITIZE_EMAIL);
    $number = filter_var($input->number, FILTER_SANITIZE_NUMBER_INT);
    $comment = filter_var($input->comment, FILTER_SANITIZE_STRING);

    $to = 'kannan22m@gmail.com';
    $subject = 'Friends Tamil mp3 | Comment';
    $htmlContent = "
            <style>
                tr,th,td{
                    border: 1px solid #000;
                }
                th,td{
                    padding: 10px;
                }
                th{
                    text-align: right;
                }
                td{
                    text-align: left;
                }
            </style>
                <table>
                    <tr>
                        <th>Name:</th>
                        <td>$name</td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td>$location</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <th>Mobile:</th>
                        <td>$number</td>
                    </tr>
                    <tr>
                        <th>Comment:</th>
                        <td>$comment</td>
                    </tr>
                </table>
            ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";

    @mail($to,$subject,$htmlContent,$headers);

    echo 'success';
} else {
    echo 'failed';
}