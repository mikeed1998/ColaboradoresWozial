<!DOCTYPE html>
<?=$headGNRL?>
<body>
  
<?=$header?>

<div class="uk-container" style="min-height: 80vh;">
	

	<div uk-grid class="detalle-padding">
		<div class="uk-width-auto@s barra-lateral animated fadeInLeft">
			<div class="uk-flex uk-flex-center">
				<div class="uk-width-auto uk-position-relative">
	                <div class="imagen-circular animated rollIn">
	                    <img src="img/contenido/productos/<?=$imagen?>" alt="" uk-cover>
	                </div>
            	</div>
			</div>
			<div class="padding-top-50" style="letter-spacing: 0px;">
				<div class="color-rojo uk-text-center uk-text-uppercase" style="font-weight: 200;">
					<?=$empresa?>
				</div>
				<div class="uk-flex uk-flex-center padding-top-20">
					<a href="https://wa.me/521<?=$telefonoW?>?text=Hola%20vi%20tu%20post%20en%20eshot">
						<div class="boton-ayuda transicion">
							Yo te puedo ayudar
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="uk-width-expand@s animated fadeInRight">
			<div uk-grid>
				<div class="uk-width-expand servicios-paquetes uk-text-left">
					<?=$titulo?>
				</div>
				<div class="uk-width-auto uk-flex uk-flex-bottom">
					<div class="uk-flex uk-flex-middle">
						<a href="<?=$facebook?>"><?=$url?></a>&nbsp;&nbsp;&nbsp; <a href="<?=$facebook?>" class="facebook" uk-icon="icon: facebook; ratio: 1"></a> &nbsp;<a href="<?=$instagram?>" class="instagram" uk-icon="icon: instagram; ratio: 1"></a>&nbsp;&nbsp;
					</div>
				</div>
				<div class="uk-width-1-1" style="margin-top: 10px;">
					<div style="background: #F4E047; height: 2px;">
						
					</div>
				</div>
			</div>
			<div class="padding-top-30">
				<?=$txt?>
			</div>
			<?php
			if ($numPics>0) { 
			 ?>

			<div class="padding-top-20">
				<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

				    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
				    <?php 
				    	$consultaPIC = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden");
						$numPics=$consultaPIC->num_rows;
						while ( $row_consultaPIC = $consultaPIC -> fetch_assoc() ) {
							$picOgRuta='img/contenido/productos/';
							$picOg=$picOgRuta.$row_consultaPIC['id'].'.jpg';
						echo '

				         <li>
				            <div class="uk-panel">
				                <img src="'.$picOg.'" alt="">
				            </div>
				        </li>';
						}

				    ?>
				    </ul>

				    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
				    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

				</div>
			</div>
			<?php
			} 
			 ?>
		</div>
	</div>
</div>



