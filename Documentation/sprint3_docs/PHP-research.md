# PHP

## Sara Adi
**Variables**
* `$variableName = "Some value";` - Declares a variable.

**Echo and Print**
* `echo "Hello, world!";` - Outputs text or HTML.
* `print("Hello, world!");` - Similar to echo but returns 1 for success.

**Comments**
* `// This is a single-line comment`
* `/* This is a multi-line comment */`

**Constants**
* `define("PI", 3.14159265359);` - Defines a constant.

**Sample**

```
<!DOCTYPE html>
<html>
<head>
    <title>CIS 3760 Research Doc</title>
</head>
<body>
    <?php
        echo "Hi there, this is the CIS 3760 research doc";
    ?>
</body>
</html>
```

## Maneesh Wijewardhana
-   There exists the `DOMDocument` class in PHP that allows you to manipulate the DOM
    -   Functions such as GetElementById(), createElement(), createAttribute() are present among many other familiar ones
-   Form Control Example:
```html
<html>
    <body>

        <form action="welcome.php" method="post">
            First Name: <input type="text" name="first"><br>
            Last Name: <input type="text" name="last"><br>
            <input type="submit">
        </form>
    </body>
</html>
```

firstlast.php can then be created to extract out the variables using $_POST
```php
<html>
    <body>
        Your first name is: <?php echo $_POST["first"]; ?><br>
        Your last name is: <?php echo $_POST["last"]; ?>
    </body>
</html>
```

Assuming the form was submitted, this will result in:

```
Your first name is Maneesh
Your last name is Wijewardhana
```

## Fee Kim Ah-Poa

- PHP is a server scripting language
- PHP can written anywhere in a document
- It has the following syntax

 ```
 <?php

 // code is placed here

 ?>

 ```
- it has a file extension .php
- it has html tags and php scripts
- Its statements ends with ;
- PHP can be local, global and static
- It supports different data types such as string, integer, float, boolean, array, object, null
- PHP supports +,-,*,/,% and **
- It has while, do while , for and foreach loops
-

    

