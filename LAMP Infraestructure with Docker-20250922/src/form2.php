<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Novell Services Login</h2>

    <?php

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data); 
            $data = htmlspecialchars($data); 
        return $data;
    }   

        $usernameErr = $passwordErr = $cityErr = $roleErr = $serverErr = $servicesErr = "";
        $username = $password = $city = $role = $server = $mail = $selfservice = $payroll = "";
        $services = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (empty($_POST["username"])) {
                $usernameErr = 'El nombre de usuario es obligatorio';
            } else {
                $username = test_input($_POST["username"]);
            }

            if (empty($_POST["password"])) {
                $passwordErr = "La contraseña es obligatoria";
            } else {
                $password = test_input($_POST["password"]);
            }

            if (empty($_POST["role"])) {
                $roleErr = "Debes seleccionar un rol";
            } else {
                $role = test_input($_POST["role"]);
            }

            if (empty($_POST["city"])) {
                $cityErr = "Escriba una ciudad";
            } else {
                $city = test_input($_POST["city"]);
            }

            if(!empty($_POST["mail"])) {
                $mail = test_input($_POST["mail"]);
            }
                
            if (!empty($_POST["payroll"])) {
                 $payroll = test_input($_POST["payroll"]);
            }

            if (!empty($_POST["selfservice"])) {
                $selfservice = test_input($_POST["selfservice"]);
            }
              
            if (empty($mail) && empty($payroll) && empty($selfservice)) {
                $servicesErr = "Debe haber al menos un servicio selecionado";
            }
            
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <span style="color:red;">
            <?php echo $usernameErr ?>
        </span><br><br>

        <label for=" password">Password:</label><br>
        <input type="password" name="password" id="password" value="<?php echo $password ?>">
        <span style="color:red;">
            <?php echo $passwordErr ?>
        </span><br><br>

        <label for="city">City of employment:</label><br>
        <input type="text" name="city" id="city" value="<?php echo $city ?>">
        <span style="color:red;">
            <?php echo $cityErr ?>
        </span><br><br>

        <label for="server">Web Server:</label><br>
        <select name="server" id="server">
            <option value="apache" <?php if($server === 'apache') echo "selected" ?>>Apache</option>
            <option value="nginx" <?php if($server === 'nginx') echo "selected" ?>>Nginx</option>
            <option value="iis" <?php if($server === 'iis') echo "selected" ?>>IIS</option>
        </select>
        <span style="color:red;">
            <?php echo $serverErr ?>
        </span><br><br>

        <label for="role">Please specify your role:</label> <span style="color:red;">
            <?php echo $roleErr ?>
        </span><br><br>
        <input type="radio" name="role" value="admin" <?php if($role ==='admin') echo "checked"; ?>> Admin<br>
        <input type="radio" name="role" value="engineer" <?php if($role ==='engineer') echo "checked"; ?>>
        Engineer<br>
        <input type="radio" name="role" value="manager" <?php if($role ==='manager') echo "checked"; ?>> Manager<br>
        <input type="radio" name="role" value="guest" <?php if($role ==='guest') echo "checked"; ?>> Guest<br><br>


        <label for="services">Single Sign on to the following:</label> <span style="color:red;">
            <?php echo $servicesErr ?>
        </span><br><br>
        <input type="checkbox" name="mail" value="mail" <?php if ($mail === "mail") echo "checked"; ?>>Mail<br>
        <input type="checkbox" name="payroll" value="payroll"
            <?php if ($payroll === "payroll") echo "checked"; ?>>Payroll<br>
        <input type="checkbox" name="selfservice" value="selfservice"
            <?php if ($selfservice === "selfservice") echo "checked"; ?>>Self-service<br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>