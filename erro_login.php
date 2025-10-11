<?php
if (isset($_GET['e']) && $_GET['e'] != NULL) {
    $erro = $_GET['e'];
    echo "<span id='erro'>";

    if ($erro == 1) {
        echo "*Você precisa preencher todos os campos";
    } 
    else if ($erro == 2) {
        echo "*Nickname só pode ter até 22 caracteres";
    } 
    else if ($erro == 3) {
        echo "*Senha maior que 30 caracteres";
    } 
    else if ($erro == 4) {
        echo "*Email muito grande";
    } 
    else if ($erro == 5) {
        echo "*Email inválido";
    }
    else if ($erro == 6){ 
        echo "*Data inválida";
    }
    else if ($erro == 7) {
        echo "*Data de nascimento não pode ser no futuro";
    }
    else if ($erro == 8) {
        echo "*Data muito antiga";
    }
    else if ($erro == 9){
        echo "*Já existe um usuário com esse nome";
    }
    else if ($erro == 10){
        echo "*Usuário inexistente";
    }
    else if ($erro == 11){
        echo "*Senha Incorreta";
    }
    else if ($erro == 12){
        echo "*Nickname já está sendo utilizado";
    }
    else if ($erro == 13){
        echo "*Email já vinculado a uma conta";
    }
    else if ($erro == 14){
        echo "*Nome não pode ser maior que 70 caracteres abrevie algum sobrenome";
    }


    echo "</span>";
    echo '<style>
            #div_butao {
                margin-top: 2%;
            }
        </style>';
}
?>
