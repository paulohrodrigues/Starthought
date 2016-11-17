	function favoritar(cod, codigoUser){
		
		$.get("/favoritar",{"codigo":cod, "codUser": codigoUser},function(retorno){
		
			var codigPublicacao=JSON.parse(retorno).codig;

			if($( 'i#favorito'+cod ).hasClass( "fa fa-star-o" )){

				$('i#favorito'+cod).removeClass('fa fa-star-o');
				$('i#favorito'+cod).addClass('fa fa-star');

			}else{
				desfavoritar(cod, codigoUser);
			}

		});
		
	}
	

	function desfavoritar(cod, codigoUser){

		$.get("/desfavoritar",{"codigo":cod, "codUser": codigoUser},function(retorno){
			
			var codigPublicacao=JSON.parse(retorno).codig;

			if($( 'i#favorito'+cod ).hasClass( "fa fa-star" )){
				
				$('i#favorito'+cod).removeClass('fa fa-star');
				$('i#favorito'+cod).addClass('fa fa-star-o');

			}else{
				
				favoritar(cod, codigoUser);
				//alert("erro na conexão");
			}

		});
	}

	function mostrarFavorito(cod, codigoUser){
		alert("erro na con");
		// $.get("/favoritos",{"codigo":cod, "codUser": codigoUser},function(retorno){

		// });
	}