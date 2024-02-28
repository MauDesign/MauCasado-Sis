<?php 

include 'includes/header.php';

?>
<div data-bs-spy="scroll" class="scrollspy-example" id="top-ini">
      <!-- Hero: Start -->
    <section id="landingHero" class="section-py landing-hero" >
    <div class="container" style="display:flex; padding-bottom:3rem;">
        <div class="hero-text-box text-center col-lg-6">
            <h1 class="text-primary " style="font-family:var(--bs-title-font-family);">Hola Soy Mauricio  UX/UI Designer</h1>
            <p class="h6 mb-4 pb-1 lh-lg">
            Como diseñador apasionado de la tecnología, me enfoco en utilizar las últimas herramientas y tecnologías para crear soluciones a la medida de cada reto. Desde el punto de vista mercadológico, de diseño de experiencias y de desarrollo, ataco tus necesidades para brindarte una propuesta de alto impacto que te ayude a destacar en línea y digitalizar processos.
            </p>
            <a href="#landingPricing" class="btn btn-primary">Conoce más</a>
        </div>
        <div class=" hero-elements-img col-lg-6">
            <a href="#" target="_blank">
              <div class="hero-dashboard-img text-center">
                <img
                  src="assets/img/profile.jpg"
                  alt="hero dashboard"
                  class="animation-img image-hero"
                  data-speed="2"
                  style="width:350px;" />
              </div>  
              </a>
        </div>
    </div>
    </section>
    </div>
</div>
<section class="section-py frase ">
    <div class="container">
        <div class="col s12 m6 l12">
            <h2 class="text-center">Grandes cosas se hacen por una serie de pequeñas cosas reunidas.</h2>
            <h4 class="text-center">Vincent Van Gogh</h4>
        </div>
    </div>
</section>
<section class="section-py servicios " style="background:conic-gradient(from -61deg at 64.09% 50%, #FF945B 42.28158384561539deg, #5894D6 110.08992791175842deg, #4DD7AF 243.98332357406616deg);" id="servicios">
    <div class="container" >
    <h1 >Servicios</h1>
        <div class="row"> 
        
            <div class="col-lg" >
                <div class="card " >
                    <img class="card-img-top" src="assets/img/services/UX-UIdesign_MC.png">
                    <div class="card-body">
                        <h3 style="color:var(--dar-medium-background);">Diseño y desarrollo web</h3> 
                        <p class="card-text">Los servicios de diseño y desarrollo web ofrecen soluciones a medida que fusionan creatividad y tecnología. Nuestro enfoque se centra en el diseño de experiencias de usuario (UX) y la interfaz de usuario (UI) excepcionales para garantizar que cada visitante disfrute de una navegación intuitiva y atractiva. </p>
                        
                    </div>
                    <a href="#" class="btn btn-primary">Conoce más</a>
                </div>
            </div>

            <div class="col-lg">
                <div class="card" >
                    <img class="card-img-top" src="assets/img/services/marketing-digital-MC.png">
                        <div class="card-body">
                        <h3 style="color:var(--dar-medium-background);">Marketing digital</h3>
                        <p class="card-text">Los servicios de marketing digital se especializan en maximizar la visibilidad en línea de su negocio. Destacamos a través de la creación de campañas de posicionamiento en motores de búsqueda y redes sociales, asegurando que su marca alcance a su audiencia objetivo en los lugares adecuados. </p>
                    </div>
                    <a href="#" class="btn btn-primary">Conoce más</a>
                </div>
            </div>

            <div class="col-lg">
                <div class="card " >
                    <img class="card-img-top" src="assets/img/services/Consulting_MC.png">
                    <div class="card-body">
                        <h3 style="color:var(--dar-medium-background);">Consultoria de negocios</h3>
                        <p class="card-text">Los servicios de consultoría en digitalización de negocios se centran en guiar a las empresas en su transformación digital. Nuestra misión es ayudar a las organizaciones a adaptarse y aprovechar al máximo las tecnologías digitales emergentes. identificar oportunidades, implementar soluciones tecnológicas</p>
                        
                    </div>
                    <a href="#" class="btn btn-primary">Conoce más</a>
                </div>
            </div>
        </div>
    </div>

</section>
<section class="section-py  portfolio container" id="proyectos">
    <div class="container">
        <h2>Proyectos</h2>
        <div class=" col " style="display:flex;">
            <div class="panel active" style="background-image: url(assets/img/proyect/Aquadrada_MC.jpg);">
                <a href="desarrollo-web.php" class="btn btn-primary">Desarrollo de Software a la medida.</a>
            </div>
            <div class="panel" style="background-image: url(assets/img/proyect/MWU_MC.jpg);">
                <a href="medios-digitales.php" class="btn btn-primary">MWU un medio digital único.</a>
            </div>
            <div class="panel" style="background-image: url(assets/img/proyect/NOMEN_MC_UXUI.jpg);">
                <a href="diseno-ux-ui.php" class="btn btn-primary">UX/UI de sitema de facturación.</a>
            </div>
            <div class="panel" style="background-image: url(assets/img/proyect/Infografias_MC.jpg);">
                <a href="diseno-info.php" class="btn btn-primary">Diseño de innformación.</a>
            </div>
            <div class="panel" style="background-image: url(assets/img/proyect/Markeiting-Digital_MC.png);">
                <a href="marketing-digital.php" class="btn btn-primary">Marketing Digital.</a>
            </div>
        </div>
    </div>
</section>

<section class="container">
<div class="section-py  row contacto container-p-y" id="contacto" >
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h2 style="color:var(--primary-color);">Contacto</h2>
                    
                    <form action="includes/correo.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="Teléfono" name="telefono">
                            <label for="telefono">Telefono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Correo" name="correo">
                            <label for="correo">Correo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="asunto" name="Asunto">
                            <label for="asunto">Asunto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="textaarea" class="form-control" id="floatingInput"  name="mensaje">
                            <label for="mensaje">Mensaje</label>
                        </div>
                        
                            <input type="submit" class="btn btn-primary" id="floatingInput"  name="submit" value="enviar">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>

<script type="text/javascript">
    const panels = document.querySelectorAll('.panel')
panels.forEach((panel) => {
    panel.addEventListener('click',() =>{
        removeActiveClasses()
        panel.classList.add('active')
    })
})

function removeActiveClasses(){
    panels.forEach(panel => {
        panel.classList.remove('active')
    })
}
</script>
<div class="container">
<?php 
include 'includes/footer.php';
?>