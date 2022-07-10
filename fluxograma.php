<?php
$server = "DESKTOP-2CM82J2\SQLEXPRESS";
$user = "sa";
$pw ="3841";
$database ="Fluxograma";
$connect = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;",$user,$pw);
?>


<?php

if(isset($_POST["enviar"])){
////////////////////////////////////////////////////////////////////////ENVIAR
    $nome = $_POST["nome"];
    $data =  $_POST["data"];
    $metodo =  $_POST["metodo"];
    $mdeobra = $_POST["mdeobra"];
    $medida =  $_POST["medida"];
    $tipicoocorrencia = $_POST["tipicoocorrencia"];
    $material =  $_POST["material"];
    $meioambiente =  $_POST["meioambiente"];
    $maquina =  $_POST["maquina"];
    $causaraiz = $_POST["causaraiz"];
    

    
if((empty($_POST["metodo"])) or (empty($_POST["mdeobra"])) or (empty($_POST["medida"])) or (empty($_POST["tipicoocorrencia"])) or (empty($_POST["material"])) or (empty($_POST["meioambiente"])) or (empty($_POST["maquina"])) or (empty($_POST["causaraiz"])) or (empty($_POST["nome"])) or (empty($_POST["data"]))){
    echo "<p id='error'>Preencha todos os Itens!</p>";
}
else{
    $cadastrar = "INSERT INTO fluxograma ";
    $cadastrar .="(metodo,mdeobra,medida,tipicoocorrencia,material,meioambiente,maquina,causaraiz,nome,data) ";
    $cadastrar .="VALUES ";
    $cadastrar.="('$metodo','$mdeobra','$medida','$tipicoocorrencia','$material','$meioambiente','$maquina','$causaraiz','$nome','$data')";
    if($sqlfluxograma = odbc_exec($connect,$cadastrar)){
        header("location:fluxograma.php");
    }
}
}
?>






<?php
////////////////////////////////////////////////////////////////////EXCLUIR
if(isset($_POST["Excluir"])){

$id = $_POST["id"];
$delfluxo = "DELETE FROM fluxograma WHERE id = '$id' ";
if($delfluxoquery = odbc_exec($connect,$delfluxo)){
    header("location:fluxograma.php");
}
}
?>



