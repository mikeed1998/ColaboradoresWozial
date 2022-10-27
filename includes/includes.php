<?php
/* %%%%%%%%%%%%%%%%%%%% MENSAJES               */
	if($mensaje!=''){
		$mensajes='
			<div class="uk-container">
				<div uk-grid>
					<div class="uk-width-1-1 margin-v-20">
						<div class="uk-alert-'.$mensajeClase.'" uk-alert>
							<a class="uk-alert-close" uk-close></a>
							'.$mensaje.'
						</div>					
					</div>
				</div>
			</div>';
	}

/* %%%%%%%%%%%%%%%%%%%% RUTAS AMIGABLES        */
		$rutaInicio			=	'Inicio';
		$rutaPedido			=	$ruta.'revisar_orden';
		$rutaPedido2		=	$ruta.'revisar_datos_personales';

/* %%%%%%%%%%%%%%%%%%%% MENU                   */
	$menu='
		<li class="'.$nav1.'"><a class="spinnershot" href="'.$rutaInicio.'">Inicio</a></li>
		';

	$menuMovil='
		<li><a class="spinnershot '.$nav1.'" href="'.$ruta.'">Inicio</a></li>
		';

/* %%%%%%%%%%%%%%%%%%%% HEADER                 */
	$header='
		<div class="uk-offcanvas-content uk-position-relative">

			<header>
				<div class="menu-barra" uk-sticky>
					<div class="uk-container">
						<div uk-grid class="uk-grid-match">

							<!-- Menú logo -->
							<div class="uk-width-auto">
								<div class="uk-navbar-container uk-navbar-transparent">
									<img src="img/design/APF_LOGO.png" alt="" style="max-height: 50px;">
								</div>
							</div>

							<!-- Menú escritorio -->
							<div class="uk-width-expand">
								<div class="uk-flex uk-flex-middle uk-flex-right">
									<a href="'.$rutaInicio.'">
										<img src="img/design/home.png" alt="" style="max-height: 30px;">
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</header>

			'.$mensajes.'

			<!-- Menú móviles -->
			<div id="menu-movil" uk-offcanvas="mode: push;overlay: true">
				<div class="uk-offcanvas-bar uk-flex uk-flex-column">
					<button class="uk-offcanvas-close" type="button" uk-close></button>
					<ul class="uk-nav uk-nav-primary uk-nav-parent-icon uk-nav-center uk-margin-auto-vertical" uk-nav>
						'.$menuMovil.'
					</ul>
				</div>
			</div>';

/* %%%%%%%%%%%%%%%%%%%% FOOTER                 */
	$footer = '</div>';

/* %%%%%%%%%%%%%%%%%%%% HEAD GENERAL                */
	$headGNRL='
		<html lang="'.$languaje.'">
		<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">

			<meta charset="utf-8">
			<title>'.$title.'</title>
			<meta name="description" content="'.$description.'" />
			<meta property="fb:app_id" content="'.$appID.'" />
			<link rel="image_src" href="'.$ruta.$logoOg.'" />

			<meta property="og:type" content="website" />
			<meta property="og:title" content="'.$title.'" />
			<meta property="og:description" content="'.$description.'" />
			<meta property="og:url" content="'.$rutaEstaPagina.'" />
			<meta property="og:image" content="'.$ruta.$logoOg.'" />

			<meta itemprop="name" content="'.$title.'" />
			<meta itemprop="description" content="'.$description.'" />
			<meta itemprop="url" content="'.$rutaEstaPagina.'" />
			<meta itemprop="thumbnailUrl" content="'.$ruta.$logoOg.'" />
			<meta itemprop="image" content="'.$ruta.$logoOg.'" />

			<meta name="twitter:title" content="'.$title.'" />
			<meta name="twitter:description" content="'.$description.'" />
			<meta name="twitter:url" content="'.$rutaEstaPagina.'" />
			<meta name="twitter:image" content="'.$ruta.$logoOg.'" />
			<meta name="twitter:card" content="summary" />

			<meta name="viewport"       content="width=device-width, initial-scale=1">

			<link rel="icon"            href="'.$ruta.'img/design/APF_LOGO.png" type="image/x-icon">
			<link rel="shortcut icon"   href="img/design/APF_LOGO.png" type="image/x-icon">
			<link rel="stylesheet"      href="https://cdn.jsdelivr.net/npm/uikit@'.$uikitVersion.'/dist/css/uikit.min.css" />
			<link rel="stylesheet" 		href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
			<link rel="stylesheet/less" href="css/general.less" >
			<link rel="stylesheet"      href="https://fonts.googleapis.com/css?family=Lato:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
			<link rel="stylesheet"		href="https://fonts.googleapis.com/css?family=Nunito:200i,400,600,800&display=swap">
			
			<!-- jQuery is required -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

			<!-- UIkit JS -->
			<script src="https://cdn.jsdelivr.net/npm/uikit@'.$uikitVersion.'/dist/js/uikit.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/uikit@'.$uikitVersion.'/dist/js/uikit-icons.min.js"></script>

			<!-- Font Awesome -->
			<script src="https://kit.fontawesome.com/910783a909.js" crossorigin="anonymous"></script>

			<!-- Less -->
			<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
		</head>';