<div class="bg-gris">
	<div class="uk-container padding-v-100">
		<div class="servicios-paquetes uk-text-uppercase">
			PROYECTOS RELACIOADOS
		</div>
		<div class="uk-flex uk-flex-center">
			<div class="linea-chica-morada"></div>
		</div>
		<div uk-slider>
            <div class="uk-position-relative">
                <div class="uk-slider-container">
					<ul class="uk-slider-items  uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid">
						<?php 
						$CONSULTA = $CONEXION -> query("SELECT * FROM productos WHERE servicio = $idServicio AND id != $id ORDER BY rand() LIMIT 5");
						while ($rowCONSULTA = $CONSULTA -> fetch_assoc()) {
						$imagen = $pic.$rowCONSULTA['imagen'];
						echo '
						<li>
						    <div uk-grid class="uk-grid-collapse padding-top-100">
				                <div class="uk-width-expand bg-white uk-text-center padding-top-20">
				                    <img src="img/design/rayo.png" alt="" style="height: 30px;">
				                </div>
				                <div class="uk-width-auto uk-position-relative">
				                    <img src="img/design/testimonios-circulo.png" style="width: 150px;" alt="">
				                    <div class="uk-position-top-center" style="top:-65px; background: white; border-radius: 50%; height: 124px; width: 124px; overflow: hidden;">
				                        <img src="img/contenido/productos/'.$rowCONSULTA['imagen'].'" alt="" uk-cover>
				                    </div>
				                </div>
				                    <div class="uk-width-expand bg-white uk-text-center padding-top-20">
				                      <img src="img/design/rayo.png" alt="" style="height: 30px;">
				                 	</div>
				                </div>
				                <div class="bg-white testimonios-card">
				                  	<div class="testimonios-nombre">
				                    	'.$rowCONSULTA['titulo'].'
				                  	</div>
				                  	<div class="testimonios-ramo uk-text-uppercase">
				                    	'.$rowCONSULTA['empresa'].'
				                  	</div>
				                  	<div class="testimonios-texto">
				                  		'.wordlimit($rowCONSULTA['txt'] ,'20','...').'
				                  	</div>
				                  	<div uk-grid class="padding-bottom-10 padding-top-20">
				                    	<div class="uk-width-expand uk-text-left">
				                      	<a target="_blank" href="https://wa.me/521'.$whatsapp.'?text=Me%20gustaría%20saber%20..." class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:whatsapp; ratio: .8"></a> &nbsp;
				                      	<a target="_blank" href="'.$rowCONSULTA['facebook'].'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:facebook; ratio: .8"></a> &nbsp;
				                      	<a target="_blank" href="'.$rowCONSULTA['instagram'].'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:instagram; ratio: .8"></a>
				                    </div>
				                    <div class="uk-width-auto testimonios-proyectos uk-flex uk-flex-middle">
				                      <a href="'.$link.'">
				                        Ver más <span class="color-negro" uk-icon="icon: arrow-right; ratio: .8"></span>
				                      </a>
				                    </div>
				                </div>
				            </div>
				        </li>';
					    } ?>
					</ul>

                </div>

                <div class="uk-hidden@s">
                    <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>

                <div class="uk-visible@s uk-light">
                    <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>

          	</div>
		</div>
	</div>
</div>

<div class="uk-container padding-v-50" id="footer">
	<div uk-grid>
		<div class="uk-width-auto@s uk-flex uk-flex-middle uk-flex-center wozial-logo">
			<!--
			<a href="wozial.com">
				<img src="img/design/logo-wozial.png" alt="" style="max-height: 80px;">
			</a>
			//-->
		</div>
		<div class="uk-width-expand@s uk-flex uk-flex-middle uk-flex-center">
			<!--
			<div class="uk-text-center">
				<a href="" class="typewrite footer-texto" data-period="2000" data-type='[ "Todos somos una familia" , "Y queremos apoyarnos" , "Eshot.mx", "Wozial.com", "Brincolinesbambinos.com",":)" ]'>
					<span class="wrap"></span>
				</a>
			</div>
			//-->
		</div>
		<div class="uk-width-auto@s uk-flex uk-flex-middle uk-flex-center">
			<a href="Brincolinesbambinos.com">
				<img src="img/design/logobambinos.png" alt="" style="max-height: 60px;">
			</a>
		</div>
	</div>
</div>


<?=$footer?>

<?=$scriptGNRL?>

<script>
	var TxtType = function(t, e, i) {
    this.toRotate = e, this.el = t, this.loopNum = 0, this.period = parseInt(i, 10) || 2e3, this.txt = "", this.tick(), this.isDeleting = !1
	};
	TxtType.prototype.tick = function() {
	    var t = this.loopNum % this.toRotate.length,
	        e = this.toRotate[t];
	    this.isDeleting ? this.txt = e.substring(0, this.txt.length - 1) : this.txt = e.substring(0, this.txt.length + 1), this.el.innerHTML = '<span class="wrap">' + this.txt + "</span>";
	    var i = this,
	        s = 200 - 100 * Math.random();
	    this.isDeleting && (s /= 2), this.isDeleting || this.txt !== e ? this.isDeleting && "" === this.txt && (this.isDeleting = !1, this.loopNum++, s = 500) : (s = this.period, this.isDeleting = !0), setTimeout(function() {
	        i.tick()
	    }, s)
	}, window.onload = function() {
	    for (var t = document.getElementsByClassName("typewrite"), e = 0; e < t.length; e++) {
	        var i = t[e].getAttribute("data-type"),
	            s = t[e].getAttribute("data-period");
	        i && new TxtType(t[e], JSON.parse(i), s)
	    }
	    var n = document.createElement("style");
	    n.type = "text/css", n.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}", document.body.appendChild(n)
	};
</script>

</body>
</html>