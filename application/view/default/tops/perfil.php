	<script type="text/javascript">
		$(document).ready(function($){
	
			$("select#select-action").change(function(){
				window.location="perfil/" + $(this).val();
			});
		});
	</script>
	<div id="icon-index" class="icon32 icon-perfil-modulo"></div>
	<h2>
		Perfis
		<span class="select-function">
			<select id="select-action">
				<option <?php if(getAcaoAtual() == 'index'){ ?> selected="selected" <?php } ?> value="">listar</option>
				<?php 
					if(Acao::checarPermissao(2, PerfilControll::MODULO)){
				?>
				<option <?php if(getAcaoAtual() == 'add'){ ?> selected="selected" <?php } ?> value="add">cadastrar</option>
				<?php 
					}
					if(getAcaoAtual() == 'ver'){
				?>
				<option selected="selected" value="ver">ver</option>
				<?php 
					}
					if(getAcaoAtual() == 'editar'){
				?>
				<option selected="selected" value="editar">editar</option>
				<?php 
					}
				?>
			</select>
			<br/>
		</span>
	</h2>