<!doctype html>
<html lang="pt-br">
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <meta charset="utf-8">
      
        <title>JSL:Fluxograma</title>

        <style>
            *{
                font-family:arial,sans-serif;
                margin:0;
                text-decoration:none;
                list-style:none;
            }
            #closeformmetodo,#closeformmdeobra,#closeformmedida,#closeformmaterial,#closeformmeioambiente,#closeformmaquina,#closeformtipicoocorrencia,#closeformcausaraiz{
                position:absolute;
                margin-right:249px;
                margin-top:1px;
                cursor:pointer;
            }
            #sendmetodo,#sendmdeobra,#sendmedida,#sendtipicoocorrencia,#sendmaterial,#sendmeioambiente,#sendmaquina,#sendcausaraiz{
                position:absolute;
                margin-right:209px;
                margin-top:1px;
                cursor:pointer;
                
            }
            #sendmetodo:hover,#sendmdeobra:hover,#sendmedida:hover,#sendmaquina:hover,#sendmeioambiente:hover,#sendmaterial:hover,#sendtipicoocorrencia:hover,#sendcausaraiz:hover{
                color:green;
            }
            #materialform,#meioambienteform,#maquinaform{
            transform:translateY(-55%);
            }
            #closeformmetodo:hover,#closeformmaterial:hover,#closeformtipicoocorrencia:hover,#closeformmdeobra:hover,#closeformmedida:hover,#closeformmaquina:hover,#closeformmeioambiente:hover,#closeformaterial:hover{
                color:red;
                
            }
            #adcmetodo,#adcmdeobra,#adcmedida,#adcmaterial,#adcmeioambiente,#adcmaquina{
                font-size:2.0em;
                margin-top:40px;
                cursor:pointer;
            
            }
            #adctipicoocorrencia{
                
                font-size:2.0em;
                cursor:pointer;
             margin-top:30px;
            }
            #adccausaraiz{
            margin-top:40px;
            font-size:2.0em;
            }
            #tipicoocorrencia{
                margin-top:-35px;
            }
            #causaraiz{
                
            }
            #metodoform,#mdeobraform,#medidaform,#tipicoocorrenciaform,#causaraizform{
                position:absolute;
                margin-top:24px;
            }
        .itens,.itens2{
            display:flex; 
            width:100%;
            flex-wrap:wrap;
            float:left;
        }
        .itens2{
            margin-top:-35px;
        }
    .metodo h3,.mdeobra h3,.medida h3,.meioambiente h3,.maquina h3{
        margin:0;
    }
        .metodo,.mdeobra,.medida,.material,.meioambiente,.maquina{
            border:solid; 
            width:21%; 
            margin:1%;
             height:150PX;
              display:flex; 
              flex-direction:column; 
              align-items:center;
              
            }
            .tipicoocorrencia,.colisão,.causaraiz{
                border:solid; 
            width:21%; 
            margin:1%;
            display:flex;
            flex-direction:column;
            align-items:center;
            height:90px;
            }
            .causaraiz{margin-top:10px;}
        #metodo,#mdeobra,#medida{ 
            display:flex;
             flex-wrap:wrap;
              margin:0;
              justify-content:center;
              
            }
        #material,#meioambiente,#maquina,#causaraiz{ 
            display:flex; 
            flex-wrap:wrap;
             margin:0;
             justify-content:center;
            }
        #metodotitle{
            background-color:#00BFFF; 
            width:100%; 
            display:flex; 
            justify-content:center;
             margin-top:0;
            }
            textarea{
                overflow-y:block;
                resize:none;
            }
        #mdeobratitle{
            background-color:orange; 
            width:100%; 
            display:flex; 
            justify-content:center; 
            margin-top:0;
        }
        #causaraiztitle{
            background-color:black;
            color:white;
             width:100%;
              display:flex; 
              justify-content:center; 
              margin-top:0;
        }
        #medidatitle{
            background-color:#f76b8a;
             width:100%;
              display:flex; 
              justify-content:center; 
              margin-top:0;
            }
            #tipicoocorrenciatitle{
                background-color:black;
                color:white;
             width:100%;
              display:flex; 
              justify-content:center; 
              margin-top:0;
            }
        #titlemaquina{
            width:21%;
            background-color:red; 
            display:flex;
            justify-content:center; 
            margin-top:128px;
            position:absolute;
        }
        #titlemeioambiente{
            width:21%;
            background-color:green; 
            display:flex;
            justify-content:center; 
            margin-top:128px;
            position:absolute;
        }
        #titlematerial{
            width:21%;
            background-color:yellow; 
            display:flex;
            justify-content:center; 
            margin-top:128px;
            position:absolute;
            }
         textarea{
             width:98%;
         }
            .colisão{
                display:flex;
                margin-left: 86px;
                margin-top:-12px;
                align-items:center;
            }
            .colisão p{
                margin-top:13%;
            }
           #causaraiz{
          
             width:100%;
              display:flex; 
              justify-content:center; 
              margin-top:-20px;
           }
.causaraiz{
    margin-top:73px;
}
.center{
    float:left;
    flex-direction:row;
    width:65.5%;

}
.center hr{
    width:95%;
    border:solid;
    color:black;
    background-color:black;
    margin-top:28px;
}
#setadireita{
    font-size:1.5em;
    float:right;
    transform:translateY(-58%);
}
#setapracima{
  margin-top:-2.3%;
  position:absolute;
}
#setaprabaixo{
    margin-top:11%;
    position:absolute;
}
.tipicoocorrencia{
    margin-top:17px;
}
.edititems,.edititems2,.edititems3,.edititems4,.edititems5,.edititems6{
    display:flex;
    position:absolute;
    margin-top:4%;
    font-size:2.2em;
}
.edititems7,.edititems8{
    display:flex;
    position:absolute;
    font-size:1.5em;
    margin-top:3.5%;
}
.edititems i,.edititems2 i,.edititems3 i,.edititems4 i,.edititems5 i,.edititems6 i,.edititems7 i,.edititems8 i{
    margin:6%;
    cursor:pointer;
}
.envio{
    width:10%; 
    padding:0.3%;
    background-color:green;
    border:none;
    border-radius:10px;
    color:white;
    font-family:arial,sans-serif;
    cursor:pointer;
    margin:1%;
    float:right;
    margin-right:11%;
}
.envio:hover{
    opacity:0.5;
}

