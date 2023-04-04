<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');




?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- css style sheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinny AI</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
        }

        form {
            width: 60%;
            margin: 0 auto;
            background-color: #fff;
            border: 2px solid #ddd;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        } */

        button:hover {
            background-color: #3e8e41;
        }

        /* #reset-btn {
            background-color: #ddd;
            color: #333;
        } */

        #debugger-output {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            border: 2px solid #ddd;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            white-space: pre-wrap;
            font-family: monospace;
            font-size: 16px;
        }

        #prompt {
            font-family: Arial, sans-serif;
            font-size: 16px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            resize: none;
            width: 100%;
            box-sizing: border-box;
        }

        #prompt:focus {
            border-color: #07b6bf;
        }

        #reset-btn,
        #submit-btn {
            background-color: #07b6bf;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #reset-btn:hover,
        #submit-btn:hover {
            background-color: #03594b;
        }
    </style>
</head>

<body>
    <!------------------------------------------- nav bar ------------------------------------------------------------>
    <div id="navii" class="navi bg-success">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="home.php">CodeSpindle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="spinny.php">Spinny</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="java.php">Java</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="html.php">Html</a>
                    </li>
                    <?php
                    if ($_SESSION['type'] == "admin") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="set_test.php">Set Test</a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="take_test.php">Take Test</a>
                    </li>
                    <li>

                        <a href="" class="text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-link">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <a class="dropdown-item" href="">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="">User Details</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">Sign out</a>
                            </li>
                        </ul>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
    <!-- ********************************************************************************************************** -->

    <h1>Spinny AI</h1>
    <form id="debugger-form" method="post">
        <textarea id="prompt" name="prompt" rows="5" cols="50" placeholder="Type your query here..."></textarea>
        <br>
        <button type="button" id="reset-btn" onclick="resetQuery()">Reset Query</button>
        <button type="submit" id="submit-btn">Submit</button>
    </form>

    <script>
        function resetQuery() {
            // Get the text area element and response
            var textarea = document.getElementById("prompt");
            var res = document.getElementById("res");


            // Reset the value of the text area
            textarea.value = "";
            res.innerHTML = "";
            textarea.focus();
        }
    </script>







</body>


<!-- ------------------------------------------------------------------------------------------------------------------------------- -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the prompt from the form data
    $prompt = $_POST['prompt'];

    // Define the programming and coding keywords
    $keywords = array(
        'programming',
        'coding',
        'code',
        'algorithm',
        'debug',
        'syntax',
        'function',
        'variable',
        'class',
        '{',
        '}',
        '[',
        ']',
        '+',
        '(',
        ')',
        '%',
        '*',
        '&',
        '/',
        '<',
        '>',
        '-',
        'java',
        'c++',
        'python',
        'html',
        'css',
        'javascript',
        'jquery',
        'monogo db',
        'sql',
        'mysql',
        'database',
        'flutter',
        'dart',
        'error'
    );

    // Check if the prompt contains any of the keywords
    $contains_keyword = false;
    foreach ($keywords as $keyword) {
        if (stripos($prompt, $keyword) !== false) {
            $contains_keyword = true;
            break;
        }
    }

    if ($contains_keyword) {
        // Initialize a new cURL session
        $ch = curl_init();

        // Set the URL to send the request to
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');

        // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Use the POST method to send the request
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the request body as a JSON-encoded string
        $request_data = array(
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 0,
            'max_tokens' => 2000,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));

        // Set the request headers
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer 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' // Replace YOUR_API_KEY with your actual API key
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Send the request and store the response in a variable
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch) . '<br>';
            echo 'HTTP status code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }

        // Close the cURL session
        curl_close($ch);

        // Output the API response
        $responseObj = json_decode($response);
        $completedCode = $responseObj->choices[0]->text;
        ?>
        <div id="debugger-output">
            <h4 id="res">
                <?php echo $completedCode; ?>
            </h4>
        </div>
        <?php
    } else {

        ?>
        <div id="debugger-output">
            <h4 id="res">
                Sorry, I can only clarify and debug code.
            </h4>
        </div>
        <?php
    }
}
?>