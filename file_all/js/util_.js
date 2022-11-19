// JavaScript Document

var ini = $(document);



	ini.ready(iniciar)

	

	function iniciar(){

		$('#recover_pass').click(function(e){

			$('.Login').animate({marginLeft:'-401px'},1500);

			$('.email_pass').animate({marginLeft:'0px'},1500);

		})

		$('#btnvolver').click(function(e){

			$('.Login').animate({marginLeft:'0px'},1500);

			$('.email_pass').animate({marginLeft:'401px'},1500);

		})

		$('#bntch').click(function(e){

			if($('input[name="newclave"]').val() == ""){

				$('.clsalert p').html('Debe ingresar su nueva clave');

				$('.clsalert').fadeIn('slow');

				setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

			}else{

				if($('input[name="newclave"]').val().length < 5){

					$('.clsalert p').html('La clave debe ser mayor a 5 dígitos');

					$('.clsalert').fadeIn('slow');

					setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

				}else{

					if($('input[name="newclave"]').val() != $('input[name="rclave"]').val()){

						$('.clsalert p').html('La claves ingresadas no coinciden, verifique e intente nuevamente.');

						$('.clsalert').fadeIn('slow');

						setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

					}else{

						var parm = 

							{

								"newclave" : $('input[name="newclave"]').val(),

								"rclave" : $('input[name="rclave"]').val(),

							}

						$.ajax(

						{

							async:true,

							type: "POST",

							dataType:"html",

							contentType:"application/x-www-form-urlencoded",

							url:  $("#idrecover").attr('action'),

							data:parm,

							beforeSend: function(e){

								$('.clsalert p').html('Estamos cambiado su nueva clave, espere un momento por favor');

								$('.clsalert').fadeIn('slow');

							},

							success:function(datos){

								if(datos != "Se cambio correctamente su clave, por favor ingrese nuevamente con su nueva clave."){

									setTimeout(function(){$('.clsalert p').html(datos);},4000)

									setTimeout(function(){$('.clsalert').fadeOut('slow');},7000);

								}else{

									setTimeout(function(){$('.clsalert p').html(datos);},4000)

									setTimeout(function(){$('.clsalert').fadeOut('slow');},7000);

									setTimeout(function(){window.location.href = '/pruebas/global/sistema/panel/';},8000)

								}

								

							},

							error:function(e){

								$('.clsalert p').html('Hubo un error en la conexion');

								$('.clsalert').fadeIn('slow');

								setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

						},

							timeout:4000

						})

					}

				}

			}

		})

		$('#bntEntrar').click(function(e){	

			if($('#InpRuc').val() == ""){

				$('.clsalert p').html('Debe ingresar el n\u00f3mero de ruc de la agencia');

				$('.clsalert').fadeIn('slow');

				setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

			}else{

				if(!$.isNumeric($('#InpRuc').val())){

					$('.clsalert p').html('El n\u00f3mero de ruc es incorrecto');

					$('.clsalert').fadeIn('slow');

					setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

				}else{

					if($('#InpRuc').val().length < 10){

						$('.clsalert p').html('El n\u00f3mero debe es mayor a 10 dígitos');

						$('.clsalert').fadeIn('slow');

						setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

					}else{

						if($('#InpUser').val() == ""){

							$('.clsalert p').html('Debe ingresar su usuario');

							$('.clsalert').fadeIn('slow');

							setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

						}else{

							if($('#InpPass').val() == ""){

								$('.clsalert p').html('Debe ingresar su clave');

								$('.clsalert').fadeIn('slow');

								setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

							}else{

								var m = {

									  "ruc" : $('#InpRuc').val(),

									  "user_" : $('#InpUser').val(),

									  "tpas" : $('#InpPass').val()

									  };

								  $.ajax(

								  {

									  url: "/pruebas/global/sistema/panel/login",

									  async: true,

									  type: "POST",

									  dataType: "html",

									  data: m,

									beforeSend: function(e){

										$('.clsalert p').html('Estamos verificando su acceso, espere un momento por favor');

										$('.clsalert').fadeIn('slow');

									},

									success:function(datos){

										if(datos != 'si'){

											setTimeout(function(){$('.clsalert p').html(datos);},4000)											

										}else{

											window.location.href = '/pruebas/global/sistema/panel/';	

										}

									},

									complete:function(e){setTimeout(function(){$('.clsalert').fadeOut('slow');},7000)},

									error:function(e){

										$('.clsalert p').html('Hubo un error en la conexion');

										$('.clsalert').fadeIn('slow');

										setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

								},

									timeout:4000

								})

							}

						}

					}

				}

			}

			

		})

		$('#InpPass').keypress(function(event){

			var keycode = (event.keyCode ? event.keyCode : event.which);

			if(keycode == '13'){  

				if($('#InpRuc').val() == ""){

					$('.clsalert p').html('Debe ingresar el n\u00f3mero de ruc de la agencia');

					$('.clsalert').fadeIn('slow');

					setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

				}else{

					if(!$.isNumeric($('#InpRuc').val())){

						$('.clsalert p').html('El n\u00f3mero de ruc es incorrecto');

						$('.clsalert').fadeIn('slow');

						setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

					}else{

						if($('#InpRuc').val().length < 10){

							$('.clsalert p').html('El n\u00f3mero debe es mayor a 10 dígitos');

							$('.clsalert').fadeIn('slow');

							setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

						}else{

							if($('#InpUser').val() == ""){

								$('.clsalert p').html('Debe ingresar su usuario');

								$('.clsalert').fadeIn('slow');

								setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

							}else{

								if($('#InpPass').val() == ""){

									$('.clsalert p').html('Debe ingresar su clave');

									$('.clsalert').fadeIn('slow');

									setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

								}else{

									var m = {

										"ruc" : $('#InpRuc').val(),

										"user_" : $('#InpUser').val(),

										"tpas" : $('#InpPass').val()

										};

									$.ajax(

									{

										url: "/pruebas/global/sistema/panel/login",

										async: true,

										type: "POST",

										dataType: "html",

										data: m,

										beforeSend: function(){

											$('.clsalert p').html('Estamos verificando su acceso, espere un momento por favor');

											$('.clsalert').fadeIn('slow');

										},

										success:function(datos){

											if(datos != "si"){

												setTimeout(function(){$('.clsalert p').html(datos);},4000)											

											}else{

												window.location.href = '/pruebas/global/sistema/panel/';	

											}

										},

										complete:function(e){setTimeout(function(){$('.clsalert').fadeOut('slow');},7000)},

										error:function(e){

											$('.clsalert p').html('Hubo un error en la conexion ');

											$('.clsalert').fadeIn('slow');

											setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

									},

										timeout:4000

									})

								}

							}

						}

					}

				}

			}

			

			

		})

		$('#bntRecoverpass').click(function(e){

			if($('#InpRuco').val() == ""){

				$('.clsalert p').html('Debe ingresar el n\u00f3mero de ruc de la agencia');

				$('.clsalert').fadeIn('slow');

				setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

			}else{

				if(!$.isNumeric($('#InpRuco').val())){

					$('.clsalert p').html('El n\u00f3mero de ruc es incorrecto');

					$('.clsalert').fadeIn('slow');

					setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

				}else{

					if($('#InpRuco').val().length < 10){

						$('.clsalert p').html('El n\u00f3mero debe es mayor a 10 dígitos');

						$('.clsalert').fadeIn('slow');

						setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

					}else{

						if($('#rec_user').val() == ""){

							$('.clsalert p').html('Debe ingresar su usuario');

							$('.clsalert').fadeIn('slow');

							setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

						}else{

							var parm = 

								{

									"ruc" : $('#InpRuco').val(),

									"usuario" : $('#rec_user').val(),

								}

							$.ajax(

							{

								async:true,

								type: "POST",

								dataType:"html",

								contentType:"application/x-www-form-urlencoded",

								url:"/pruebas/global/sistema/panel/recover/",

								data:parm,

								beforeSend: function(e){

									$('.clsalert p').html('Estamos verificando su cuenta, espere un momento por favor');

									$('.clsalert').fadeIn('slow');

								},

								success:function(datos){

									setTimeout(function(){$('.clsalert p').html(datos);},4000)

								},

								complete:function(e){setTimeout(function(){$('.clsalert').fadeOut('slow');},7000)},

								error:function(e){

									$('.clsalert p').html('Hubo un error en la conexion');

									$('.clsalert').fadeIn('slow');

									setTimeout(function(){$('.clsalert').fadeOut('slow');},3000)

							},

								timeout:4000

							})

						}

					}

				}

			}

			

		})

	}