<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        var_dump($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>form</title>
    </head>
    <body>
        <form action="" method="POST">
            <fieldset>
                <legend>legend1</legend>
                enter a number <input type="number" name="number" pattern="\{/d}[2]\">
                <label>enter your name:<input type="text" name="name" placeholder="this is a placeholder" value="readonly" readonly /></label><br />
                <textarea name="content" id="content" cols="30" rows="10" autofocus></textarea><br />
                <select name="test[]" multiple>
                    <optgroup label="one">
                        <option value="1" disabled>1</option>
                        <option value="2">2</option>
                    </optgroup>
                    <optgroup label="two">
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </optgroup>
                </select><br />
            </fieldset>
            
            <p>choose the color you like:</p>
            <input type="checkbox" name="red">red
            <input type="checkbox" name="green">green
            <input type="checkbox" name="blue">blue<br />
            <p>choose the fruit you like:</p>
            <input type="checkbox" name="fruits[]" value="apple">apple
            <input type="checkbox" name="fruits[]" value="banana">banana
            <input type="checkbox" name="fruits[]" value="orange">orange<br />
            <p>what's the answer of 2 + 3:</p>
            <input type="radio" name="answer" value="5">5
            <input type="radio" name="answer" value="6">6
            <input type="radio" name="answer" value="7">7
            <button>click me</button>
            <!--button-->
        </form>
    </body>

</html>