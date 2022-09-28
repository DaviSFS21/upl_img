<?php

    if(isset($_FILES['img_prod'])){
        $img_prod = $_FILES['img_prod'];
        var_dump($img_prod);
        echo "<br><br>Arquivo enviado!";
        echo "<br><br>" . $img_prod['name'];
        echo "<br><br>" . $img_prod['size'];
        echo "<br><br>" . $img_prod['tmp_name'];

        $pasta = "assets/img_prod/";
        $novoNomeImg = uniqid();
        $extensaoImg = strtolower(pathinfo($img_prod['name'], PATHINFO_EXTENSION));

        if($img_prod['error']){

            ?>
            <script>
                alert("Falha ao enviar o arquivo...");
                javascript:history.back();
            </script>
            <?php
            die();
        }

/*         if($extensaoImg != 'jpg' && $extensaoImg != 'png'){
            ?>
            <script>
                alert("Extensão não permitida...(Somente .jpg ou .png)");
                javascript:history.back();
            </script>
            <?php
            die();
        } */

        if($img_prod['size'] > 4194304){
            ?>
            <script>
                alert("Arquivo maior que 4MB...");
                javascript:history.back();
            </script>
            <?php
            die();
        }

        echo "<br><br>" . $extensaoImg;

        $novoPath = $pasta . $novoNomeImg . "." . $extensaoImg;

        echo "<br><br>" . $novoPath;

        move_uploaded_file($img_prod['tmp_name'], $novoPath);

        echo "<br><br><img src='$novoPath'<br><br>";
    }

/*         if($img_prod['error']){
            die();
            ?>
            <script>
                alert("Falha ao enviar o arquivo...");
                javascript:history.back();
            </script>
            <?php
        }
        if($img_prod['size'] > 4194304){
            die();
            ?>
            <script>
                alert("Arquivo maior que 4MB...");
                javascript:history.back();
            </script>
            <?php
        }

        $pasta = "assets/img_prod/";
        $nomeImg = $img_prod['name'];
        $novoNomeImg = uniqid();
        $extensaoImg = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));


    }
    ?>
        <script>
            alert("Produto cadastrado!");
            window.location.replace("../php/lista_prod.php");
        </script>
    <?php */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de imagem com MySQL</title>
</head>
<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="file" name="img_prod"><br><br>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>