/* %%%%%%%%%%%%%%%%%%%% SCRIPTS                */
	$scriptGNRL='
		<script src="js/general.js"></script>

		<script>
	     	$(window).scroll(function() {
	     		var top = $(window).scrollTop();
	     		console.log(top);
	        	if ($(window).scrollTop() > 5) {
	            	$(".menu-barra").addClass("shadow-header");
	        	}else {
	            	$(".menu-barra").removeClass("shadow-header");
	        	}
	      	});
		</script>

		<script>
			$(".cantidad").keyup(function() {
				var inventario = $(this).attr("data-inventario");
				var cantidad = $(this).val();
				inventario=1*inventario;
				cantidad=1*cantidad;
				if(inventario<=cantidad){
					$(this).val(inventario);
				}
				console.log(inventario+" - "+cantidad);
			})
			$(".cantidad").focusout(function() {
				var inventario = $(this).attr("data-inventario");
				var cantidad = $(this).val();
				inventario=1*inventario;
				cantidad=1*cantidad;
				if(inventario<=cantidad){
					//console.log(inventario*2+" - "+cantidad);
					$(this).val(inventario);
				}
			})

			// Agregar al carro
			$(".buybutton").click(function(){
				var id=$(this).data("id");
				var cantidad=$("#"+id).val();

				$.ajax({
					method: "POST",
					url: "addtocart",
					data: { 
						id: id,
						cantidad: cantidad,
						addtocart: 1
					}
				})
				.done(function( msg ) {
					datos = JSON.parse(msg);
					UIkit.notification.closeAll();
					UIkit.notification(datos.msg);
					$("#cartcount").html(datos.count);
					$("#cotizacion-fixed").removeClass("uk-hidden");
				});
			})
		</script>
		';

	// Script login Facebook
	$scriptGNRL.=(!isset($_SESSION['uid']) AND $dominio != 'localhost' AND isset($facebookLogin))?'
		<script>
			// Esta es la llamada a facebook FB.getLoginStatus()
			function statusChangeCallback(response) {
				if (response.status === "connected") {
					procesarLogin();
				} else {
					console.log("No se pudo identificar");
				}
			}

			// Verificar el estatus del login
			function checkLoginState() {
				FB.getLoginStatus(function(response) {
					statusChangeCallback(response);
				});
			}

			// Definir características de nuestra app
			window.fbAsyncInit = function() {
				FB.init({
					appId      : "'.$appID.'",
					xfbml      : true,
					version    : "v3.2"
				});
				FB.AppEvents.logPageView();
			};

			// Ejecutar el script
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/es_LA/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, \'script\', \'facebook-jssdk\'));
			
			// Procesar Login
			function procesarLogin() {
				FB.api(\'/me?fields=id,name,email\', function(response) {
					console.log(response);
					$.ajax({
						method: "POST",
						url: "includes/acciones.php",
						data: { 
							facebooklogin: 1,
							nombre: response.name,
							email: response.email,
							id: response.id
						}
					})
					.done(function( response ) {
						console.log( response );
						datos = JSON.parse( response );
						UIkit.notification.closeAll();
						UIkit.notification(datos.msj);
						if(datos.estatus==0){
							location.reload();
						}
					});
				});
			}
		</script>

		':'';


