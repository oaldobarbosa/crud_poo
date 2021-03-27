<?php

		require_once "../dao/alunoDAO.php";
		$aluno = new AlunoDAO();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Atualizar aluno </title>
	<script type="text/javascript" src="/crud/json/requisicao_aluno.js"></script>
</head>
<body>

	<?php 

	if (isset($_GET['atualizar'])) {

		$resultado = $aluno->SelectUnit($_GET['atualizar']);

	} 

	?>


	<?php

		$sql = "SELECT cd_aluno, nome, endereco FROM aluno ORDER BY cd_aluno";
        $stm = BD::getInstance()->prepare($sql);
        $stm->execute();
        $linhas = $stm->fetchAll(PDO::FETCH_ASSOC);

	?>
	<nav>
		<li> <a href="/crud/index.php" title="Início"> Início </a> </li>
		<li> <a href="/crud/formulario/form_inserir.php/#inserir" title="Inserir"> Inserir </a> </li>
		<li> <a href="/crud/formulario/form_listar.php/#aluno" title="Listar"> Listar </a> </li>
		<li> <a href="/crud/formulario/form_excluir.php/#excluir" title="Excluir"> Excluir </a> </li>
	</nav>
	<br>
	<fieldset>
		<legend> Atualizar aluno </legend>
			<form method="POST" id="atualizar" autocomplete="off" action="atualizar.php" title="Caixa de seleção para escolher o aluno a ser atualizado">
		        <p> ID aluno:
		            <select name="cd_aluno" onclick="buscaDados()" id="cd_aluno" required="">

		                <option value="<?php echo $_GET['atualizar'] ?>"> <?php echo $_GET['atualizar'] ?> </option>

		                <?php foreach($linhas as $key): ?>
		                    <option value="<?= $key['cd_aluno'] ?>" title="<?= $key['nome'] ?>"><?= $key['nome'] ?></option>
		                <?php endforeach ?>
		            </select>
		        
		        </p>
				<p> Nome: <input type="text" name="nome" id="nome" size=30 required="" value="<?php echo $resultado->nome ?>"" title="Campo para atualizar o nome do aluno"> </p>
				
				<p> Endereço: <input type="text" name="endereco" id="endereco" size=30 required=""  value="<?php echo $resultado->endereco ?>" title="Campo para atualizar o endereço do aluno"> </p>
				<button name="Atualizar"> Atualizar </button>
			</form>
	</fieldset>
</body>
</html>