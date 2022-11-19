// JavaScript Document
var inicio;
inicio = $(document);
inicio.ready(funciones);
	//FUNCION DE PRECIOS
	var restPrice;
	function TipoPlan(){
		var q = $(".Coti-Planes.ResultAct h2").text();
		var day = parseInt($(".day").text());		
		if(q != ""){
			$(".TipoPl").text("TIPO DE PLAN: "+q);
			$.ajax({
				async:true,
				type:"POST",
				dataType:"html",
				contentType:"application/x-www-form-urlencoded",
				url:"/file_all/bin/precioscot.php",
				data:"TipoP="+q+"&day="+day,				
				success:function(data){
					restPrice = data;
					$(".Precio").html(data);					
				},
				timeout:5000
			});
		}
	}	
	function funciones(){
		var t,t2,dayAct;
		var ini,ini2,mes,mes2;
		var contador = 1;
		var imgSlider = $(".Slider-img ul li").size();
		var dt = new Date();		
		if(dt.getDate() > 0 || dt.getDate() < 10){ini="0";}else{ini=""}if((dt.getDate()+4) > 9){ini2=""}else{ini2="0"}
		if(dt.getDate() > 0 || dt.getMonth() < 10){mes="0"}else{mes=""}if((dt.getMonth()+4) > 9){mes2=""}else{mes2="0"}
		$("#txtbuscar").val("Ingrese su ticket");
		$("#TxtS").val("E-mail para suscripción");
		$("#Salida").val(dt.getFullYear()+"-"+mes+(dt.getMonth()+1)+"-"+ini+dt.getDate());
		$("#Retorno").val(dt.getFullYear()+"-"+mes2+(dt.getMonth()+1)+"-"+ini2+(dt.getDate()+4));		
		//Seleccionar Plan
		$(".Coti-Planes").click(function(){
			$(".Coti-Planes").removeClass('ResultAct');
			$(this).addClass('Coti-Planes ResultAct');
			var q = $(".Coti-Planes.ResultAct h2").text();
			var day = parseInt($(".day").text());
			$(".TipoPl").text("TIPO DE PLAN: "+q);
			$.ajax({async:true,type:"POST",dataType:"html",contentType:"application/x-www-form-urlencoded",url:"/file_all/bin/precioscot.php",data:"TipoP="+q+"&day="+day,success:function(data){restPrice=data;$(".Precio").html(data);},timeout:5000});			
		});
		//UPGRADE Plan			
		$(".idUpgrade").click(function(){
			var x=0;var tipoau=[];
			$(".idUpgrade").each(function(index, element) {
                if($(this).prop('checked') == true){
					tipoau[x++] = $(this).val();
				}
            });
			if(tipoau.length > 0) {
				var parm = 
				{
					"activos" : tipoau,
					"TypeUpgrade" : tipoau
				}
				$.ajax({
					async:true,
					type:"POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"/file_all/bin/precioscot.php",
					data:parm,
					success:function(data){
						$(".Precio").html(data);
					},
					timeout:5000
				});
			}else{
				TipoPlan();
			}
			
		})
		$('.avisovn a').click(function(e){
			$('.avisopopup').fadeOut('slow');
		})
		$('.imageview').click(function(e){
			$('.copycontview').html('<p class="mensagee"><img src="' + $(this).attr('src') + '" alt="" width="700" height="450"></p>');
			$('.imaview').css('display','block');
			$('.contview').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);	
		})
		$('.cerraimview').click(function(e){
			$('.copycontview').html("");
			$('.imaview').css('display','none');	
		})
		
		$('.btnEnvCot').click(function(e){
			var x=0;var upgra=[];
			$(".idUpgrade").each(function(index, element) {
                if($(this).prop('checked') == true){
					upgra[x++] = $(this).val();
				}
            });
			var xx=0;var edades=[];
			$(".lineaE input").each(function(index, element) {
                edades[xx++] = $(this).val();
            });
			var plan = $('.TipoPl').text().split(":");
			var prec = $('.Precio').text()	
			var parm = 
				{
					"upgr" : upgra,
					"edades" : edades,
					"pre" : prec,
					"plan" : $.trim(plan[1]),
					"ori" : $('.linea1 p:nth-child(1) b').text(),
					"des" : $('.linea1 p:nth-child(2) b').text(),
					"sal" : $('.linea1 p:nth-child(3) b').text(),
					"ret" : $('.linea1 p:nth-child(4) b').text(),
					"day" : $('.linea1 p:nth-child(5) b').text(),
					"email" : $('.emailse').val(),
					"in" : "rx"
				}
			$.ajax({
					async:true,
					type:"POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"/file_all/bin/cotz.php",
					data:parm,
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se está envíando su cotización.<br><img src="/file_all/imagenes/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						$('.pop_men p').html(datos);
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					timeout:5000
				});
							
		})
		//Slider
		ini_slide();
		
		function ini_slide(){
			slider = $(".Slider-img ul li:nth-child(" + contador + ")");			
			$(".Slider-img ul li:nth-child(" + contador + ")").css("display","block");
			slidertxt = $(".Slider-text ul li:nth-child(" + contador + ")");
			$(".Slider-text ul li:nth-child(" + contador + ")").css("display","block");			
			t = setTimeout(act_slider,6000);
			t2 = setTimeout(act_slidertxt,6000);
		};
		
		function act_slider(){			
			clearTimeout(t);
			sgte = (slider.next(".Slider-img ul li").length > 0)? slider.next():$(".Slider-img ul li:first");			
			slider.fadeOut("slow");
			sgte.fadeIn("slow");			
			slider = sgte;			
			$(".btnPosition ul li:nth-child(" + contador + ")").removeClass("btnhover");
			if(contador == imgSlider){
				contador = 1;
			}else{
				contador = contador + 1;
			}
			$(".btnPosition ul li:nth-child(" + contador + ")").addClass("btnhover");			
			t =  setTimeout(act_slider,6000);						
		};
				
		function act_slidertxt(){
			clearTimeout(t2);
			otro = (slidertxt.next(".Slider-text ul li").length > 0)? slidertxt.next():$(".Slider-text ul li:first");
			slidertxt.animate({opacity:'hide'});
			otro.animate({opacity:'show'},1500);
			slidertxt = otro;
			t2 =  setTimeout(act_slidertxt,6000);						
		};
		
		//Viajeros
		$("#Nviajero").change(
			function(){
				var str = ""
				$("#Nviajero option:selected").each(function(){
                    str += $(this).text();
                });
				
				if(str == "1"){
					$("#Pasajero1").prop('disabled', false);	
					$("#Pasajero2").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");
					$("#Pasajero3").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");
					$("#Pasajero4").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");
					$("#Pasajero5").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");
				}else if(str == "2"){
					$("#Pasajero1").prop('disabled', false);	
					$("#Pasajero2").prop('disabled', false);
					$("#Pasajero3").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
					$("#Pasajero4").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
					$("#Pasajero5").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
				}else if(str == "3"){
					$("#Pasajero1").prop('disabled', false);	
					$("#Pasajero2").prop('disabled', false);
					$("#Pasajero3").prop('disabled', false);
					$("#Pasajero4").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
					$("#Pasajero5").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
				}else if(str == "4"){
					$("#Pasajero1").prop('disabled', false);	
					$("#Pasajero2").prop('disabled', false);
					$("#Pasajero3").prop('disabled', false);
					$("#Pasajero4").prop('disabled', false);
					$("#Pasajero5").prop('disabled', true).val("").removeClass("EdadesErr").addClass("Edades");;
				}else if(str == "5"){
					$("#Pasajero1").prop('disabled', false);	
					$("#Pasajero2").prop('disabled', false);
					$("#Pasajero3").prop('disabled', false);
					$("#Pasajero4").prop('disabled', false);
					$("#Pasajero5").prop('disabled', false);
				}
				
			}
		);
		
		$(".btnPosition ul li").click(function(){
			contador = $(this).index()+1;
			clearTimeout(t);
			clearTimeout(t2);			
			$(".Slider-text ul li").css("display","none");
			$(".Slider-img ul li").css("display","none");			
			$(".btnPosition ul li").removeClass("btnhover");
			$(this).addClass("btnhover");			
			ini_slide();
		});
		
		//Efectos Planes
		$(".PriceTable ul li").hover(function(){
				var a = $(this).index() + 1;
				$(".PriceTable ul li").removeClass("selact");
				$(".PriceTable ul li:nth-child("+a+")").addClass("selact");				
			},function(){
				$(".PriceTable ul li").removeClass("selact");
				$(".PriceTable ul li:first-child").addClass("selact");
			}
		);
		
		$(".Plane-right ul li").hover(function(){
				var a = $(this).index() + 1;
				$(".Plane-right ul li").removeClass("selact");
				$(".Plane-right ul li:nth-child("+a+")").addClass("selact");				
			},function(){
				$(".Plane-right ul li").removeClass("selact");
				$(".Plane-right ul li:first-child").addClass("selact");
			}
		);
		
		$(".leftDown ul li").click(function(){
				var clic = $(this).index() + 1;
				var liact; 
				if($(this).hasClass("UpActive2")){
					
				}else{
					$(".leftDown ul li").each(function(index, element){
						if($(".leftDown ul li:nth-child("+(index+1)+")").hasClass("UpActive2")){
							liact = index+1;						
						}						   
					});
					$(".leftDown ul li:nth-child("+liact+")").removeClass("UpActive2").delay(200).queue(function(){
						$(".leftDown ul li:nth-child("+liact+") h4").removeClass("UpActive").dequeue();
						$(".leftDown ul li:nth-child("+clic+")").addClass("UpActive2").dequeue();
						$(".leftDown ul li:nth-child("+clic+") h4").addClass("UpActive").dequeue();
					});
				}
			}
			
		);
		
		$(".btnPlanes ul li").click(function(){
				if($(this).html().toString() != "COMPARE PLANES"){
					$(".btnPlanes ul li").removeClass("planactivo");
					$(this).addClass("planactivo");
					$(".PlanName h1").html($(this).html().toString());
					if($(this).index() == 0){
						window.location.href = "/welcome/planes/VISA";
						$("#btnDesPlan").attr("name","Archive12");						
					}
					if($(this).index() == 1){
						window.location.href = "/welcome/planes/UNIVERSAL";
						$("#btnDesPlan").attr("name","Archive11");	
					}
					if($(this).index() == 2){
						window.location.href = "/welcome/planes/TRAVELLER";
						$("#btnDesPlan").attr("name","Archive7");
					}
					if($(this).index() == 3){
						window.location.href = "/welcome/planes/STUDENT";
						$("#btnDesPlan").attr("name","Archive6");
					}
					if($(this).index() == 4){
						window.location.href = "/welcome/planes/PREMIER";
						$("#btnDesPlan").attr("name","Archive3");
					}
					if($(this).index() == 5){
						window.location.href = "/welcome/planes/NATIONAL";
						$("#btnDesPlan").attr("name","Archive2");
					}
					if($(this).index() == 6){
						window.location.href = "/welcome/planes/RECEPTIVE3";
						$("#btnDesPlan").attr("name","Archive4");
					}
					if($(this).index() == 7){
						window.location.href = "/welcome/planes/RECEPTIVE6";
						$("#btnDesPlan").attr("name","Archive5");
					}
					if($(this).index() == 8){
						window.location.href = "/welcome/planes/TOPONE";
						$("#btnDesPlan").attr("name","Archive8");
					}
					if($(this).index() == 9){
						window.location.href = "/welcome/planes/TOPTWO";
						$("#btnDesPlan").attr("name","Archive9");	
					}
					if($(this).index() == 10){
						window.location.href = "/welcome/planes/TOPTHREE";
						$("#btnDesPlan").attr("name","Archive10");	
					}
					if($(this).index() == 11){
						window.location.href = "/welcome/planes/ADULTOMAYOR";
						$("#btnDesPlan").attr("name","Archive1");
					}
				}
			}		
		)		
		//Registro Agencia
		var ValueTemp;
		$("#idRegister input[type='text']").focus(function(){
				if($(this).val() == "Nombre" | $(this).val() == "Apellido" | $(this).val() == "Nombre de agencia" | $(this).val() == "Numero de RUC" | $(this).val() == "Correo electrónico" | $(this).val() == "Teléfono o celular" | $(this).val() == "Usuario" | $(this).val() == "Constraseña"){
					ValueTemp = $(this).val();
					$(this).val("");
				}
			}		
		)
		
		$("#idRegister input[type='text']").blur(function(){
				if($(this).val() == ""){
					$(this).val(ValueTemp);
				}
			}		
		)
		
		//Contactenos
		$(".txtcontc").focus(
			function(){
				if($(this).val() == "para comunicarnos con usted."){
					$(this).val("");
					$(this).removeClass("txtcontc");
					$(this).addClass("txtcontc2");	
				}else{
					$(this).removeClass("txtcontc");
					$(this).addClass("txtcontc2");
				}
			}
		);
		$(".txtcontc").blur(
			function(){
				if($(this).val() == ""){
					$(this).val("para comunicarnos con usted.");
					$(this).removeClass("txtcontc2");
					$(this).addClass("txtcontc");	
				}else{
					$(this).removeClass("txtcontc2");
					$(this).addClass("txtcontc");
				}
			}
		);
		
		$(".TxtMensaje").focus(
			function(){
				if($(this).val() == "Dudas, Preguntas, sugerencias o mas háganos saber en este campo mensaje y estaremos encantados de atenderlos."){
					$(this).val("");	
					$(this).removeClass("TxtMensaje");
					$(this).addClass("TxtMensaje2");	
				}else{
					$(this).removeClass("TxtMensaje");
					$(this).addClass("TxtMensaje2");
				}
			}
		);
		$(".TxtMensaje").blur(
			function(){
				if($(this).val() == ""){
					$(this).val("Dudas, Preguntas, sugerencias o mas háganos saber en este campo mensaje y estaremos encantados de atenderlos.");	
					$(this).removeClass("TxtMensaje2");
					$(this).addClass("TxtMensaje");	
				}else{
					$(this).removeClass("TxtMensaje2");
					$(this).addClass("TxtMensaje");
				}
			}
		);
		
		//Busqueda de ticket		
		$("#txtbuscar").focus(function(){
			if($("#txtbuscar").val() == "Ingrese su ticket"){
				$(this).val("");
				$(this).addClass("txtbh");
			}
		});
		
		$("#txtbuscar").blur(function(){
			if($("#txtbuscar").val() == ""){				
				$(this).val("Ingrese su ticket");
				$(this).removeClass("txtbh");				
			}else{
				$(this).removeClass("txtbh");	
			}
		});
		$(".cerrarventana").click(function(e){
			$('.busqueda').css('display','none');
			$('.busq-write').html("");
			$('.floatclose').css('display','none');	
			$('#txtbuscar').val("Ingrese su ticket");
		})
		$("#btnbuscar").click(function(){
				if($("#txtbuscar").val() != "Ingrese su ticket"){
					if($.isNumeric($("#txtbuscar").val())){
						parametro = {
							"Tipv"	: "Val-vou",
							"codvou" : $("#txtbuscar").val()
						}
						$.ajax({
							async:true,
							type:"POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"/file_all/bin/config.php",
							data:parametro,
							beforeSend:function(e){
									$('.busq-write').html('<p class="mensagee">Espere un momento por favor, estamos buscando su voucher.<br><img src="/file_all/imagenes/load.gif" alt="" width="40" height="40"></p>');
									$('.busqueda').css('display','block');
									$('.busq-cont').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
								success:function(datos){
									if(datos == '0'){										
										$('.busq-write').html('<p class="mensagee">No se ha encontrado nada con este número de voucher, verifique e ingrese nuevamente su voucher.</p>');
										setTimeout(function(e){$('.busqueda').css('display','none');$('.busq-write').html('');},3000);
									}else{
										var sep = datos.split('---->');
										$('.imprimir').attr('href',"/link/protec/assist/voucher.php?id="+sep[0]+"");
										$('.busq-write').html(sep[1])
										$('.floatclose').css('display','block');
									}
									
								},
								error:function(e){
									$('.pop_men p').html('Hubo un error en la conexion');
									$('.emr_pop').css('display','block');
									$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
									setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
								},
							timeout:5000,
							error: function(){}
						});	
					}
				}
			}
		);
		
		//Solo Letras		
		function letras(e){
		   var letras = /^[ñA-Za-z.]+$/;
		   if(letras.test(e)){			   
				return true				
		   }else{
				return false
		   }		   
		};
		
		//Solo Numeros		
		function numeros(e){
		   var num = /^[0-9.]+$/;
		   if(num.test(e)){			   
				return true				
		   }else{
				return false
		   }		   
		};
		
		$("#EnviarForm").click(
			function(){				
				if(!(letras($("#TxtName").val())) | $("#TxtName").val() == "para comunicarnos con usted." | $("#TxtName").val().length <= 2){					
					$(".Datos:eq(0)").addClass("Datos2");
				}else{
					$(".Datos:eq(0)").removeClass("Datos2");
					$(".Datos:eq(0)").addClass("Datos");
				}
				if(!(letras($("#TxtLastName").val())) | $("#TxtLastName").val() == "para comunicarnos con usted." | $("#TxtLastName").val().length <= 2){
					$(".Datos:eq(1)").addClass("Datos2");
				}
				else{
					$(".Datos:eq(1)").removeClass("Datos2");
					$(".Datos:eq(1)").addClass("Datos");
				}
				if(!(compE($("#TxtEmail").val())) | $("#TxtEmail").val() == "para comunicarnos con usted."){
					$(".Datos:eq(2)").addClass("Datos2");
				}
				else{
					$(".Datos:eq(2)").removeClass("Datos2");
					$(".Datos:eq(2)").addClass("Datos");
				}
				if(!(numeros($("#TxtPhone").val())) | $("#TxtPhone").val() == "para comunicarnos con usted." | $("#TxtPhone").val().length <= 6){
					$(".Datos:eq(3)").addClass("Datos2");
				}
				else{
					$(".Datos:eq(3)").removeClass("Datos2");
					$(".Datos:eq(3)").addClass("Datos");
				}
				if($("#TxtM").val() == "Dudas, preguntas, sugerencias o mas háganos saber en este campo mensaje y estaremos encantados de atenderlos." | $("#TxtM").val().length <= 9){
					$(".Datos:eq(4)").addClass("Datos2");
				}else{
					$(".Datos:eq(4)").removeClass("Datos2");
					$(".Datos:eq(4)").addClass("Datos");
				}
				var ctn2 = 0;
				$(".formerr").each(function(index, element) {               	
					if($(".Datos:eq("+index+")").hasClass('Datos2')){
						ctn2 +=1;						
					}
            	});				
				
				if(ctn2 == 0){
					$(".Mensaje p span").removeClass("Red");
					$.ajax({
					async:true,
					type:"POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"/file_all/bin/config.php",
					data:"Tipv=Val-e&TxtN="+$("#TxtName").val()+"&TxtA="+$("#TxtLastName").val()+"&TxtE="+$("#TxtEmail").val()+"&TxtP="+$("#TxtPhone").val()+"&TxtM="+$("#TxtM").val(),
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta envíando su mensaje.<br><img src="/file_all/imagenes/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						if(datos == "error"){
							$('.pop_men p').html('Hubo problemas para enviar el mensaje, revise nuevamente sus datos e intentelo de nuevo.');
						}else{
							$('.pop_men p').html('Su mensaje fue enviado a nuestro buzón de mensajes, en brevedad sera respondido.');
						}						
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);clearcontac();},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					},
					timeout:5000
					});
				}else{
					$(".Mensaje p span").addClass("Red");
				}				
			}
		);
		function clearcontac(){
			$(".txtcontc").val("para comunicarnos con usted.");	
			$(".TxtMensaje").val("Dudas, Preguntas, sugerencias o mas háganos saber en este campo mensaje y estaremos encantados de atenderlos.");	
		}
		//cerrar Ventana
		$(".close").click(function(){
			$(".popup").css("display","none");
			$(".alert").fadeOut("slow");			
			
		});
		
		$(".BtnPlan ul li").hover(
			function(){
				var num = $(this).index()+1;
				var num2 = num - 1;									
				if(num > 1){
					$(".BtnPlan ul li:nth-child("+num2+")").addClass("BtnPlanJ");
				}
			},
			function(){
				var num = $(this).index()+1;
				var num2 = num - 1;												
				if(num > 1){
					$(".BtnPlan ul li:nth-child("+num2+")").removeClass("BtnPlanJ");
				}
			}
		);
		
		$(".pregfre li").click(
			function(){
				$(".pregfre li").css("height","30");
				$(this).css("height","auto");
				$(".pregfre li").removeClass("actcolor");
				$(this).addClass("actcolor");
			}
		);
					
		$("#Salida").blur(
			function(){				
				if($("#Salida").val() != Date){
					$("#Salida").val(dt.getFullYear()+"-"+mes+(dt.getMonth()+1)+"-"+ini+dt.getDate());
				}
			}
		);
					
		$("#Retorno").blur(
			function(){				
				if($("#Retorno").val() != Date){
					$("#Retorno").val(dt.getFullYear()+"-"+mes2+(dt.getMonth()+1)+"-"+ini2+(dt.getDate()+4));
				}
			}
		);
		
		$( "#Salida" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd",
				minDate:0,
				showOn: "button",
				buttonImageOnly: true,
				buttonImage: "/file_all/imagenes/cal.png",
				showAnim:"drop"
   			}
		);
		
		$( "#Retorno" ).datepicker({
     		changeMonth: true,
     		changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate:4,
			showOn: "button",
      		buttonImageOnly: true,
			buttonImage: "/file_all/imagenes/cal.png",
			showAnim:"drop"
   		});
		
		$("#btncoti").click(function(){
			var d1 = $('#Salida').val().split("-");
			var dat1 = new Date(d1[0], parseFloat(d1[1])-1, parseFloat(d1[2]));
			var d2 = $('#Retorno').val().split("-");
			var dat2 = new Date(d2[0], parseFloat(d2[1])-1, parseFloat(d2[2]));
			var dayNum = dat2.getTime() - dat1.getTime();
			dayAct = Math.floor(dayNum/(1000*60*60*24));
			var contq=0;
			
			if($("#Origen option:selected").text() == "Seleccionar"){
				contq +=1;
				$("#Origen").addClass('selectError');
			}else{
				$("#Origen").removeClass('selectError');
			}
			if($("#Destino option:selected").text() == "Seleccionar"){
				contq +=1;
				$("#Destino").addClass('selectError');
			}else{
				$("#Destino").removeClass('selectError');
			}
			if($("#Clase option:selected").text() == "Seleccionar"){
				contq +=1;
				$("#Clase").addClass('selectError');
			}else{
				$("#Clase").removeClass('selectError');
			}
			if(dayAct < 4){
				contq +=1;				
			}						
			
			$(".Edad input").each(function(index, element) {
                if($(this).prop('disabled') == false){					
					if(numeros($(this).val())){
						if($(this).val() > 0){
							$(this).removeClass('EdadesErr');
							$(this).addClass('Edades');
						}else if($(this).val().length == 2){
							$(this).removeClass('EdadesErr');
							$(this).addClass('Edades');
						}else{
							contq += 1;
							$(this).removeClass('Edades');
							$(this).addClass('EdadesErr');
						}					
					}else{
						contq += 1;
						$(this).removeClass('Edades');
						$(this).addClass('EdadesErr');
					}
				}
            });
			
			if(!compE($("#Email").val())){
				contq +=1;
				$("#Email").removeClass('EmailCot');
				$("#Email").addClass('selectError');
			}else{
				$("#Email").removeClass('selectError');
				$("#Email").addClass('EmailCot');
			}
			
			if(contq == 0){
				
				if($("#Destino option:selected").text() == "Europa" | $("#Destino option:selected").text() == "Resto del Mundo"){
					if($("#Clase option:selected").text() == "Larga Estadia" || $("#Clase option:selected").text() == "Estudios"){						
						if(dayAct >= 4 && dayAct <= 365){
							var xcnt=0;						
							$(".Edad input").each(function(index, element){
								if($(this).prop('disabled') == false){
									if(parseInt($(this).val()) > 74){
										xcnt = xcnt + 1;
									}
								}
							})
							if(xcnt > 0){
									$(".resultcot p").html("Si tiene más de 75 años consulte por nuestro plan Adulto Mayor.");
									$(".resultcot").fadeIn("slow");
							}else{
									$("#cantday").val(dayAct+1);
									$("#SendCot").submit();
							}
						}else{
							$(".resultcot p").html("La cantidad de días debe ser mayor a 5 días pero menor o igual a 365 días, de no ser así por favor cotáctenos");
							$(".resultcot").fadeIn("slow");
						}
						
					}else if($("#Clase option:selected").text() == "Varios viajes en un año"){
						if(dayAct >= 45 && dayAct <= 90){
							var xcnt=0;
							$(".Edad input").each(function(index, element){
								if($(this).prop('disabled') == false){
									if(parseInt($(this).val()) > 74){
										xcnt = xcnt + 1;
									}
								}
							})							
							if(xcnt > 0){
									$(".resultcot p").html("Si tiene más de 75 años consulte por nuestro plan Adulto Mayor.");
									$(".resultcot").fadeIn("slow");
							}else{
									$("#cantday").val(dayAct+1);
									$("#SendCot").submit();
							}
						}else{
							$(".resultcot p").html("Requisitos: La cantidad de días debe ser mayor a 45 pero menor o igual a 90. De no ser así por favor cotáctenos");
							$(".resultcot").fadeIn("slow");
						}
					}else{
						if(dayAct >= 4 && dayAct <= 365){
							var xcnt=0;
							$(".Edad input").each(function(index, element){
								if($(this).prop('disabled') == false){
									if(parseInt($(this).val()) > 74){
										xcnt = xcnt + 1;
									}
								}
							})
							if(xcnt > 0){
								$(".resultcot p").html("Si tiene más de 75 años consulte por nuestro plan Adulto Mayor.");
								$(".resultcot").fadeIn("slow");
							}else{
								$("#cantday").val(dayAct+1);
								$("#SendCot").submit();
							}
						}else{
							$(".resultcot p").html("La cantidad de días debe ser mayor a 4 pero menor o igual a 365 días, de no ser así por favor contáctenos.");
							$(".resultcot").fadeIn("slow");
						}
					}			
				}							
			}
		});	
		
		$("#btnclose").click(function(){
			$(".resultcot").fadeOut("slow");	
		});
		
		$(".BtnPlan ul li").click(function(){
			valor = $(this).index()+1;
			if(valor == 1){
				$(".BtnPlan ul li").removeClass("BtnPlanH");
				$(".BtnPlan ul li").removeClass("BtnPlanJ");				
				$(".BtnPlan ul li:nth-child(1)").addClass("BtnPlanH");
				$(".PlanVisa").fadeIn("slow");
				$(".PlanUniv").css("display","none");
				$(".PlanStud").css("display","none");
				$(".PlanAdM").css("display","none");
			}
			if(valor == 2){
				$(".BtnPlan ul li").removeClass("BtnPlanH");
				$(".BtnPlan ul li").removeClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(1)").addClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(2)").addClass("BtnPlanH");
				$(".PlanVisa").css("display","none");
				$(".PlanUniv").fadeIn("slow");
				$(".PlanStud").css("display","none");
				$(".PlanAdM").css("display","none");
			}
			if(valor == 3){
				$(".BtnPlan ul li").removeClass("BtnPlanH");
				$(".BtnPlan ul li").removeClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(2)").addClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(3)").addClass("BtnPlanH");
				$(".PlanVisa").css("display","none");
				$(".PlanUniv").css("display","none");
				$(".PlanStud").fadeIn("slow");
				$(".PlanAdM").css("display","none");
			}
			if(valor == 4){
				$(".BtnPlan ul li").removeClass("BtnPlanH");
				$(".BtnPlan ul li").removeClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(3)").addClass("BtnPlanJ");
				$(".BtnPlan ul li:nth-child(4)").addClass("BtnPlanH");
				$(".PlanVisa").css("display","none");
				$(".PlanUniv").css("display","none");
				$(".PlanStud").css("display","none");
				$(".PlanAdM").fadeIn("slow");
			}			
		});
		
		$("#txtbuscar").focus(function(){
			if($("#txtbuscar").val() == "Ingrese su ticket"){
				$("#txtbuscar").val("");
			}
		});
		
		$("#txtbuscar").blur(function(){
			if($("#txtbuscar").val() == ""){
				$("#txtbuscar").val("Ingrese su ticket");
			}
		});
		
		$("#btnbuscar").click(function(){
			$("#txtbuscar").val("Ingrese su ticket");
		});
		
		$("#TxtS").focus(function(){
			if($("#TxtS").val() == "E-mail para suscripción" | $("#TxtS").val() == "Debe ingresar un e-mail valido."){
				$("#TxtS").val("");
			}
		}).blur(function(){
			if($("#TxtS").val() == ""){
				$("#TxtS").val("E-mail para suscripción");
			}
		});	
			
		$("#idName").focus(function(){
			if($("#idName").val() == "Nombre"){
				$("#idName").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idName").val()) == ""){
				$("#idName").val("Nombre");	
			}			
		})
		
		$("#idLastName").focus(function(){
			if($("#idLastName").val() == "Apellido"){
				$("#idLastName").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idLastName").val()) == ""){
				$("#idLastName").val("Apellido");	
			}			
		})
		
		$("#idNameAg").focus(function(){
			if($("#idNameAg").val() == "Nombre de agencia"){
				$("#idNameAg").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idNameAg").val()) == ""){
				$("#idNameAg").val("Nombre de agencia");	
			}			
		})
		
		$("#idNRuc").focus(function(){
			if($("#idNRuc").val() == "Número de RUC"){
				$("#idNRuc").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idNRuc").val()) == ""){
				$("#idNRuc").val("Número de RUC");	
			}			
		})
		
		$("#idcorreo").focus(function(){
			if($("#idcorreo").val() == "Correo electrónico"){
				$("#idcorreo").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idcorreo").val()) == ""){
				$("#idcorreo").val("Correo electrónico");	
			}			
		})
		
		$("#iddir").focus(function(){
			if($("#iddir").val() == "Dirección"){
				$("#iddir").val("");	
			}			
		}).blur(function(){
			if($.trim($("#iddir").val()) == ""){
				$("#iddir").val("Dirección");	
			}			
		})
		
		$("#idTOC").focus(function(){
			if($("#idTOC").val() == "Teléfono o celular"){
				$("#idTOC").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idTOC").val()) == ""){
				$("#idTOC").val("Teléfono o celular");	
			}			
		})
		
		$("#idUser").focus(function(){
			if($("#idUser").val() == "Usuario"){
				$("#idUser").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idUser").val()) == ""){
				$("#idUser").val("Usuario");	
			}			
		})
		
		$("#idClave").focus(function(){
			if($("#idClave").val() == "Constraseña"){
				$("#idClave").val("");	
			}			
		}).blur(function(){
			if($.trim($("#idClave").val()) == ""){
				$("#idClave").val("Constraseña");	
			}			
		})
		
		$("#idbtnreg").click(function(){
			var num_error=0;
			//Validar
			if($("#idName").val() == "Nombre"){
				num_error +=1;
				$('#idName').css('background','#FFE1E1')	
			}else if($.trim($("#idName").val()) == ""){
				num_error +=1;
				$('#idName').css('background','#FFE1E1')
			}else if($.trim($("#idName").val()).length < 3){
				num_error +=1;
				$('#idName').css('background','#FFE1E1')
			}else if($.isNumeric($("#idName").val())){
				num_error +=1;
				$('#idName').css('background','#FFE1E1')
			}else{
				$('#idName').css('background','none')
			}
			
			if($("#idLastName").val() == "Apellido"){
				num_error +=1;
				$('#idLastName').css('background','#FFE1E1')	
			}else if($.trim($("#idLastName").val()) == ""){
				num_error +=1;
				$('#idLastName').css('background','#FFE1E1')
			}else if($.trim($("#idLastName").val()).length < 3){
				num_error +=1;
				$('#idLastName').css('background','#FFE1E1')
			}else if($.isNumeric($("#idLastName").val())){
				num_error +=1;
				$('#idLastName').css('background','#FFE1E1')
			}else{
				$('#idLastName').css('background','none')
			}
			
			if($("#idNameAg").val() == "Nombre de agencia"){
				num_error +=1;
				$('#idNameAg').css('background','#FFE1E1')	
			}else if($.trim($("#idNameAg").val()) == ""){
				num_error +=1;
				$('#idNameAg').css('background','#FFE1E1')
			}else if($.trim($("#idNameAg").val()).length < 5){
				num_error +=1;
				$('#idNameAg').css('background','#FFE1E1')
			}else if($.isNumeric($("#idNameAg").val())){
				num_error +=1;
				$('#idNameAg').css('background','#FFE1E1')
			}else{
				$('#idNameAg').css('background','none')
			}
			
			if($.trim($("#idNRuc").val()).length < 11){
				num_error +=1;
				$('#idNRuc').css('background','#FFE1E1')
			}else if(!$.isNumeric($("#idNRuc").val())){
				num_error +=1;
				$('#idNRuc').css('background','#FFE1E1')
			}else{
				$('#idNRuc').css('background','none')
			}
			
			if(!compE($.trim($('#idcorreo').val()))){
				$('#idcorreo').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('#idcorreo').css('background','none')
			}
			
			if($("#iddir").val() == "Dirección"){
				num_error +=1;
				$('#iddir').css('background','#FFE1E1')	
			}else if($.trim($("#iddir").val()) == ""){
				num_error +=1;
				$('#iddir').css('background','#FFE1E1')
			}else if($.trim($("#iddir").val()).length < 5){
				num_error +=1;
				$('#iddir').css('background','#FFE1E1')
			}else if($.isNumeric($("#iddir").val())){
				num_error +=1;
				$('#iddir').css('background','#FFE1E1')
			}else{
				$('#iddir').css('background','none')
			}
			
			if($.trim($("#idTOC").val()).length < 5){
				num_error +=1;
				$('#idTOC').css('background','#FFE1E1')
			}else{
				$('#idTOC').css('background','none')
			}
			
			if($("#idUser").val() == "Usuario"){
				num_error +=1;
				$('#idUser').css('background','#FFE1E1')	
			}else if($.trim($("#idUser").val()) == ""){
				num_error +=1;
				$('#idUser').css('background','#FFE1E1')
			}else if($.trim($("#idUser").val()).length < 3){
				num_error +=1;
				$('#idUser').css('background','#FFE1E1')
			}else{
				$('#idUser').css('background','none')
			}
			
			if($("#idClave").val() == "Constraseña"){
				num_error +=1;
				$('#idClave').css('background','#FFE1E1')	
			}else if($.trim($("#idClave").val()) == ""){
				num_error +=1;
				$('#idClave').css('background','#FFE1E1')
			}else if($.trim($("#idClave").val()).length < 3){
				num_error +=1;
				$('#idClave').css('background','#FFE1E1')
			}else{
				$('#idClave').css('background','none')
			}
			
			if(num_error == 0){
				var parm = {
					"Tipv" : "Val-t",
					"name" : $("#idName").val(),
					"lname" : $("#idLastName").val(),
					"nangecia" : $("#idNameAg").val(),
					"ruc" : $("#idNRuc").val(),
					"email" : $("#idcorreo").val(),
					"dir" : $("#iddir").val(),
					"tel" : $("#idTOC").val(),
					"user" : $("#idUser").val(),
					"pass" : $("#idClave").val(),
				}
				$.ajax({
					async:true,
					type:"POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"/welcome/regagent",
					data:parm,
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="/file_all/imagenes/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						if(datos != 'error'){
							$('.pop_men p').html(datos);
						}
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);/*clearagencia();*/},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
					timeout:4000
		  		});
			}
			//Finalizar validado
			
		})
		function clearagencia(){
			$("#idName").val("Nombre");
			$("#idLastName").val("Apellido");
			$("#idNameAg").val("Nombre de agencia");
			$("#idNRuc").val("Número de RUC");
			$("#idcorreo").val("Correo electrónico");
			$("#idTOC").val("Teléfono o celular");
			$("#idUser").val("Usuario");
			$("#idClave").val("Constraseña");
		}
		//Funcion validar Correo
		function compE(valor){
		 // creamos nuestra regla con expresiones regulares.
			var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		 // utilizamos test para comprobar si el parametro valor cumple la regla
			if(filter.test(valor))
				return true;
			else
				return false;
		 };
		
		$("#SendS").click(function(){
			var email = $("#TxtS").val();
			if(compE(email)){
			$.ajax({
				async:true,
				type:"POST",
				dataType:"html",
				contentType:"application/x-www-form-urlencoded",
				url:"/file_all/bin/config.php",
				data:"Tipv=Val-s&email="+email+"",
				beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se registrando su E-mail.<br><img src="/file_all/imagenes/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						$('.pop_men p').html('Su E-mail fue registrado correctamente, pronto estará recibiendo nuevas ofertas.');
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);clearagencia();},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					},
				timeout:5000,
				error: function(){}
		  	});
			}else{				
				$("#TxtS").css("color","#626262").val("Debe ingresar un e-mail valido.");
			}
		});		
	};