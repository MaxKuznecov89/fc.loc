<div id="form" style= "width:500px">
    <h2>Форма регистарции</h2>
    <form id="1" method="post" action="/user/signup">
        </br>
        </br>
        <label id="label1">Ввведите свое имя: </label>
        <input type="text" size="20" id="txt1" name="name"
               value = "<?= isset($_SESSION['from_date']['name'])?$_SESSION['from_date']['name']:''; ?>"/>
        </br>
        <label>Ввведите логин: </label>
        <input type="text" size="20" name="login"
               value = "<?= isset($_SESSION['from_date']['login'])?$_SESSION['from_date']['login']:'';?>"/>
        </br>
        </br>
        <label>Введите пароль:</label>
        <input type="password" size="20" name="password" />
        </br>
        </br>
        <label>Введите мыло:</label>
        <input type="text" size="20" name="email"
               value = "<?= isset($_SESSION['from_date']['email'])?$_SESSION['from_date']['email']:'';?>"/>
        </br>
        </br>
        <input type="submit"  value="Отправить"/>
        <?php if(isset($_SESSION['from_date'])){
            unset($_SESSION['from_date']);
        }   ?>
    </form>
</div>