	function curtir(cod, codigoUser){
		
		$.get("/curtir",{"codigo":cod, "codUser": codigoUser},function(retorno){
		
			var codigPublicacao=JSON.parse(retorno).codig;
			var qdt=JSON.parse(retorno).quantidadeDeCurtidas;

			//verifica se a classe do caracao está vazio , se nao chama a funcao descurtir 
			if($( 'i#s'+cod ).hasClass( "fa fa-heart-o" )){

				//remove o coração vazio e add o preenchido
				$('i#s'+cod).removeClass('fa fa-heart-o');
				$('i#s'+cod).addClass('fa fa-heart');

				//Remove o valor e coloca o novo
				$('i#valorLike'+cod).remove();
				$('i#s'+cod).html(' '+qdt);

			}else{
				descurtir(cod, codigoUser);
			}

		});
		
	}
	

	function descurtir(cod, codigoUser){

		$.get("/descurtir",{"codigo":cod, "codUser": codigoUser},function(retorno){
			
			var codigPublicacao=JSON.parse(retorno).codig;
			var qdt=JSON.parse(retorno).quantidadeDeCurtidas;

			if($( 'i#s'+cod ).hasClass( "fa fa-heart" )){
				//remove o coração preenchido e add o vazio
				$('i#s'+cod).removeClass('fa fa-heart');
				$('i#s'+cod).addClass('fa fa-heart-o');

				//Remove o valor e coloca o novo 
				$('i#valorLike'+cod).remove();
				$('i#s'+cod).html(' '+qdt);
				
			}else{
				
				curtir(cod, codigoUser);
				//alert("erro na conexão");
			}

		});
	}