<div id="cortina">
    <p id="btnCerrar" onclick="cerrarBtn3L()">&times;</p>
    <ul>
        <?php
        include("reciclado/links_footer.php");
        ?>
    </ul>
</div>
<!-- sidebar -->
<div class="primerlevel sidebar" id="idSidebar">
    <?php 
    setcookie('language',"RO",time()+3600*24*30,"/"); // EN para ingles
    ?>

    <div class="dentroSidebar">
        <div class="redes">
            <a href="https://www.facebook.com/pizzamaria.uk/"><img src="../img/icons/fb.gif" alt="icono facebook" /></a>
            <a href="https://www.instagram.com/pizzamariauk/"><img src="../img/icons/ig.gif" alt="icono instagram" /></a>
        </div>
        <div class="logo">
            <a href="index.php">
                <picture style="display:flex; justify-content:center;">
                    <source media="(max-width:950px)" srcset="../img/email.png">
                    <img style="width:80%;" src="../img/email.png" alt="logo Pizza Maria." id="idLogo" />
                </picture>

            </a>
        </div>
        <div id="language">
             <a href="../EN/index.php">EN</a>
             <a href="../RO/index.php">RO</a>
        </div>

    
        

    </div>
    <div class="categorias">
            <ul id="menu_categorias">
                <?php
                include("reciclado/links.php");
                ?>
            </ul>


        </div>
    <div class="botonCategorias">
            <img id="boton3L" src="../img/icons/btn3L.png" onclick="abrirBtn3L()">
        </div>

</div>