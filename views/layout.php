<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PrincipalTeikokuMangas </title>
    <link rel="icon" type="image/jpg" href="/build/img/logo1.jpg">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    
    
</head>
        <header>
            <div class="header-content">
                <div class="logo">
                    <a href="/">
                        <img class="logo"src="/build/img/logo1.jpg" alt="" width="200px"> 
                    </a> 
                </div>

                <div class="menu" id="show-menu" <?php echo $style; ?>>
                    <nav>
                        <ul>
                            
                            <div class="dropdown">
                            <li>
                                <a href="" class="dropbtn"><p class="linea-opciones-animacion">Categorias</p></a>
                            </li>
                                    <div class="dropdown-content">
                                        <a href="/categorias?categoria=Shonen">SHONEN</a>
                                        <a href="/categorias?categoria=Deporte">DEPORTES</a>
                                        <a href="/categorias?categoria=shoujo">SHOUJO</a>
                                        <a href="/categorias?categoria=Terror">TERROR</a>
                                    </div>
                            </div>  
                            <li>
                                <a class="nav-link" href="Promociones.php"><p class="linea-opciones-animacion">Promociones</p></a>
                            </li>
                            <li>
                                <a class="nav-link" href="Nosotros.php"><p class="linea-opciones-animacion">Nosotros</p></a>
                            </li>
                            <li>
                                <a class="nav-link" href="Contacto.php"><p class="linea-opciones-animacion">Contacto</p></a>
                            </li>
                            
                            <div id="ctn-icon-search">
                                <i class="fas fa-search" id="icon-search"></i>
                            </div>
                            <li class="submenu">
                                
                                <img src="/build/img/carrito-de-compras.png" id="img-carrito" style="width: 35px; cursor: pointer;" >
                                <!-- <p>2</p> -->
                                
                                <div id="carrito" style="display: none;" >
                                    <div>
                                        <span>
                                        <a href="#" class="borrar-carrito" data-id="x">X</a>
                                        </span>
                                        <p style="font-size: 21px; font-weight: 700; color: #004280;">Mi carrito</p>
                                        
                                        <p id="mensaje-carrito" style="text-align: center; padding: 30px 0 20px; font-size: 15px; font-weight: 700; color: #004280;display:block;">No tienes ningún artículo en tu carrito de compras.</p>
                                    </div>
                                    <div id="cabezera-carrito" style="max-height:400px; overflow-x:auto; ">
                                        <table id="lista-carrito" class="u-full-width" style="display:none;">
                                            <thead style="border-bottom: 1px solid #E1E1E1;">
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuerpo">
                                            </tbody>
                                        
                                        </table>
                                    </div>

                                    <div class="subtotal">
                                    </div >

                                    <a href="#" id="vaciar-carrito" class="button u-full-width" style="display:none;">Vaciar Carrito</a>
                                    <div class="ir" style="display: block;"></div>
                                    <!-- <div class="ir" style="display: block;">

                                    </div> -->
                                    
                                </div>
                            </li> 
                            
                            <li id="li-nav">
                                <img src="/build/img/usuario-de-perfil.png" alt="">
                                <?php if($_SESSION['nombre']){ ?>
                                    <span style="padding: 2rem;font-size: 1.25rem;" id="usuario"><?php echo $_SESSION['nombre'] ?></span>                                
                                <?php }else{ ?>
                                    <a style="color: black" href="/login">Iniciar Sesión</a>
                                <?php } ?>
                                <p id="idUsuario" hidden><?php echo $_SESSION['id'] ?></p>
                                <p id="direccion" hidden><?php echo $_SESSION['direccion'] ?></p>
                                <p id="telefono" hidden><?php echo $_SESSION['telefono'] ?></p>
                                <p id="email" hidden><?php echo $_SESSION['email'] ?></p>
                            </li>
                            
                            <?php if($_SESSION['nombre']){ ?>
                            <li style="margin-left: -1.8rem;">       
                                <a class="salir" href="/logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout-2" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                    <path d="M15 12h-12l3 -3" />
                                    <path d="M6 15l-3 -3" />
                                    </svg>
                                </a>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </nav> 
                </div>
            </div>   
        </header> 
        
        <div id="ctn-bars-search">
            <input id="inputSearch" placeholder="Buscar Producto" type="text" >
        </div>
        
        <ul id="box-search">
        </ul>
            
        <div id="cover-ctn-search"></div>
        
    <body>
        
        <?php echo $contenido; ?>

        <?php
            echo $script ?? '';
        ?>
                
    </body>

    <footer style="margin-top: 8rem;">
        <div class="footer-Top">
            <img class="footer-imagen" src="/build/img/logo2.jpg" alt="" width="150" height="150"/>
        </div>  
        <div class="footer-bottom">
            <div>
                <ul>
                    <h5><b>CONTACTO</b></h5>
                    <li id="li-nav">
                        <img src="/build/img/correo.png" alt=""/>
                        <a style="color: black" href="mailto:mangas@gmail.com" target="_blank">mangasteikoku@gmail.com</a>
                    </li>
                    <li id="li-nav">  
                        <img src="/build/img/whatsapp.png" alt="">
                            <a style="color: black" href="http://wa.me/923194461" target="_blank">923 194 461</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <h5><b>POLITICAS</b></h5>
                        Políticas de Privacidad<br/>
                        Términos y condiciones<br/>
                        Preguntas Frecuentes<br/>
                        Libro de reclamaciones<br/>
                </ul>
            </div>
            <div>
                <div class="footer-redesSociales">
                    <a class="footer-redesSociales-circulo" href="https://www.facebook.com/profile.php?id=100086588221629&is_tour_dismissed=true" target="_blank">
                        <img src="/build/img/facebook.png" alt="" />
                    </a>
                    <a>&nbsp</a>
                    <a class="footer-redesSociales-circulo" href="https://www.instagram.com/vina_tintos/" target="_blank">
                        <img src="/build/img/instagram.png" alt="" />
                    </a>
                    <a>&nbsp</a>
                    <a class="footer-redesSociales-circulo" href="https://www.linkedin.com/in/vi%C3%B1a-tintos-533579252/" target="_blank">
                        <img src="/build/img/linkedin.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
        
        
        <!--
        
        -->

    </footer>

    
</html>