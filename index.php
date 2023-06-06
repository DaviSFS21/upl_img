<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de imagem com PHP</title>
</head>
<body>
    <!-- Formulário para envio das imagens -->
    <form enctype="multipart/form-data" action="" method="POST"><br><br>
        <input type="file" name="img_prod">
        <button type="submit">Enviar nova imagem</button><br><br>
    </form>
    <?php

    $arquivos = glob('assets/img_prod/*');

    if ($arquivos !== false) {
        // Percorre cada arquivo e o exclui
        foreach ($arquivos as $arquivo) {
            if (is_file($arquivo)) {
                unlink($arquivo);
            }
        }
    }
        /* Condição para só executar o código quando o formulário for enviado */
        if(isset($_FILES['img_prod'])){

            /* Declaração da variável da imagem e apresentação dos detalhes do arquivo */
            $img_prod = $_FILES['img_prod'];
            echo "Arquivo enviado!";
            echo "<br>Nome do arquivo: " . $img_prod['name'];
            echo "<br>Tamanho do arquivo: " . $img_prod['size'] . " Bytes";

            /* Declaração do novo caminho da imagem e criação do uniqid() para mudar o local da imagem, do local temporário ao source do servidor */
            $pasta = "assets/img_prod/";
            $novoNomeImg = uniqid();
            $extensaoImg = strtolower(pathinfo($img_prod['name'], PATHINFO_EXTENSION));
            echo "<br>Formato da imagem: " . $extensaoImg;

            /* Condições caso o upload sofra um erro, caso a extensão seja a errada, ou, caso a imagem seja muito pesada */
            if($img_prod['error']){

                ?>
                <script>
                    alert("Falha ao enviar o arquivo...");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            if($extensaoImg != 'jpg' && $extensaoImg != 'png'){
                ?>
                <script>
                    alert("Extensão não permitida...(Somente .jpg ou .png)");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            if($img_prod['size'] > 4194304){
                ?>
                <script>
                    alert("Arquivo maior que 4MB...");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            $novoPath = $pasta . $novoNomeImg . "." . $extensaoImg;

            echo "<br>Path do caminho do arquivo temporário no servidor: " . $img_prod['tmp_name'];
            echo "<br>Caminho definitivo no servidor: " . $novoPath;
    
            move_uploaded_file($img_prod['tmp_name'], $novoPath);

            echo "<br><br><img src='$novoPath' width='400em' height='30%'>";
        }
    ?>
</body>
</html>