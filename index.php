<?php
    session_start();
    
    $noOfSubjectsErr = null;
    $subjects = null;
    $SPI = null;
    require "index-function.php";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Your SPI</title>
    <link rel="icon" href="image-map/icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="index.css">

</head>

<body>
    <header>
        NIRMA UNIVERSITY
    </header>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <?php                // If Calculate Button is clicked
                if(isset($_POST['calculateSPI'])){
                    echo createResultTable(); 
                }
        ?>
        <div class="text-center number">
            <label for="noOfSubjects">Select Number Of Subjects </label>
            <span class="error"><?php echo $noOfSubjectsErr; ?></span>
            <div class="dropdown">
                <select name="noOfSubjects" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false" id="noOfSub">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        <option value="1" class="dropdown-item" <?= $_SESSION['subjects'] == "1" ? "selected" : ""; ?>>1
                        </option>
                        <option value="2" class="dropdown-item" <?= $_SESSION['subjects'] == "2" ? "selected" : ""; ?>>2
                        </option>
                        <option value="3" class="dropdown-item" <?= $_SESSION['subjects'] == "3" ? "selected" : ""; ?>>3
                        </option>
                        <option value="4" class="dropdown-item" <?= $_SESSION['subjects'] == "4" ? "selected" : ""; ?>>4
                        </option>
                        <option value="5" class="dropdown-item" <?= $_SESSION['subjects'] == "5" ? "selected" : ""; ?>>5
                        </option>
                        <option value="6" class="dropdown-item" <?= $_SESSION['subjects'] == "6" ? "selected" : ""; ?>>6
                        </option>
                        <option value="7" class="dropdown-item" <?= $_SESSION['subjects'] == "7" ? "selected" : ""; ?>>7
                        </option>
                        <option value="8" class="dropdown-item" <?= $_SESSION['subjects'] == "8" ? "selected" : ""; ?>>8
                        </option>
                        <option value="9" class="dropdown-item" <?= $_SESSION['subjects'] == "9" ? "selected" : ""; ?>>9
                        </option>
                        <option value="10" class="dropdown-item"
                            <?= $_SESSION['subjects'] == "10" ? "selected" : ""; ?>>
                            10
                        </option>
                    </div>
                </select>
                <input type="submit" class="btn btn-success" name="Create" value="Calculate">
            </div>

        </div>
        <?php  if(isset($_POST['Create'])){echo $table;} ?>
    </form>
    <footer class="ft">
        <span>Created By : <a href="mailto:20bce503@nirmauni.ac.in">Jaimik Chauhan (20BCE503)</a></span>
        <a class="link" target="blank" href="https://www.linkedin.com/in/jaimikchauhan64/"><img
                src="image-map/linkedin.png" />
        </a>&nbsp; &nbsp;
        <a class="link" target="blank" href="https://github.com/jaimik64"><img
                src="image-map/GitHub-Mark-Light-32px.png" /></a>&nbsp;
        &nbsp;
        <a class="link" target="blank" href="https://twitter.com/Jaaimik"><img src="image-map/twitter.png" /></a>
    </footer>
</body>

</html>