// Reportar actividad
	$scriptGNRL.=(!isset($_SESSION['uid']))?'':'
		<script>
			var w;
			function startWorker() {
			  if(typeof(Worker) !== "undefined") {
			    if(typeof(w) == "undefined") {
			      w = new Worker("js/activityClientFront.js");
			    }
			    w.onmessage = function(event) {
					//console.log(event.data);
			    };
			  } else {
			    document.getElementById("result").innerHTML = "Por favor, utiliza un navegador moderno";
			  }
			}
			startWorker();
		</script>
		';

/* %%%%%%%%%%%%%%%%%%%% BUSQUEDA               */
	$scriptGNRL.='
		<script>
			$(document).ready(function(){
				$(".search").keyup(function(e){
					if(e.which==13){
						var consulta=$(this).val();
						var l = consulta.length;
						if(l>2){
							window.location = ("'.$ruta.'"+consulta+"_gdl");
						}else{
							UIkit.notification.closeAll();
							UIkit.notification("<div class=\'bg-danger color-blanco\'>Se requiren al menos 3 caracteres</div>");
						}
					}
				});
				$(".search-button").click(function(){
					var consulta=$(".search-bar-input").val();
					var l = consulta.length;
					if(l>2){
						window.location = ("'.$ruta.'"+consulta+"_gdl");
					}else{
						UIkit.notification.closeAll();
						UIkit.notification("<div class=\'bg-danger color-blanco\'>Se requiren al menos 3 caracteres</div>");
					}
				});
			});
		</script>';

/* %%%%%%%%%%%%%%%%%%%% WHATSAPP PLUGIN               */
	$scriptGNRL.=(isset($_SESSION['whatsappHiden']))?'':'
		<script>
			setTimeout(function(){
				$("#whatsapp-plugin").addClass("uk-animation-slide-bottom-small");
				$("#whatsapp-plugin").removeClass("uk-hidden");
			},1000);
			setTimeout(function(){
				$("#whats-body-1").addClass("uk-hidden");
				$("#whats-body-2").removeClass("uk-hidden");
			},6000);
		</script>
			';

	$scriptGNRL.='
		<script>
			$("#whats-close").click(function(){
				$("#whatsapp-plugin").addClass("uk-hidden");
				$("#whats-show").removeClass("uk-hidden");
				$.ajax({
					method: "POST",
					url: "includes/acciones.php",
					data: { 
						whatsappHiden: 1
					}
				})
				.done(function( msg ) {
					console.log(msg);
				});
			});
			$("#whats-show").click(function(){
				$("#whatsapp-plugin").removeClass("uk-hidden");
				$("#whats-show").addClass("uk-hidden");
				$("#whats-body-1").addClass("uk-hidden");
				$("#whats-body-2").removeClass("uk-hidden");
				$.ajax({
					method: "POST",
					url: "includes/acciones.php",
					data: { 
						whatsappShow: 1
					}
				})
				.done(function( msg ) {
					console.log(msg);
				});
			});
		</script>';

		$scriptGNRL.='
		<script>
		$(document).ready(function(){
			load_data();
			function load_data(query)
			{
				$.ajax({
					url:"fetch.php",
					method:"post",
					data:{query:query},
					success:function(data)
					{
						$("#result").html(data);
					}
				});
			}
			
			$("#search_text").keyup(function(){
				var search = $(this).val();
				if(search != "")
				{
					load_data(search);
				}
				else
				{
					load_data();			
				}
			});
		});
		</script>
		';


