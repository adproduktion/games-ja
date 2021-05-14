<?php
    session_start();
    include 'db.php';
    if($_SESSION['user']){
        header('Location: projects.php');
    }
    include 'header.php';

?>

<section class="section-content">
            <div class="content-index">
                <form class="content-index-signin">
                    <div>
                        Войти
                    </div>
                    <div class="messages"></div>

                    <div class="input-ccs" style="width: 200px;">      
                        <input type="email" id="email" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Email</label>
                    </div>
                    <div class="input-ccs" style="width: 200px;">      
                        <input type="password" class="signin-password" id="password" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Пароль</label>
                    </div>
                    <input type="button" class="button-css" value="Войти" id="content-index-signin-button">
                </form>
                <form class="content-index-signup">
                    <div>
                        Регистрация
                    </div>
                    <div class="messages"></div>
                    <div class="input-ccs" style="width: 200px;">      
                        <input type=text" id="name" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Логин</label>
                    </div>
                    <div class="input-ccs" style="width: 200px;">      
                        <input type="email" id="email" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Email</label>
                    </div>
                    <div class="input-ccs" style="width: 200px;">      
                        <input type="password" id="password" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Пароль</label>
                    </div>
                    <div class="input-ccs" style="width: 200px;">      
                        <input type="password" id="password-confirm" style="width: 100%;" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Повторить пароль</label>
                    </div>
                    <input type="button" class="button-css" value="Регистрация" id="content-index-signup-button">    
                </form>           
            </div>            
        </section>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="js/main.js"></script>
</html>