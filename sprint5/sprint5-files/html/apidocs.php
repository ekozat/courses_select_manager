<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: auto;
            max-width: 1240px;
        }
        .codebox{
            display: block;
            border: none;
            border-radius: 10px;
            background-color: #EEE9E3;
            max-width: 650px;
        }
        
        a{
            color: blue;
            text-decoration: none;
        }
        a:hover {
             text-decoration: underline;
        }
        hr{
            max-width: 1000px;
            margin-left:0;
        }
    </style>
</head>
<body>

    <?php
    // Function to convert Markdown to HTML
    function markdownToHtml($markdown) {

        // Convert headers (e.g., # Header)
        // Order matters! Would only pick up the singular # without it
        $markdown = preg_replace('/\#\#\# (.+)/', '<h3>$1</h3>', $markdown);
        $markdown = preg_replace('/\#\# (.+)/', '<h2>$1</h2>', $markdown);
        $markdown = preg_replace('/\# (.+)/', '<h1>$1</h1>', $markdown);

        // Convert paragraphs
        $markdown = "<p>".str_replace("\n\n", "<p></p>", $markdown)."</p";
        $markdown = "<p>".str_replace("---", "<hr></hr>", $markdown)."</p";


        // line breaks to /n
        $markdown = preg_replace('/\n/', "<br>", $markdown);

        // Convert ** to bold tags
        $markdown = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $markdown);

        // Convert triple backticks for code blocks (covers multiple lines)
        $markdown = preg_replace('/```(.*?)```/s', '<div class="codebox"><pre><code>$1</code></pre></div>', $markdown);

        // Convert single backticks for code blocks
        $markdown = preg_replace('/`(.*?)`/s', '<pre><code>$1</code></pre>', $markdown);

        // Convert links
        $markdown = preg_replace('/[?:>]?(https?:\/\/[^\s]+)/', '<a href="$1">$1</a>', $markdown);


        return $markdown;
    }

    // Read the Markdown file
    $markdownContent = file_get_contents('API.md');

    // Convert Markdown to HTML
    $htmlContent = markdownToHtml($markdownContent);

    // Display the HTML content
    echo $htmlContent;
    ?>
</body>
</html>
