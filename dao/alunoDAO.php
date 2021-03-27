<?php
  
  	require_once '../conexao/conexao.php';
	require_once '../classes/aluno.php';

	class AlunoDAO extends Aluno {

		protected $tabela = 'aluno'; 
		
		public function Insert() {
			try {
				$sql = "INSERT INTO $this->tabela (nome, endereco) VALUES (:nome, :endereco)";
				$stm = BD::getInstance()->prepare($sql);
				$stm->bindValue(':nome', $this->getNome());
				$stm->bindValue(':endereco', $this->getEndereco());
				return $stm->execute();
			} catch (PDOException $e) {
				echo "Erro PDO: Houve um erro na inserção.<br>".$e->getMessage();
				die();
			} catch (Exception $e) {
				echo "Erro: Operação de inserção inválida.<br>".$e->getMessage();
				die();
			} 
		}

		public function Select() {
			try {
				$sql = "SELECT * FROM $this->tabela";
				$stm = BD::getInstance()->prepare($sql);
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				echo "Erro PDO: Houve um erro na listagem.<br>".$e->getMessage();
				die();
			} catch (Exception $e) {
				echo "Erro: Operação de listagem inválida.<br>".$e->getMessage();
				die();
			} 
		}
		
		//funcão para buscar somente 1 aluno
		public function SelectUnit($cd_aluno) {

			$sql = "SELECT * FROM $this->tabela WHERE cd_aluno = :cd_aluno";
			$stm = BD::getInstance()->prepare($sql);

			$stm->bindParam(':cd_aluno', $cd_aluno, PDO::PARAM_INT);

			$stm->execute();

			return $stm->fetch();
			}


		public function Update() {
			try {
				$sql = "UPDATE $this->tabela SET nome = :nome, endereco = :endereco WHERE cd_aluno = :cd_aluno";
				$stm = BD::getInstance()->prepare($sql);
				$stm->bindValue(':cd_aluno', $this->getAluno(), PDO::PARAM_INT);
				$stm->bindValue(':nome', $this->getNome());
				$stm->bindValue(':endereco', $this->getEndereco());
				return $stm->execute();	
			} catch (PDOException $e) {
				echo "Erro PDO: Houve um erro na atualização.<br>".$e->getMessage();
				die();
			} catch (Exception $e) {
				echo "Erro: Operação de atualização inválida.<br>".$e->getMessage();
				die();
			} 
		}
	
		public function Delete() {
			try {
				$sql = "DELETE FROM $this->tabela WHERE cd_aluno = :cd_aluno";
				$stm = BD::getInstance()->prepare($sql);
				$stm->bindValue(':cd_aluno', $this->getAluno(), PDO::PARAM_INT);
				return $stm->execute();
			} catch (PDOException $e) {
				echo "Erro PDO: Houve um erro na exclusão.<br>".$e->getMessage();
				die();
			} catch (Exception $e) {
				echo "Erro: Operação de exclusão inválida.<br>".$e->getMessage();
				die();
			} 
		}
	}
?>
