//JavaScript Document
//Iniciar
var ini;
	ini = $(document);
	ini.ready(iniciar);
	function iniciar(){						
    	$("#newvoucher").click(vent_popup);
		$("#newpromotor").click(vent_popup);
		$('#btn_mod a').click(vent_popup2);
		$("#newPlanes").click(vent_popup);
		$("#newagen").click(vent_popup);	
		$('#newcounter').click(vent_popup);
		$('#newpasaj').click(vent_popup);
		$('#closepopup').click(closepopup);
		//Menu selecction
		$('.menuplan li li').click(function(){
			$('.menuplan .menutitle').text($(this).text())
			$('.menuplan li li').removeClass('submenuon');
			$(this).addClass('submenuon');
		})
		$('.menusexo li li').click(function(){
			$('.menusexo .menutitle').text($(this).text())
			$('.menusexo li li').removeClass('submenuon');
			
			$(this).addClass('submenuon');
		})
		$('.idpromot li li').click(function(){
			$('.idpromot .menutitle').text($(this).text());
			$('.idpromot .menutitle').attr('id',$(this).prop('id'))
			$('.idpromot li li').removeClass('submenuon');
			$(this).addClass('submenuon');
		})
		$('.psasexo li li').click(function(){
			$('.psasexo .menutitle').text($(this).text())
			$('.psasexo li li').removeClass('submenuon');
			$(this).addClass('submenuon');
		})
		$('.psanac li li').click(function(){
			$('.psanac .menutitle').text($(this).text())			
			$('.psanac li li').removeClass('submenuon');
			$(this).addClass('submenuon');
			if($('.psanac .menutitle').text() == 'Extranjero'){
				$('.txtdist').prop('disabled', true)				
			}else{
				$('.txtdist').prop('disabled', false)
			}
		})
		$('.menunac li li').click(function(){
			$('.menunac .menutitle').text($(this).text())
			$('.menunac li li').removeClass('submenuon');
			$(this).addClass('submenuon');
			if($('.menunac .menutitle').text() == 'Extranjero'){
				$('.txtdist').prop('disabled', true)				
			}else{
				$('.txtdist').prop('disabled', false)
			}
			
		})
		$('#btnguardar').click(function(e){
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{
				var p=0,d=0;var nday = [];var pr = [];
				$(".txtdaypl").each(function(index, element){
					nday[d++] = $(this).val();
				})
				$(".txtprpl").each(function(index, element){
					pr[p++] = $(this).val();
				})
				var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
				var csdd;if($('.txtdad').val() == ''){csdd = '0'}else{csdd = $('.txtdad').val()};
				var parm = 
					{
						"np" : $('.txtnamepl').val(),
						"nday" : nday,
						"pr" : pr,
						"hab" : hab,
						"ad" : csdd,
						"event" : 'newplan'
					}
				$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						$('.pop_men p').html(datos);
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
			}
		})
		$('#btnsavea').click(function(e){
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{				
				var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
				var parm = 
					{
						"prom" : $.trim($('.idpromot .menutitle').prop('id')),
						"ruc" : $('.txtruca').val(),
						"nameag" : $('.txtnoma').val(),
						"maila" : $('.txtcora').val(),
						"tel" : $('.txttela').val(),
						"com" : $('.txtcomia').val(),
						"direc" : $('.txtdira').val(),
						"name" : $('.txtnamea').val(),
						"lname" : $('.txtlastnamea').val(),
						"mailp" : $('.txtemaila').val(),
						"hab" : hab,
						"us" : $('.txtusera').val(),
						"pas" : $('.txtpassa').val(),
						"event" : 'newagen'
					}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						$('.pop_men p').html(datos);
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
					timeout:4000
				})
			}
		});
		$('.btnnewfl').click(function(e){			
			$('.contplanes').append('<div class="newfila"> <div class="caja_daypl"> <div class="tam"> <p>Nº de días</p> <input type="text" name="txthb" class="txtdaypl" value="&#32;"> </div> </div> <div class="caja_prpl"> <div class="tam"> <p>Precio</p> <input type="text" name="txthb" class="txtprpl" value="&#32;"> </div> </div> </div>');
		})	
		$("#btnPend").click(
			function(e){
				if(valvou() > 0){
					$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
					$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
					$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				}else{
					var ano = (new Date).getFullYear();
					var a = $('.txtfn').val().split('/')
					edadx =   ano - a[2];
					if($('.menuplan .menutitle').text() == 'VISA' || $('.menuplan .menutitle').text() == 'UNIVERSAL' || $('.menuplan .menutitle').text() == 'TRAVELLER' || $('.menuplan .menutitle').text() == 'PREMIER' || $('.menuplan .menutitle').text() == 'NATIONAL' || $('.menuplan .menutitle').text() == 'RECEPTIVE 3' || $('.menuplan .menutitle').text() == 'RECEPTIVE 6' || $('.menuplan .menutitle').text() == 'TOP ONE' || $('.menuplan .menutitle').text() == 'TOP TWO' || $('.menuplan .menutitle').text() == 'TOP THREE')
					{
						if(edadx >= 0  && edadx <= 74)
						{
							enviars(0);	
						}else{
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0, y menor o igual a 74.');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)	
						}
					}else if($('.menuplan .menutitle').text() == 'STUDENT')
					{
						if(edadx >= 0  && edadx <= 63)
						{
							enviars(0);	
						}else{
							$('.pop_men p').html('La edad del pasajero debe mayor o igual 0, y menor o igual a 63.');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
						
					}else if($('.menuplan .menutitle').text() == 'ADULTO MAYOR')
					{
						if(edadx >= 0)
						{
							enviars(0);	
						}else{							
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
					}else if($('.menuplan .menutitle').text() == 'VISA ANUAL 45' || $('.menuplan .menutitle').text() == 'VISA ANUAL 60' || $('.menuplan .menutitle').text() == 'VISA ANUAL 90' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 45' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 60' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 90' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 45' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 60' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 90')
					{
						if(edadx >= 0  && edadx <= 74)
						{
							enviars(0);	
						}else{							
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
					}
				}
			}
		)
		function enviars(valorx)
		{
					var mp;
					if($('.bgincPre span').prop('class') == 'bgincPreon'){mp=1}else{mp=0}
					var parm = 
					{
						"Plan" : $('.menuplan .menutitle').text(),
						"Destino" : $('.txtdest').val(),
						"CobDes" : $('.txtfecs').val(),
						"CobHasta" : $('.txtfecr').val(),
						"documento" : $('.txtdoc').val(),
						"nombres" : $('.txtname').val(),
						"apellidos" : $('.txtlastname').val(),
						"domicilio" : $('.txtaddres').val(),
						"fecn" : $('.txtfn').val(),
						"sexo" : $('.psasexo .menutitle').text(),
						"correo" : $('.txtemail').val(),
						"tele" : $('.txttel').val(),
						"nacionalidad" : $.trim($('.menunac .menutitle').text()),
						"pais" : $('.txtPais').val(),
						"ciudad" : $('.txtCiudad').val(),
						"distrito" : $('.txtdist').val(),
						"nd" : $.trim($('.bgday p').text()),
						"precio" : $.trim($('.bgPrecio p').text()),
						"nombres2" : $('.txtn2').val(),
						"apellido2" : $('.txtln2').val(),
						"tele2" : $('.txttel2').val(),
						"aprob" : valorx,
						"mp" : mp,
						"event" : 'newvou'
					};
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){
							if(datos != 'error'){
								$('.xcont').html(datos);$('.ob_voucher').fadeIn('slow');
							}else{
								alert('ERROR')
							};
							},
						error:error,
						timeout:4000
					})	
		}
		function errosol()
		{
			$('.pop_men p').html('');
			$('.emr_pop').css('display','block');
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
		}
		$("#btnAprob").click(
			function(e){
				if(valvou() > 0){
					$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
					$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
					$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				}else{
					var ano = (new Date).getFullYear();
					var a = $('.txtfn').val().split('/')
					edadx =   ano - a[2];				
					if($('.menuplan .menutitle').text() == 'VISA' || $('.menuplan .menutitle').text() == 'UNIVERSAL' || $('.menuplan .menutitle').text() == 'TRAVELLER' || $('.menuplan .menutitle').text() == 'PREMIER' || $('.menuplan .menutitle').text() == 'NATIONAL' || $('.menuplan .menutitle').text() == 'RECEPTIVE 3' || $('.menuplan .menutitle').text() == 'RECEPTIVE 6' || $('.menuplan .menutitle').text() == 'TOP ONE' || $('.menuplan .menutitle').text() == 'TOP TWO' || $('.menuplan .menutitle').text() == 'TOP THREE')
					{
						if(edadx >= 0  && edadx <= 75)
						{
							enviars(1);	
						}else{
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0, y menor o igual a 74.');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)	
						}
					}else if($('.menuplan .menutitle').text() == 'STUDENT')
					{
						if(edadx >= 0  && edadx <= 64)
						{
							enviars(1);	
						}else{
							$('.pop_men p').html('La edad del pasajero debe mayor o igual 0, y menor o igual a 64.');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
						
					}else if($('.menuplan .menutitle').text() == 'ADULTO MAYOR')
					{
						if(edadx >= 0)
						{
							enviars(1);	
						}else{							
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
					}else if($('.menuplan .menutitle').text() == 'VISA ANUAL 45' || $('.menuplan .menutitle').text() == 'VISA ANUAL 60' || $('.menuplan .menutitle').text() == 'VISA ANUAL 90' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 45' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 60' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 90' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 45' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 60' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 90')
					{
						if(edadx >= 0  && edadx <= 75)
						{
							enviars(0);	
						}else{							
							$('.pop_men p').html('La edad del pasajero debe ser mayor o igual 0');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
						}
					}
				}
			}
		)
		
		
    	$( "#idfecs" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
				minDate:0,
				showAnim:'drop',
				onClose:function(dateText, inst){
					cantdias();
				}
			}
		)
		$( "#idfecr" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
				minDate:4,
				showAnim:'drop',
				onClose:function(dateText, inst){
					cantdias();
				}
			}
		)
		$( "#idfecn" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
				maxDate:0,
				showAnim:'drop'
			}
		)
		$( "#idtxtdsd" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				showAnim:'drop'
			}
		)
		$( "#idtxthst" ).datepicker(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				showAnim:'drop'
			}
		)
		$('.bgincPre span').click(function(e){
			if($(this).prop('class') == ''){
				$(this).addClass('bgincPreon')
			}else{
				$(this).removeClass('bgincPreon')
			}
		})
		$('.txtdoc').focusout(function(e) {
			if($(this).val() != ''){
				if($(this).val().length > 4){
					var documento = $.trim($('.txtdoc').val())
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/busquedadnivoucher.php",
						data:"documento="+documento,
						success:busquedadni,
						timeout:4000
					})
				}
			}
        });
		$('#btnlimp').click(function(e){
			clearpopup();	
		})
		$('.txthbonp').click(function(e){if($(this).prop('class') == 'txthbonp'){$(this).removeClass('txthbonp');$(this).addClass('txthboffp');}else{$(this).removeClass('txthboffp');$(this).addClass('txthbonp');}});
		$('#btnprosave').click(function(e){
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{
				var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
				var parm = 
					{					
					"nombre": $('.txtname').val(),
					"apellido": $('.txtlastname').val(),
					"correo": $('.txtemail').val(),
					"tel": $('.txttel').val(),
					"hab": hab,
					"event": 'newprom'
					}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						if(datos != 'error'){
							$('.pop_men p').html(datos);
						}else{
							$('.pop_men p').html('Hubo un error en la conexion');
							$('.emr_pop').css('display','block');
							$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
							setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);	
						}
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
					timeout:4000
				})
			}
		})
		$('#btnmod').click(function(e){
			var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{
				if($('#btn_mod a').prop('id') == 'modvoucher'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
						var mp;
						if($('.bgincPre span').prop('class') == 'bgincPreon'){mp=1}else{mp=0}
						var parm = 
						{
							"cod" : cod,
							"Plan" : $('.menuplan .menutitle').text(),
							"Destino" : $('.txtdest').val(),
							"CobDes" : $('.txtfecs').val(),
							"CobHasta" : $('.txtfecr').val(),
							"documento" : $('.txtdoc').val(),
							"nombres" : $('.txtname').val(),
							"apellidos" : $('.txtlastname').val(),
							"domicilio" : $('.txtaddres').val(),
							"fecn" : $('.txtfn').val(),
							"sexo" : $('.psasexo .menutitle').text(),
							"correo" : $('.txtemail').val(),
							"tele" : $('.txttel').val(),
							"nacionalidad" : $.trim($('.menunac .menutitle').text()),
							"pais" : $('.txtPais').val(),
							"ciudad" : $('.txtCiudad').val(),
							"distrito" : $('.txtdist').val(),
							"nd" : $.trim($('.bgday p').text()),
							"precio" : $.trim($('.bgPrecio p').text()),
							"nombres2" : $('.txtn2').val(),
							"apellido2" : $('.txtln2').val(),
							"tele2" : $('.txttel2').val(),
							"mp" : mp,
							"type" : 'vouch',
							"event" : 'change'
						};
						$.ajax(
						{
							async:true,
							type: "POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"inc/funct.php",
							data:parm,
							beforeSend:loader,
							success:modwrite,
							complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
							error:error,
							timeout:4000
						})
				}else if($('#btn_mod a').prop('id') == 'modpromotor'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
						var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
						var parm = 
							{
							"cod" : cod,
							"nam": $('.txtname').val(),
							"lnam": $('.txtlastname').val(),							
							"mail": $('.txtemail').val(),
							"tel": $('.txttel').val(),
							"hab": hab,
							"type" : 'promt',
							"event" : 'change'
							}
						$.ajax(
						{
							async:true,
							type: "POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"inc/funct.php",
							data:parm,
							beforeSend:loader,
							success:modwrite,
							complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
							error:error,
							timeout:4000
						})
				}else if($('#btn_mod a').prop('id') == 'modPlanes'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
					
						var p=0,d=0;var nday = [];var pr = [];
						$(".txtdaypl").each(function(index, element){
							nday[d++] = $(this).val();
						})
						$(".txtprpl").each(function(index, element){
							pr[p++] = $(this).val();
						})
						var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
						var csdd;if($('.txtdad').val() == ''){csdd = '0'}else{csdd = $('.txtdad').val()};
						var parm = 
							{
								"cod" : cod,
								"np" : $('.txtnamepl').val(),
								"nday" : nday,
								"pr" : pr,
								"hab" : hab,
								"ad" : csdd,
								"type" : 'planes',
								"event" : 'change'
							}
						$.ajax({
								async:true,
								type: "POST",
								dataType:"html",
								contentType:"application/x-www-form-urlencoded",
								url:"inc/funct.php",
								data:parm,
								beforeSend:loader,
								success:modwrite,
								complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
								error:error,
								timeout:4000
							})
				}else if($('#btn_mod a').prop('id') == 'modagen'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
					var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
					var parm = 
					{
						"cod" : cod,
						"prom" : $('.idpromot .menutitle').attr('id'),						
						"nameag" : $('.txtnoma').val(),
						"maila" : $('.txtcora').val(),
						"tel" : $('.txttela').val(),
						"com" : $('.txtcomia').val(),
						"direc" : $('.txtdira').val(),
						"name" : $('.txtnamea').val(),
						"lname" : $('.txtlastnamea').val(),
						"mailp" : $('.txtemaila').val(),
						"hab" : hab,
						"us" : $('.txtusera').val(),
						"pas" : $('.txtpassa').val(),
						"type" : 'agenc',
						"event" : 'change'
					}
					$.ajax({
							async:true,
							type: "POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"inc/funct.php",
							data:parm,
							beforeSend:loader,
							success:modwrite,
							complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},2000);},
							error:error,
							timeout:4000
						})
				}else if($('#btn_mod a').prop('id') == 'modcounter'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
					var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
					var parm = 
					{
						"cod" : cod,						
						"name" : $('.txtnomc').val(),
						"lname" : $('.txtapec').val(),
						"tel" : $('.txttelc').val(),
						"email" : $('.txtcorc').val(),
						"us" : $('.txtuserc').val(),
						"ps" : $('.txtcontc').val(),
						"hab" : hab,						
						"type" : 'count',
						"event" : 'change'
					}
					$.ajax({
							async:true,
							type: "POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"inc/funct.php",
							data:parm,
							beforeSend:loader,
							success:modwrite,
							complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
							error:error,
							timeout:3000
							})
				}else if($('#btn_mod a').prop('id') == 'modpasaj'){
					var cod = [];var x=0;
					$('.table_filas input:checkbox').each(function(index, element) {
						if($(this).prop('checked') == true){
							cod[x++] = $(this).prop('id')						
						}
					});
					var parm = 
					{
						"cod" : cod,
						"dni" : $('.txtdc').val(),
						"name" : $('.txtname').val(),						
						"lname" : $('.txtlastname').val(),
						"dirc" : $('.txtaddres').val(),
						"fcn" : $('.txtfn').val(),
						"sexo" : $('.psasexo .menutitle').text(),
						"tel" : $('.txttel').val(),
						"cel" : $('.txtmov').val(),
						"nac" : $('.psanac .menutitle').text(),
						"pais" : $('.txtPais').val(),
						"ciudad" : $('.txtCiudad').val(),
						"dist" : $('.txtdist').val(),
						"name2" : $('.txtn2').val(),
						"lname2" : $('.txtln2').val(),
						"tel2" : $('.txttel2').val(),					
						"type" : 'pasaj',
						"event" : 'change'
					}
					$.ajax({
							async:true,
							type: "POST",
							dataType:"html",
							contentType:"application/x-www-form-urlencoded",
							url:"inc/funct.php",
							data:parm,
							beforeSend:loader,
							success:modwrite,
							complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');location.reload();},3000);},
							error:error,
							timeout:4000
							})
				}
			}
		})
		$('#btnsavec').click(function(e){
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{
				var hab;if($('.txthbonp').prop('class') == 'txthbonp'){hab = '1';}else{hab = '0'};
				var parm = 
					{					
					"rc": $('.txtrucc').val(),
					"nam": $('.txtnomc').val(),
					"lnam": $('.txtapec').val(),
					"tel": $('.txttelc').val(),
					"mail": $('.txtcorc').val(),
					"user": $('.txtuserc').val(),
					"pass": $('.txtcontc').val(),
					"hab": hab,
					"event": 'newcounter'
					}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					beforeSend:function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},
					success:function(datos){
						$('.pop_men p').html(datos);
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
					timeout:4000
				})
			}
		})
		$('#btnnewpa').click(function(e){
			if(valvou() > 0){
				$('.msg_error').animate({height: "40"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
				$('.msg_error p').text('Por favor corrija los campos marcados en rojo para proceder.')
				$('.msg_error').delay(2000).animate({height: "0"},{duration: 2500,specialEasing:{width: "linear",height: "easeOutBounce"}})
			}else{				
				var parm = 
					{					
					"dc": $('.txtdc').val(),
					"nam": $('.txtname').val(),
					"lnam": $('.txtlastname').val(),
					"dir": $('.txtaddres').val(),
					"fn": $('.txtfn').val(),
					"sexo": $.trim($('.psasexo .menutitle').text()),
					"mail": $('.txtemail').val(),
					"tel": $('.txttel').val(),
					"mov": $('.txtmov').val(),
					"nac": $.trim($('.psanac .menutitle').text()),
					"country": $('.txtPais').val(),
					"city": $('.txtCiudad').val(),
					"dist": $('.txtdist').val(),
					"nam2": $('.txtn2').val(),
					"lnam2": $('.txtln2').val(),
					"tel2": $('.txttel2').val(),					
					"event": 'newpass'
					}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					beforeSend: function(e){
						$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
					},
					success:function(datos){
						$('.pop_men p').html(datos);
					},
					complete:function(e){setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);},
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					},
					timeout:4000
				})
			}
		})
		
		$('#btn_delete a').click(
			function(e)
			{
				var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length > 0){
					if(cod.length > 1){
						$('.pop_men p').html('Esta seguro qué deseas eliminar estas celdas?<br><br><a href="javascript:eliminar();">Eliminar</a> <a href="javascript:denegar();">Cancelar</a>.');
						$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
					}else if(cod.length == 1){
						$('.pop_men p').html('Esta seguro qué desea eliminar esta celda?<br><br><a href="javascript:eliminar();">Eliminar</a> <a href="javascript:denegar();">Cancelar</a>.');
						$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
					}
				}else{
					$('.pop_men p').html('Seleccione 1 código para eliminar.');
					$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
					$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
					setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
				}
			}
		)
		$('#btn_exp a').click(
			function(e)
			{
				var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length > 0){
					var parm = 
						{
							"cod" : cod,
							"tipo" : $('#btn_exp').prop('class'),
							"event": 'export'
						}					
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(e){$('.export iframe').attr('src','inc/export/export.php');},
						complete:function(e){setTimeout(function(e){$('.export iframe').attr('src','inc/export/clear.php')},4000)},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
					
				}else{
					$('.pop_men p').html('Debe seleccionar un registro para exportar.');
					$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
					$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
					setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
				}
			}
		)
		$('#btn_aop a').click(function(e){
			var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length > 0){					
					var parm = 
						{
							"cod" : cod,
							"event": 'tipo_pag'
						}					
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){location.reload()},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
					
				}	
		})
		$('#btn_onoff a').click(function(e){
			var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length > 0){
					var parm = 
						{
							"cod" : cod,
							"tipo" : $('#btn_onoff a').prop('class'),
							"event": 'habi'
						}
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){location.reload()},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
				}
		})
		$('.btnoon').click(function(e){
			var cod = [];
					cod[0] = $(this).prop('id');
					var parm = 
						{
							"cod" : cod,
							"tipo" : $('#btn_onoff a').prop('class'),
							"event": 'habi'
						}
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){location.reload()},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
		})
		$('.btnoff').click(function(e){
			var cod = [];
					cod[0] = $(this).prop('id');
					var parm = 
						{
							"cod" : cod,
							"tipo" : $('#btn_onoff a').prop('class'),
							"event": 'habi'
						}
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){location.reload()},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
		})
		$('#searchcod').click(function(e){
			$('.bt_u').css('display','block');
			$('.bt_c').css('display','none');
		});
		$('#searchfec').click(function(e){
			$('.bt_c').css('display','block');
			$('.bt_u').css('display','none');
		});
		$('.idbuscarf').click(function(e){
			if($('#idtxtdsd').val() != '' && $('#idtxthst').val() != ''){
				var parm = 
						{
							"fec1" : $('#idtxtdsd').val(),
							"fec2" : $('#idtxthst').val(),
							"event": 'searchrange'
						}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					success:resultsearch2,
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
					},
					timeout:4000
				})
			}else{
				$('.pop_men p').html('Debe ingresar un rango de fechas correctas.');
				$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
				$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
				setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
			}
		});
		$('#verprec').click(function(e){
			var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length == 1){
					var parm = 
						{
							"cod" : cod,							
							"event": 'ob_planes'
						}
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:planpre,
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
				}
		})
		$('.idbuscar').click(function(e){			
			buscador($('.btn_activo').text())
		})
		$('#btn_voucher a').click(function(e){
			var cod = [];var x=0;
				$('.table_filas input:checkbox').each(function(index, element) {
                    if($(this).prop('checked') == true){
						cod[x++] = $(this).prop('id')						
					}
                });
				if(cod.length == 1){
					var parm = 
						{
							"cod" : cod,
							"event": 'ob_voucher'
						}
					$.ajax(
					{
						async:true,
						type: "POST",
						dataType:"html",
						contentType:"application/x-www-form-urlencoded",
						url:"inc/funct.php",
						data:parm,
						success:function(datos){$('.xcont').html(datos);$('.ob_voucher').fadeIn('slow');},
						error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
						timeout:4000
					})
					
				}	
		})
		
		
		$('.ob_close').click(function(e){
				$('.ob_voucher').fadeOut('slow');$('.xcont').html('');
		})
		$('.Sec_resultado .table_title input:checkbox').click(function(e){
			if($(this).prop('checked') == true){
				$(".Sec_resultado input:checkbox").prop('checked', true);
				$("input[type=checkbox]").prop('checked', true);
			}else{
				$("input:checkbox").prop('checked', false);
				$("input[type=checkbox]").prop('checked', false);
			}
		})
    }
	function planpre(datos){
		$('.xcont').html(datos);
		$('.ob_voucher').fadeIn('slow');
	}
	function resultsearch(datos){
		if(datos != ""){
			$('.Sec_resultado').html(datos);	
		}else{
			$('.pop_men p').html('No existe registro con este código.');
			$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
		}				
	}
	function resultsearch2(datos){
		if(datos != ""){			
			window.location.replace('/panel/main/?fecs='+$('#idtxtdsd').val()+'&fecr='+$('#idtxthst').val()+'');
		}else{
			$('.pop_men p').html('No existe registros con este rango de fechas.');
			$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
		}				
	}
	function buscador(area){
		if($.isNumeric($.trim($('#idtxtu').val()))){
			var cod = $('#idtxtu').val();
				var parm = 
				{
					"cod" : cod,
					"type" : area,
					"event": 'search'
				}
				$.ajax(
				{
					async:true,
					type: "POST",
					dataType:"html",
					contentType:"application/x-www-form-urlencoded",
					url:"inc/funct.php",
					data:parm,
					success:resultsearch,
					error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					},
					timeout:4000
				})
		}else{
			$('.pop_men p').html('Debe introducir el codigo a buscar \n'+'Ejemplo: 235416781');
			$('.emr_pop').css('display','block');
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
		}
	}
	function loader(){		
		$('.pop_men p').html('Espere un momento por favor, se esta procesando su solicitud.<br><img src="img/load.gif" alt="" width="40" height="40">');
		$('.emr_pop').css('display','block');
		$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
	}
	function proc(data){
		$('.pop_men p').html(data);
	}
	function error(){
		$('.pop_men p').html('Hubo un error en la conexion');
		$('.emr_pop').css('display','block');
		$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
		setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
	}
	function modwrite(datos){
		$('.pop_men p').html(datos);
	}
	function busquedadni(doc){
		var x = doc;
		if(x != 'empty'){
			var newx = x.split("--")
			if(newx.length > 1){
				var fc = newx[3].split("-")
				var newfc = fc[2]+'/'+fc[1]+'/'+fc[0];
				$('.txtname').val(newx[0]);$('.txtlastname').val(newx[1]);
				$('.txtaddres').val(newx[2]);$('.txtfn').val(newfc);
				$('.psasexo .menutitle').text(newx[5]);$('.txttel').val(newx[4]);
				$('.menunac .menutitle').text(newx[6]);$('.txtPais').val(newx[7]);
				$('.txtCiudad').val(newx[8]);if(newx[9].length == 0){$('.txtdist').prop('disabled', true);$('.txtdist').val(' ')}else{$('.txtdist').prop('disabled', false);$('.txtdist').val(newx[9]);}
				$('.txtn2').val(newx[10]);$('.txtln2').val(newx[11]);
				$('.txttel2').val(newx[12]);
			}	
		}
	}
	function clearpopup(){
		if($('.txtrucc').prop('disabled') == false){$('.txtrucc').val('')}
		$('.emer_popup input[type="text"]').each(function(index, element){if($(this).css('background-color') == 'rgb(255, 225, 225)'){$(this).css('background','none');}});
		$('.txtnomc').val('');$('.txtapec').val('');$('.txtcorc').val('');$('.txtdc').val('');$('.txttelc').val('');$('.txtuserc').val('');$('.txtcontc').val('');$('.menuplan .menutitle').text('Seleccionar Plan').css('color','#FFFFFF');$('.idpromot .menutitle').text('Seleccionar Plan').css('color','#FFFFFF');$('.txtdest').val('');$('.txtfecs').val('');$('.txtfecr').val('');$('.txtdoc').val('');$('.txtname').val('');$('.txtlastname').val('');$('.txtaddres').val('');$('.txtfn').val('');$('.txttel').val('');$('.psasexo .menutitle').text('Seleccionar').css('color','#FFFFFF');$('.menunac .menutitle').text('Seleccionar').css('color','#FFFFFF');$('.txtPais').val('');$('.txtCiudad').val('');$('.txtdist').val('');$('.bgday p').html('0');$('.bgPrecio p').html('0');
		if($('.bgincPre span').attr('class') == 'bgincPreon'){$('.bgincPre span').removeClass('bgincPreon');}
		$('.txtn2').val('');$('.txtln2').val('');$('.txttel2').val('');
	}
	function clearpopupv(){
		if($('.txtrucc').prop('disabled') == false){$('.txtrucc').val('')}
		$('.emer_popup input[type="text"]').each(function(index, element){if($(this).css('background-color') == 'rgb(255, 225, 225)'){$(this).css('background','none');}});
		$('.txtnomc').val('');$('.txtapec').val('');$('.txtcorc').val('');$('.txttelc').val('');$('.txtuserc').val('');$('.txtcontc').val('');
		$('.menuplan .menutitle').text('Seleccionar Plan').css('color','#FFFFFF');$('.idpromot .menutitle').text('Seleccionar Plan').css('color','#FFFFFF');$('.txtdest').val('');$('.txtfecs').val('');$('.txtfecr').val('');$('.txtdoc').val('');$('.txtname').val('');$('.txtlastname').val('');$('.txtaddres').val('');$('.txtfn').val('');$('.txttel').val('');$('.psasexo .menutitle').text('Seleccionar').css('color','#FFFFFF');$('.menunac .menutitle').text('Seleccionar').css('color','#FFFFFF');$('.txtPais').val('');$('.txtCiudad').val('');$('.txtdist').val('');$('.bgday p').html('0');$('.bgPrecio p').html('0');
		if($('.bgincPre span').attr('class') == 'bgincPreon'){$('.bgincPre span').removeClass('bgincPreon');}
		$('.txtn2').val('');$('.txtln2').val('');$('.txttel2').val('');
		location.reload();
	}
	
	// Función que suma o resta días a la fecha indicada
 
	sumaFecha = function(d, fecha)
	{
		 var Fecha = new Date();
		 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
		 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
		 var aFecha = sFecha.split(sep);
		 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
		 fecha= new Date(fecha);
		 fecha.setDate(fecha.getDate()+parseInt(d));
		 var anno=fecha.getFullYear();
		 var mes= fecha.getMonth()+1;
		 var dia= fecha.getDate();
		 mes = (mes < 10) ? ("0" + mes) : mes;
		 dia = (dia < 10) ? ("0" + dia) : dia;
		 var fechaFinal = dia+sep+mes+sep+anno;
		 return (fechaFinal);
	 }
	
	function cantdias()
	{
		//VERIFICAR NUMERO DE DIAS
		if($('.menuplan .menutitle').text() != 'Seleccionar Plan'){
			if($('.menuplan .menutitle').text() == 'VISA ANUAL 45' || $('.menuplan .menutitle').text() == 'VISA ANUAL 60' || $('.menuplan .menutitle').text() == 'VISA ANUAL 90' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 45' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 60' || $('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 90' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 45' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 60' || $('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 90')
			{
				var x = sumaFecha('364',$("#idfecs").val())
				$("#idfecr").val(x)
				if($("#idfecs").val() != '' && $("#idfecr").val() != '')
				{
					var d1 = $('#idfecs').val().split("/");
					var dat1 = new Date(d1[2], parseFloat(d1[1])-1, parseFloat(d1[0]));
					var d2 = $('#idfecr').val().split("/");
					var dat2 = new Date(d2[2], parseFloat(d2[1])-1, parseFloat(d2[0]));
					var dayNum = dat2.getTime() - dat1.getTime();
					dayAct = Math.floor(dayNum/(1000*60*60*24));
					if(dayAct >= 4)
					{
						$('.bgday p').text(dayAct+1);
						calcularprecio()
					}else{
						$('.bgday p').html('0')
						$('.bgPrecio p').html('0')
					}
				}
			}else{
				if($("#idfecs").val() != '' && $("#idfecr").val() != '')
				{
					var d1 = $('#idfecs').val().split("/");
					var dat1 = new Date(d1[2], parseFloat(d1[1])-1, parseFloat(d1[0]));
					var d2 = $('#idfecr').val().split("/");
					var dat2 = new Date(d2[2], parseFloat(d2[1])-1, parseFloat(d2[0]));
					var dayNum = dat2.getTime() - dat1.getTime();
					dayAct = Math.floor(dayNum/(1000*60*60*24));
					if(dayAct >= 4)
					{
						$('.bgday p').text(dayAct+1);
						calcularprecio()
					}else{
						$('.bgday p').html('0')
						$('.bgPrecio p').html('0')
					}
				}
			}
		}
	}
	
	function calcularprecio()
	{
		var dias = parseInt($('.bgday p').text())
		if($('.menuplan .menutitle').text() != 'Seleccionar Plan'){
			if($('.txtfecs').val() != '' || $('.txtfecr').val() != ''){
				if(dias >= 4){
					if($('.menuplan .menutitle').text() == 'VISA')
					{
						if(dias <= 92)
						{
							loadprice();
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'VISA ANUAL 45')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'VISA ANUAL 60')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'VISA ANUAL 90')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'UNIVERSAL')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 45')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 60')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'UNIVERSAL ANUAL 90')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TRAVELLER')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 45')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 60')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TRAVELLER ANUAL 90')
					{
						if(dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'STUDENT')
					{
						if(dias >= 120 && dias <= 365)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'PREMIER')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'NATIONAL')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'RECEPTIVE 3')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'RECEPTIVE 6')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TOP ONE')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TOP TWO')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'TOP THREE')
					{
						if(dias <= 92)
						{
							loadprice();	
						}else{
							error_();
						}
					}else if($('.menuplan .menutitle').text() == 'ADULTO MAYOR')
					{
						if(dias <= 60)
						{
							loadprice();	
						}else{
							error_();
						}
					}else{
						error_();
					}
					
				}else{
					$('.bgPrecio p').html('0')
				}
			}else{
				$('.bgPrecio p').html('0')
				$('.bgday p').html('0')
			}
		}		
	}
	
	function error_()
	{
		$('.pop_men p').html('La cantidad de días se encuentra fuera de rango para ver la lista de precios clic a: <br><a class="alinklinea" href="http://www.global-star.us/planes.php" target="_blank">http://www.global-star.us/planes.php</a>');
		$('.emr_pop').css('display','block');
		$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
		setTimeout(function(){$('.pop_men p').html('');$('.pop_men').animate({marginTop:'-200'},1000);$('.emr_pop').css('display','none')},6500)
		$('.bgday p').html('0');
		$('.bgPrecio p').html('0');
		$('.txtfecs').val('');
		$('.txtfecr').val('');
	}
	function loadprice(){
		var dias = parseInt($('.bgday p').text())
		$.ajax(
			{
			async:true,
			type: "POST",
			dataType:"html",
			contentType:"application/x-www-form-urlencoded",
			url:"inc/precioscot.php",
			data:"day="+dias+"&TipoP="+$.trim($('.menuplan .menutitle').text()),
			success:calprecdplan,
			timeout:4000
			}
		)
	}
	function denegar(){		
		$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');
	}
	function eliminar(){
		var cod = [];var x=0;
		$('.table_filas input:checkbox').each(function(index, element) {
            if($(this).prop('checked') == true){
				cod[x++] = $(this).prop('id')
			}
        });
		if(cod.length >= 1){
			var parm = 
			{
				"cod" : cod,
				"tipo" : $('#btn_delete').prop('class'),
				"event": 'delet'
			}
			$.ajax(
				{
				async:true,
				type: "POST",
				dataType:"html",
				contentType:"application/x-www-form-urlencoded",
				url:"inc/funct.php",
				data:parm,
				success:function(datos){
						$('.pop_men').animate({marginTop:'-160'},1000);
						setTimeout(function(){$('.pop_men p').html(datos);$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);},1100)
				},
				complete:function(){setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');location.reload();},6000);},
				error:function(e){
						$('.pop_men p').html('Hubo un error al conectar.');
						$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);}, 
				timeout:4000
			})
		}else{
			$('.pop_men p').html('Debe seleccionar 1 registro para eliminar.');
			$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
		}
		
	}
	function calprecdplan(datos){		
		$('.bgPrecio p').html(datos)
	}
	function compE(valor){
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		if(filter.test(valor))
			return true;
		else
			return false;
 	};
	
	function valvou(){
		var num_error=0;
		
		if($.trim($('.menuplan .menutitle').text()) == 'Seleccionar Plan' )	{
			$('.menuplan .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.menuplan .menutitle').css('color','#FFF')
		}
		if($.trim($('.psasexo .menutitle').text()) == 'Seleccionar' )	{
			$('.psasexo .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.psasexo .menutitle').css('color','#FFF')
		}
		if($.trim($('.psanac .menutitle').text()) == 'Seleccionar' )	{
			$('.psanac .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.psanac .menutitle').css('color','#FFF')
		}
		if($.trim($('.menusexo .menutitle').text()) == 'Seleccionar' ){
			$('.menusexo .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.menusexo .menutitle').css('color','#FFF')
		}
		if($.trim($('.menunac .menutitle').text()) == 'Seleccionar' ){
			$('.menunac .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.menunac .menutitle').css('color','#FFF')
		}
		if($.trim($('.idpromot .menutitle').text()) == 'Seleccionar' ){
			$('.idpromot .menutitle').css('color','#FFE1E1')
			num_error += 1;
		}else{
			$('.idpromot .menutitle').css('color','#FFF')
		}
		if($('.txtruca').length){
			if($('.txtruca').val() == ''){
				/*$('.txtruca').css('background','#FFE1E1')
				num_error += 1;	
				*/
				alert($('.txtruca').val());
			}else if(!$.isNumeric($.trim($('.txtruca').val()))){
				/*$('.txtruca').css('background','#FFE1E1')
				num_error += 1;
				*/
				alert($('.txtruca').val());
			}else{
				$('.txtruca').css('background','none')
			}
		}
		if($('.txtdc').length){
			if($.trim($('.txtdc').val()) == ''){
				$('.txtdc').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txtdc').val()))){
				$('.txtdc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtdc').css('background','none')
			}
		}
		if($('.txttela').length){
			if($.trim($('.txttela').val()) == ''){
				$('.txttela').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txttela').val()))){
				$('.txttela').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txttela').css('background','none')
			}
		}
		if($('.txtnoma').length){
			if($.trim($('.txtnoma').val()) == ''){
				$('.txtnoma').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtnoma').css('background','none')
			}
		}
		if($('.txtcora').length){
			if($.trim($('.txtcora').val()) == ''){
				$('.txtcora').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!compE($.trim($('.txtcora').val()))){
				$('.txtcora').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('.txtcora').css('background','none')
			}
		}		
		if($('.txtnamea').length){
			if($.trim($('.txtnamea').val()) == ''){
				$('.txtnamea').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtnamea').css('background','none')
			}
		}
		if($('.txtlastnamea').length){
			if($.trim($('.txtlastnamea').val()) == ''){
				$('.txtlastnamea').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtlastnamea').css('background','none')
			}
		}
		if($('.txtemaila').length){
			if($.trim($('.txtemaila').val()) == ''){
				$('.txtemaila').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!compE($.trim($('.txtemaila').val()))){
				$('.txtemaila').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('.txtemaila').css('background','none')
			}
		}	
		if($('.txtrucc').length){
			if($.trim($('.txtrucc').val()) == ''){
				$('.txtrucc').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txtrucc').val()))){
				$('.txtrucc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				if($('.txtrucc').prop('checked') == 'disabled'){
					$('.txtrucc').css('background','none')
				}
			}
		}
		if($('.txtnomc').length){
			if($.trim($('.txtnomc').val()) == ''){
				$('.txtnomc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtnomc').css('background','none')
			}
		}
		if($('.txtapec').length){
			if($.trim($('.txtapec').val()) == ''){
				$('.txtapec').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtapec').css('background','none')
			}
		}
		if($('.txttelc').length){
			if($.trim($('.txttelc').val()) == ''){
				$('.txttelc').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txttelc').val()))){
				$('.txttelc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txttelc').css('background','none')
			}
		}
		if($('.txtcorc').length){
			if($.trim($('.txtcorc').val()) == ''){
				$('.txtcorc').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!compE($.trim($('.txtcorc').val()))){
				$('.txtcorc').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('.txtcorc').css('background','none')
			}
		}
		if($('.txtuserc').length){
			if($.trim($('.txtuserc').val()) == ''){
				$('.txtuserc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtuserc').css('background','none')
			}
		}
		if($('.txtcontc').length){
			if($.trim($('.txtcontc').val()) == ''){
				$('.txtcontc').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtcontc').css('background','none')
			}
		}
		if($('.txtusera').length){
			if($.trim($('.txtusera').val()) == ''){
				$('.txtusera').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtusera').css('background','none')
			}
		}
		if($('.txtpassa').length){
			if($.trim($('.txtpassa').val()) == ''){
				$('.txtpassa').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtpassa').css('background','none')
			}
		}
		if($('.txtnamepl').length){
			if($.trim($('.txtnamepl').val()) == ''){
				$('.txtnamepl').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtnamepl').css('background','none')
			}
		}
		if($('.txtdaypl').length){
			if($.trim($('.txtdaypl').val()) == ''){
				$('.txtdaypl').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txtdaypl').val()))){
				$('.txtdaypl').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtdaypl').css('background','none')
			}
		}
		if($('.txtprpl').length){
			if($.trim($('.txtprpl').val()) == ''){
				$('.txtprpl').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txtprpl').val()))){
				$('.txtprpl').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtprpl').css('background','none')
			}
		}
		if($('.txtdest').length){
			if($.trim($('.txtdest').val()) == ''){
				$('.txtdest').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtdest').css('background','none')
			}
		}		
		if($('.txtfecs').length){
			if($.trim($('.txtfecs').val()) == ''){
				$('.txtfecs').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('.txtfecs').css('background','none')
			}
		}
		if($('.txtfecr').length){
			if($.trim($('.txtfecr').val()) == ''){
				$('.txtfecr').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtfecr').css('background','none')
			}
		}
		if($('.txtdoc').length){
			if($('.txtdoc').val().length > 4){
				if($.trim($('.txtdoc').val()) == ''){
					$('.txtdoc').css('background','#FFE1E1')
					num_error += 1;	
				}else{
					$('.txtdoc').css('background','none')
				}	
			}else{
				$('.txtdoc').css('background','#FFE1E1')
				num_error += 1;	
			}
		}
		if($('.txtname').length){
			if($.trim($('.txtname').val()) == ''){
				$('.txtname').css('background','#FFE1E1')
				num_error += 1;	
			}else if($.isNumeric($.trim($('.txtname').val()))){
				$('.txtname').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtname').css('background','none')
			}
		}
		if($('.txtlastname').length){
			if($.trim($('.txtlastname').val()) == ''){
				$('.txtlastname').css('background','#FFE1E1')
				num_error += 1;	
			}else if($.isNumeric($.trim($('.txtlastname').val()))){
				$('.txtlastname').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtlastname').css('background','none')
			}
		}
		if($('.txtaddres').length){
			if($.trim($('.txtaddres').val()) == ''){
				$('.txtaddres').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtaddres').css('background','none')
			}
		}
		if($('.txtfn').length){
			if($.trim($('.txtfn').val()) == ''){
				$('.txtfn').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtfn').css('background','none')
			}
		}
		if($('.txtemail').length){
			if($.trim($('.txtemail').val()) == ''){
				$('.txtemail').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!compE($.trim($('.txtemail').val()))){
				$('.txtemail').css('background','#FFE1E1')
				num_error += 1;
			}else{
				$('.txtemail').css('background','none')
			}
		}
		if($('.txttel').length){
			if($.trim($('.txttel').val()) == ''){
				$('.txttel').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txttel').val()))){
				$('.txttel').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txttel').css('background','none')
			}
		}
		if($('.txtmov').length){
			if($.trim($('.txtmov').val()).length > 0){
				if(!$.isNumeric($.trim($('.txtmov').val()))){
					$('.txtmov').css('background','#FFE1E1')
					num_error += 1;
				}else{
					$('.txtmov').css('background','none')
				}
			}else{
				$('.txtmov').css('background','none')
			}
		}
		if($('.txtcomia').length){
			if($.trim($('.txtcomia').val()).length > 0){
				if(!$.isNumeric($.trim($('.txtcomia').val()))){
					$('.txtcomia').css('background','#FFE1E1')
					num_error += 1;
				}else{
					$('.txtcomia').css('background','none')
				}
			}else{
				$('.txtcomia').css('background','none')
			}
		}
		if($('.txtcelc').length){
			if($.trim($('.txtcelc').val()).length > 0){
				if(!$.isNumeric($.trim($('.txtcelc').val()))){
					$('.txtcelc').css('background','#FFE1E1')
					num_error += 1;
				}else{
					$('.txtcelc').css('background','none')
				}
			}else{
				$('.txtcelc').css('background','none')
			}
		}		
		if($('.txtPais').length){
			if($.trim($('.txtPais').val()) == ''){
				$('.txtPais').css('background','#FFE1E1')
				num_error += 1;	
			}else if($.isNumeric($.trim($('.txtPais').val()))){
				$('.txtPais').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtPais').css('background','none')
			}
		}
		if($('.txtCiudad').length){
			if($.trim($('.txtCiudad').val()) == ''){
				$('.txtCiudad').css('background','#FFE1E1')
				num_error += 1;	
			}else if($.isNumeric($.trim($('.txtPais').val()))){
				$('.txtCiudad').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtCiudad').css('background','none')
			}
		}
		if($('.txtn2').length){
			if($.trim($('.txtn2').val()) == ''){
				$('.txtn2').css('background','#FFE1E1')
				num_error += 1;
			}else if($.isNumeric($.trim($('.txtn2').val()))){
				$('.txtn2').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtn2').css('background','none')
			}
		}
		if($('.txtln2').length){
			if($.trim($('.txtln2').val()) == ''){
				$('.txtln2').css('background','#FFE1E1')
				num_error += 1;	
			}else if($.isNumeric($.trim($('.txtln2').val()))){
				$('.txtln2').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txtln2').css('background','none')
			}
		}
		if($('.txttel2').length){
			if($.trim($('.txttel2').val()) == ''){
				$('.txttel2').css('background','#FFE1E1')
				num_error += 1;	
			}else if(!$.isNumeric($.trim($('.txttel2').val()))){
				$('.txttel2').css('background','#FFE1E1')
				num_error += 1;	
			}else{
				$('.txttel2').css('background','none')
			}
		}		
		return num_error;
	}
	
	function closepopup(){
		$('.emer_popup').css("display","none")
		clearpopupv();		
	}
	function vent_popup(){
		if($('#btn_newu a').attr('id') == 'newcounter'){
			$('.vent_title h2').html('Registrar nuevo Counter')
		}else if($('#btn_newu a').attr('id') == 'newpromotor'){
			$('.vent_title h2').html('Registrar nuevo Promotor')
		}else if($('#btn_newu a').attr('id') == 'newagen'){
			$('.vent_title h2').html('Registrar nueva Agencia')
		}else if($('#btn_newu a').attr('id') == 'newpasaj'){
			$('.vent_title h2').html('Registrar nuevo Pasajero')
		}
		$('.emer_popup').fadeIn("slow");
		$('.btn_1').css('display','block');
		$('.btn_2').css('display','none');
		$('.fec_mod').css('display','none');
		$('.fec_new').css('display','block');
	}
	function vent_popup2(){
		
		if($('#btn_mod a').attr('id') == 'modcounter'){
			$('.vent_title h2').html('Modificar Counter')
		}else if($('#btn_mod a').attr('id') == 'modpromotor'){
			$('.vent_title h2').html('Modificar Promotor')
		}else if($('#btn_mod a').attr('id') == 'modagen'){
			$('.vent_title h2').html('Modificar Agencia')
		}else if($('#btn_mod a').attr('id') == 'modpasaj'){
			$('.vent_title h2').html('Modificar Pasajero')
		}else if($('#btn_mod a').attr('id') == 'modvoucher'){
			$('.vent_title h2').html('Modificar Voucher')
		}
		var cod = [];var x=0;		
		$('.table_filas input:checkbox').each(function(index, element) {
            if($(this).prop('checked') == true){
				cod[x++] = $(this).prop('id')						
			}
        });
		$('.btn_1').css('display','none');
		$('.btn_2').css('display','block');
		$('.fec_mod').css('display','block');
		$('.fec_new').css('display','none');
		if(cod.length == 1){
			var parm = 
				{
				"cod" : cod,
				"type" : $('#btn_mod a').prop('id'),
				"event": 'loaddatos'
				}					
			$.ajax(
			{
				async:true,
				type: "POST",
				dataType:"html",
				contentType:"application/x-www-form-urlencoded",
				url:"inc/funct.php",
				data:parm,
				success:typemod,
				error:function(e){
						$('.pop_men p').html('Hubo un error en la conexion');
						$('.emr_pop').css('display','block');
						$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
						setTimeout(function(e){$('.emr_pop').css('display','none');$('.pop_men p').html('');},3000);
					}, 
				timeout:4000
			})
			
		}else if(cod.length > 1){
			$('.pop_men p').html('Seleccione 1 código para modificar.');
			$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
		}else{
			$('.pop_men p').html('Debe seleccionar 1 código para modificar');
			$('.emr_pop').css('background','rgba(0,0,0,0.5)').fadeIn("slow");
			$('.pop_men').animate({marginTop:'50'},1000).animate({marginTop:'10'},500);
			setTimeout(function(e){$('.emr_pop').css({'display':'none','background':'none'});$('.pop_men p').html('');},3000);
		}
	}
	function typemod(datos){
		var x = datos;
		var newx = x.split("--")	
		if(newx.length > 1){
			if(newx[0] == 'pro'){
				$('.txtname').val(newx[1]);				
				$('.txtlastname').val(newx[2]);
				$('.txtemail').val(newx[3]);
				$('.txttel').val(newx[4]);
				$('.fec_mod').text(newx[6])
				if(newx[5] == 1){
					$('.txthbonp').attr('class','txthbonp')
				}else{
					$('.txthbonp').attr('class','txthboffp')
				}				
				$('.emer_popup').fadeIn("slow");
			}else if(newx[0] == 'pla'){
				var dato = datos.split("/");
				var plan = dato[0].split("--");
				var pre = dato[1].split("--");
				var day = dato[2].split("--")
				$('.txtnamepl').val(plan[1]);
				$('.txtdad').val(plan[2]);
				$('.fec_mod').text(plan[4])
				if(plan[3] == 1){
					$('.txthbonp').attr('class','txthbonp')
				}else{
					$('.txthbonp').attr('class','txthboffp')
				}
				$('.contplanes').html('');
				for(var cd = 0; cd < pre.length-1;cd++){					
					$('.contplanes').append('<div class="newfila"> <div class="caja_daypl"> <div class="tam"> <p>Nº de días</p> <input type="text" name="txthb" class="txtdaypl" value="'+day[cd]+'"> </div> </div> <div class="caja_prpl"> <div class="tam"> <p>Precio</p> <input type="text" name="txthb" class="txtprpl" value="'+pre[cd]+'"> </div> </div> </div>');					
				}
				$('.emer_popup').fadeIn("slow");
			}else if(newx[0] == 'agen'){
				var name = newx[2].split(" ");
				var lname = newx[3].split(" ");
				var namepromo = name[0]+' '+lname[0];
				$('.txtruca').prop('disabled', true)
				$('.idpromot .menutitle').attr("id",newx[1]);
				$('.idpromot .menutitle').text(name[0]+' '+lname[0]);
				$('.idpromot li ul li').each(function(index, element) {
					if($(this).text() == namepromo){
						$(this).addClass('submenuon');
					}
                })
				$('.txtruca').val(newx[4])
				$('.txtnoma').val(newx[5])
				$('.txtcora').val(newx[6])
				$('.txttela').val(newx[7])
				$('.txtcomia').val(newx[8])
				$('.txtdira').val(newx[9])
				if(newx[10] == 1){
					$('.txthbonp').attr('class','txthbonp')
				}else{
					$('.txthbonp').attr('class','txthboffp')
				}
				$('.txtnamea').val(newx[12])
				$('.txtlastnamea').val(newx[13])
				$('.txtemaila').val(newx[14])
				$('.txtusera').val(newx[15])
				$('.txtpassa').val(newx[16])
				$('.fec_mod').text(newx[11])
				$('.emer_popup').fadeIn("slow");
			}else if(newx[0] == 'cou'){
				$('.txtrucc').val(newx[1])
				$('.txtnomc').val(newx[2])
				$('.txtapec').val(newx[3])
				$('.txttelc').val(newx[4])
				$('.txtcorc').val(newx[5])
				$('.txtuserc').val(newx[6])
				$('.txtcontc').val(newx[7])
				if(newx[8] == 1){
					$('.txthbonp').attr('class','txthbonp')
				}else{
					$('.txthbonp').attr('class','txthboffp')
				}
				$('.fec_mod').text(newx[9])
				$('.emer_popup').fadeIn("slow");
			}else if(newx[0] == 'pasj'){
				$('.txtdc').val(newx[1])
				$('.txtname').val(newx[2])
				$('.txtlastname').val(newx[3])
				$('.txtaddres').val(newx[4])
				$('.txtfn').val(newx[5])
				$('.psasexo li ul li').each(function(index, element) {
					if($(this).text() == newx[6]){
						$(this).addClass('submenuon');
					}
                });
				$('.psasexo .menutitle').text(newx[6])
				$('.txtemail').val(newx[7])
				$('.txttel').val(newx[8])
				$('.txtmov').val(newx[9])
				$('.psanac li ul li').each(function(index, element) {
					if($(this).text() == newx[10]){
						$(this).addClass('submenuon');
					}
                });
				$('.psanac .menutitle').text(newx[10])
				$('.txtPais').val(newx[11])
				$('.txtCiudad').val(newx[12])
				$('.txtdist').val(newx[13])
				$('.txtn2').val(newx[14])
				$('.txtln2').val(newx[15])
				$('.txttel2').val(newx[16])
				$('.fec_mod').text(newx[17])
				$('.emer_popup').fadeIn("slow");
			}else if(newx[0] == 'vouch'){			
				$('.menuplan .menutitle').text(newx[1])
				$('.menuplan li ul li').each(function(index, element) {
					if($(this).text() == newx[1]){
						$(this).addClass('submenuon');
					}
                })
				$('.txtdest').val(newx[2])
				$('.txtfecs').val(newx[3])
				$('.txtfecr').val(newx[4])
				$('.bgPrecio p').text(newx[17])
				$('.bgday p').text(newx[16])
				if(newx[18] == 1){
					$('.bgincPre span').addClass('bgincPreon');
				}else{
					$('.bgincPre span').removeClass('bgincPreon');
				}
				$('.txtdoc').val(newx[5])
				$('.txtname').val(newx[6])
				$('.txtlastname').val(newx[7])
				$('.txtaddres').val(newx[8])
				$('.txtfn').val(newx[9])
				$('.psasexo .menutitle').text(newx[11])
				$('.psasexo li ul li').each(function(index, element) {
					if($(this).text() == newx[11]){
						$(this).addClass('submenuon');
					}
                });			
				$('.txttel').val(newx[10])
				$('.menunac .menutitle').text(newx[12])
				$('.menunac li ul li').each(function(index, element) {
					if($(this).text() == newx[12]){
						$(this).addClass('submenuon');
					}
                });				
				$('.txtPais').val(newx[13])
				$('.txtCiudad').val(newx[14])
				$('.txtdist').val(newx[15])
				$('.txtn2').val(newx[19])
				$('.txtln2').val(newx[20])
				$('.txttel2').val(newx[21])				
				$('.fec_mod').text(newx[22])				
				$('.emer_popup').fadeIn("slow");
			}
		}
	}
	