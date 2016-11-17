	function comentar(cod, codigoUser){
	
		//alert("entrou"+cod+codigoUser);

		$.get("/mostarComentarios",{"codigo":cod, "codUser": codigoUser},function(retorno){
			var valores=JSON.parse(retorno);
		 	var comentou=' ';
			
			for (value in valores) {
				
				comentou +=  '<div class="" style=""> <img src="http://localhost:8989/assets/rede/img/user/'+valores[value].foto +
				'" alt="" width="50" height="50" style="border-radius: 30px;  float:left; margin:0 10px 10px 0;"> ';
				comentou += '<p style="text-decoration: none;color: #F1BB04;">' + valores[value].nome  +"</p><br>";
				comentou += '<p style="font-size:13px;">' + valores[value].texto + "</div><br>";

				//console.log(valores);
			}


			$('div#comentario'+cod).toggle();
			$('div#coment'+cod).html(comentou);
		});
	
	}

	function salvarComentario(cod, codigoUser){
		var comentariotext = $("#comentariotext"+cod).val();

		$.get("/comentarios",{"codigo":cod, "codUser": codigoUser, "texto": comentariotext},function(retorno){
			var qdt=JSON.parse(retorno).quantidadeDeComentarios			
			
			//Remover e colocar a nova quantidade de comentarios
			$('i#valorcomentarios'+cod).remove();
			$('i#c'+cod).html(' '+qdt);
			$("i#c"+cod).trigger('click');
			
			// Limpando todos os campos
	        $("#comentariotext"+cod).val("");
	     
			//forçando click	       
	        $("i#c"+cod).trigger('click');
		});
	}