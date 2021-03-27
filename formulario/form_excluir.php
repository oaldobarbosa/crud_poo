<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Excluir aluno </title>
</head>
<body>
	<?php
		require_once "../dao/alunoDAO.php";
		$aluno = new AlunoDAO();

		$sql = "SELECT cd_aluno, nome FROM aluno ORDER BY cd_aluno";
        $stm = BD::getInstance()->prepare($sql);
        $stm->execute();
        $linhas = $stm->fetchAll(PDO::FETCH_ASSOC);
	?>

	<?php 

	if (isset($_GET['excluir'])) {
		
		//verificar se foi enviado via GET, chama a função, e atribui os resultados a variável $resultado
		$resultado = $aluno->SelectUnit($_GET['excluir']);

	}

	?>

	<nav>
		<li> <a href="../index.php" title="Início"> Início </a> </li>
		<li> <a href="form_inserir.php/#inserir" title="Inserir"> Inserir </a> </li>
		<li> <a href="form_listar.php/#aluno" title="Listar"> Listar </a> </li>
		<li> <a href="form_atualizar.php/#atualizar" title="Atualizar"> Atualizar </a> </li>
	</nav>
	<br>
	<fieldset>
		<legend> Excluir aluno </legend>
			<form method="POST" id="excluir" autocomplete="off" action="../formulario/excluir.php" title="Caixa de seleção para escolher o aluno a ser excluído">
				<p> ID aluno:
					<select name="cd_aluno" required="">
						
						<!--mesmo esquema do artualizar
						<option value="<?php echo $_GET['excluir'] ?>"> <?php echo $_GET['excluir'] ?> </option>

			  			<?php foreach($linhas as $key): ?>
		    				<option value="<?= $key['cd_aluno'] ?>" title="<?= $key['nome'] ?>"><?= $key['nome'] ?></option>
						<?php endforeach ?>
					</select>
				</p>
				<button name="Excluir"> Excluir </button>
			</form>
	    </form>
	</fieldset>
	<table border="1">
        <tr> 
        	<th title="ID"> ID </th>
            <th title="Nome"> Nome </th>
            <th title="Endereço"> Endereço </th>
            <th title="Ações"> Ações </th>
        </tr>
        <?php 
            foreach ($aluno->Select() as $valor){
                echo '<tr>';
                echo '<td title="'.$valor['cd_aluno'].'">'.$valor['cd_aluno'].'</td>';
                echo '<td title="'.$valor['nome'].'">'.$valor['nome'].'</td>';
                echo '<td title="'.$valor['endereco'].'">'.$valor['endereco'].'</td>';

                echo '<td>'."<a href='/crud/formulario/form_atualizar.php/#atualizar' title='Atualizar'>Atualizar</a> ".'</td>';
                
                echo '</tr>'; echo '</p>';
            }
        ?>
    </table>
</body>
</html>
