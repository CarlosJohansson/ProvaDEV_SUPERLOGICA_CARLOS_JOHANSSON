<!DOCTYPE html>
<html lang="pt-br">
<?php require 'application/views/Commons/header.php';?>
	<body>
	<?php //require 'application/views/Commons/navbar.php'; ?>
		<div class="container rounded mt-5 pt-2 pb-2" style="background-color: #f5f5f7;">
			<div class="card mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<b>Nome:</b>
							<p>Carlos Guilherme M. Johansson</p>
						</div>
						<div class="col">
							<b>Email:</b>
							<p>caguijohansson@gmail.com</p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<b>LinkedIn:</b>
							<p><a href="https://www.linkedin.com/in/carlos-guilherme-monteiro-johansson-236b9b197/">Link</a></p>
						</div>
						<div class="col">
							<b>Localização:</b>
							<p>Porto Alegre - RS</p>
						</div>
					</div>
				</div>
			</div>
			<form action="<?php echo site_url('Formulario/post_formulario/') ?>" id="formulario" method="post">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Formulário de Teste</h4>
					</div>
					<div class="card-body">
						<div class="row d-flex justify-content-center">
							<div class="col-8">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label" for="name">Nome completo:</label>
											<input class="form-control" type="text" id="name" name="name" minlength="1">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label" for="userName">Nome de login:</label>
											<input class="form-control" type="text" id="userName" name="userName">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label" for="zipCode">CEP:</label>
											<input class="form-control" type="text" id="zipCode" name="zipCode" onkeypress="$(this).mask('00000-000')">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label" for="email">E-mail:</label>
											<input class="form-control" type="email" id="email" name="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-10">
										<div class="form-group">
											<label class="control-label" for="password">Senha:</label>
											<small>(Ao menos 8 caractéres, contendo pelo menos 1 letra e 1 número)</small>
											<input class="form-control" type="password" id="password" name="password">
										</div>
									</div>
									<div class="col-lg-2 pt-4">
										<button type="button" class="btn btn-small" id="mostraSenha"><i class="fa fa-eye"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="row text-right">
								<div class="col-lg-12">
									<button type="submit" onclick="return $('#formulario').valid()" class="btn btn-black">Cadastrar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="card my-2">
				<div class="card-body">
					<h2>Usuários Inseridos</h2>
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th>Nome Completo</th>
	                            <th>Nome de Login</th>
	                            <th>CEP</th>
	                            <th>Email</th>
	                            <th>Senha</th>
	                        </tr>
	                    </thead>
	                    <tbody>
                            <?php foreach ($usuarios as $a => $usuario) : ?>
                                <tr>
                                    <td><?php echo $usuario->NOME_COMPLETO ?></td>
                                    <td><?php echo $usuario->USUARIO ?></td>
                                    <td><?php echo $usuario->CEP ?></td>
                                    <td><?php echo $usuario->EMAIL ?></td>
                                    <td><?php echo $usuario->SENHA ?></td>
                                </tr>
                            <?php endforeach; ?>
	                    </tbody>
	                </table>
				</div>
			</div>
		</div>
	<?php require 'application/views/Commons/scripts.php'; ?>
	</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){

		$('#mostraSenha').mousedown(function() {
			$('#password').attr("type", "text");
		});

		$('#mostraSenha').mouseup(function() {
			$('#password').attr("type", "password");
		});

		jQuery.validator.addMethod("senhaForte", function(value){
	        
	        let valido = false;
	        let regexLow = /^(?=(?:.*?[a-z]){1})(?=(?:.*?[0-9]){1})/;
	        let regexUpp = /^(?=(?:.*?[A-Z]){1})(?=(?:.*?[0-9]){1})/;

	        if(value.length >= 8){
		        if(regexLow.test(value) || regexUpp.test(value)){
		        	valido = true;
		        }
	        }

	        return valido;
    	}, "A senha deve conter ao menos 8 carácteres, contendo ao menos 1 letra e um número");

		jQuery.validator.addMethod("regexCEP", function(value){
	        
	        let valido = false;
	        let regex = /^[0-9]{5}-[0-9]{3}$/;

	        if(regex.test(value)){
	        	valido = true;
	        }

	        return valido;
    	}, "O CEP deve estar no formato xxxxx-xx");

    	jQuery.validator.addMethod("regexEmail", function(value){
	        
	        let valido = false;
	        let regex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]/i;

	        if(regex.test(value)){
	        	valido = true;
	        }

	        return valido;
    	}, "O email inserido é inválido");

		$("#formulario").validate({
			ignore: [],
	        highlight: function(element, errorClass){
	            if(element.tagName == 'SELECT'){
	                $(element).addClass('border-danger');
	            }else if(element.tagName == 'INPUT'){
	                $(element).addClass('invalid');
	            }
	        },
	        unhighlight: function(element, errorClass, validClass){
	            if(element.tagName == 'SELECT'){
	                $(element).removeClass('border-danger');
	            }else if(element.tagName == 'INPUT'){
	                $(element).removeClass('invalid');
	            }
	        },
	        errorPlacement: function(error, element){
	            if(element.prop("tagName") == 'INPUT'){
	                error.insertAfter(element);
	            }else{
	            	error.insertAfter(element);
	            }
	        },

	        errorClass: 'text-danger',

	        errorElement: 'span',

	        wrapper: 'small',

	        rules: {
	        	name: "required",
	        	userName: "required",
				zipCode: {
					regexCEP:true
				},
				email: {
					regexEmail:true
				},
				password: {
					senhaForte: true
				}
			},
			messages: {
				name: "Por favor, preencha o nome completo!",
				userName: "Por favor, preencha o nome de login!"
			}
		});
	});
</script>



<!-- 
// departamento: "required",
				// idDisciplina: {
				// 	idDisciplinaInserido: true
				// },
				// fieldDisciplina: "required",
				// nroAlunos: {
				// 	naoVazio: true
				// },
				// anoPlano: "required", teste: {
				// 	depends: function(element) {
				// 		if($("#start").val() == '' && $("#end").val() == ''){

				// 			return true;
				// 		}
			 //        }
			 //    },
				// curso: {
				// 	aoMenosUmCurso: true
				// },
				// end: {
				// 	dataFim: true
				// } -->