.dadosfluxo{
    display:flex;
    flex-direction:row;
    float:left;
    margin:1%;
    width:30%;
}
.dadosfluxo input{
    margin-left:1%;
}

.dadosfluxo h3 {
    margin:1%;
}

.dadosfluxo p {
    margin:1%;
}
#formexcluir{
    display:none;
}
.editbuttons{
    float:right;
margin-right:4%;
    padding:1%;
    font-family:arial,sans-serif;
    width:22%;
}
.editbuttons a{
    color:white;
    background-color:green;
    padding:2%;
    border-radius:10px;
    padding-left:10%;
    padding-right:10%;
}
#buttonexcluir{
    cursor:pointer;
    color:white;
    background-color:red;
    padding:2%;
    border-radius:10px;
    padding-left:10%;
    padding-right:10%;
}
.editbuttons a:hover{
    opacity:0.5;
}
#buttonexcluir:hover{
    opacity:0.5;
}
#datafluxo{
    margin-top:1.6%;
}
#error{
    margin-top:1.5%;
    margin-left:1.7%;
    color:red;
}

        </style>
</head>
<body>
<!-----------------------------------------------------------------------------------------------------------------------------FORM------------------->


<?php
////////////////////////////////////////////////////CONFERIR NO BD
$sqlselect = "SELECT * FROM fluxograma";
$sqlquery = odbc_exec($connect,$sqlselect);
$sqlassoc = odbc_fetch_row($sqlquery);
if($sqlassoc == true){
    echo"
    <script>
$(function(e){
$('.mainpage').hide();
});
</script>
    ";
}
else{
    echo"
    <script>
$(function(e){
$('.mainpage').show();
});
</script>
    ";
}


?>




<br>
<div class="mainpage">
<form action="" method="POST">
    <script>
$(function(e){
$("textarea").maxLenght({
    maxChars:30
});
});
        </script>
    <div class="dadosfluxo">
<input type="name" name="nome" id="nome" placeholder="Nome do Fluxograma" >
<input type="date" name="data" id="data" placeholder="data do ocorrido">
</div>
<button type="submit" name="enviar" class="envio">Criar</button>

<div class="itens">
                    

<!------------------------------------------------------------------------METODO-------------------------------------->
    <div class="metodo">
        <h3 id="metodotitle">METODO </h3>
        <textarea name="metodo" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------MÃO DE OBRA-------------------------------------->

<div class="mdeobra">
        <h3 id="mdeobratitle">MÃO DE OBRA</h3>
        <textarea name="mdeobra" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------MEDIDA-------------------------------------->
<div class="medida">
        <h3 id="medidatitle">MEDIDA</h3>
        <textarea name="medida" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------TIPICO OCORRENCIA-------------------------------------->
<div class="tipicoocorrencia">
        <h3 id="tipicoocorrenciatitle">Tipico Ocorrencia</h3>
        <textarea name="tipicoocorrencia" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="80"></textarea>

</div>
<!----------------------------------------------------------------------------CENTER---------------->
<div class="center">
<hr width="100%">
<i class="fas fa-arrow-right" id="setadireita"></i>

        </div>
      <!------------------------------------------------------------------------COLISÃO-------------------------------------->  
        <div class="colisão">
        <p>Colisão</p>
</div>
</div>

<!-----------------------------------ITEM2----------------------->
<div class="itens2">
<!------------------------------------------------------------------------MATERIAL-------------------------------------->
<div class="material">
<i class="fas fa-arrow-up" id="setapracima"></i>
<textarea name="material" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>
<h3 id="titlematerial">MATERIAL</h3>
</div>
<!------------------------------------------------------------------------MEIO AMBIENTE-------------------------------------->
<div class="meioambiente">
<i class="fas fa-arrow-up" id="setapracima"></i>

<textarea name="meioambiente" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>

<h3 id="titlemeioambiente">MEIO AMBIENTE</h3>
</div>
<!------------------------------------------------------------------------MAQUINA-------------------------------------->
<div class="maquina">
<i class="fas fa-arrow-up" id="setapracima"></i>
<textarea name="maquina" cols="35" rows="8" placeholder="Digite Aqui..." maxlength="150"></textarea>
<h3 id="titlemaquina">MAQUINA</h3>
</div>
<!------------------------------------------------------------------------CAUSA-------------------------------------->
<div class="causaraiz">
        <h3 id="causaraiztitle">Causa Raiz</h3>
<textarea name="causaraiz" cols="35" rows="5" placeholder="Digite Aqui..." maxlength="80"></textarea>
</div>
</div>

<!---------------------------------------------------------//FORM----->

</form>  
</div>




<!-------------------------------------------------------------------------------FLUXOGRAMAS------------->


<?php
$fluxo = "SELECT * FROM fluxograma";
$queryfluxo = odbc_exec($connect,$fluxo);
while(odbc_fetch_row($queryfluxo)){
?>



<div class="dadosfluxo">
<h3><?php echo wordwrap(odbc_result($queryfluxo,'nome'),25,"\n",TRUE);?></h3>
<p id="datafluxo"><?php echo wordwrap(odbc_result($queryfluxo,'data'),25,"\n",TRUE);?></p>
</div>
<div class="editbuttons">
<a href="editarfluxo.php?id=<?php echo wordwrap(odbc_result($queryfluxo,'id'),25,"\n",TRUE);?>">Editar</a>
<label for="Excluir" id="buttonexcluir">Excluir</label>
</div>


<div class="itens">
                    

<!------------------------------------------------------------------------METODO-------------------------------------->
    <div class="metodo">
        <h3 id="metodotitle">METODO </h3>
 <p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'metodo'),25,"\n",TRUE);?></p>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------MÃO DE OBRA-------------------------------------->

<div class="mdeobra">
        <h3 id="mdeobratitle">MÃO DE OBRA</h3>
        <p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'mdeobra'),25,"\n",TRUE);?></p>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------MEDIDA-------------------------------------->
<div class="medida">
        <h3 id="medidatitle">MEDIDA</h3>
        <p align="center"  ><?php echo wordwrap(odbc_result($queryfluxo,'medida'),25,"\n",TRUE);?></p>
<i class="fas fa-arrow-down" id="setaprabaixo"></i>
</div>
<!------------------------------------------------------------------------TIPICO OCORRENCIA-------------------------------------->
<div class="tipicoocorrencia">
        <h3 id="tipicoocorrenciatitle">Tipico Ocorrencia</h3>
        <p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'tipicoocorrencia'),25,"\n",TRUE);?></p>

</div>
<!----------------------------------------------------------------------------CENTER---------------->
<div class="center">
<hr width="100%">
<i class="fas fa-arrow-right" id="setadireita"></i>

        </div>
      <!------------------------------------------------------------------------COLISÃO-------------------------------------->  
        <div class="colisão">
        <p>Colisão</p>
</div>
</div>

<!-----------------------------------ITEM2----------------------->
<div class="itens2">
<!------------------------------------------------------------------------MATERIAL-------------------------------------->
<div class="material">
<i class="fas fa-arrow-up" id="setapracima"></i>
<p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'material'),25,"\n",TRUE);?></p>
<h3 id="titlematerial">MATERIAL</h3>
</div>
<!------------------------------------------------------------------------MEIO AMBIENTE-------------------------------------->
<div class="meioambiente">
<i class="fas fa-arrow-up" id="setapracima"></i>
<p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'meioambiente'),25,"\n",TRUE);?></p>
<h3 id="titlemeioambiente">MEIO AMBIENTE</h3>
</div>
<!------------------------------------------------------------------------MAQUINA-------------------------------------->
<div class="maquina">
<i class="fas fa-arrow-up" id="setapracima"></i>
<p align="center" ><?php echo wordwrap(odbc_result($queryfluxo,'maquina'),25,"\n",TRUE);?></p>
<h3 id="titlemaquina">MAQUINA</h3>
</div>
<!------------------------------------------------------------------------CAUSA-------------------------------------->
<div class="causaraiz">
        <h3 id="causaraiztitle">Causa Raiz</h3>
        <p align="center"><?php echo wordwrap(odbc_result($queryfluxo,'causaraiz'),25,"\n",TRUE);?></p>
</div>


<form action="" method="POST" id="formexcluir">
    <input type="hidden" name="id" value="<?php echo wordwrap(odbc_result($queryfluxo,'id'),25,"\n",TRUE);?>">
    <input type="submit" id="Excluir" name="Excluir" value="Excluir">
</form>
</div>




<?php
}
?>

        </body>
        
        </html>
        