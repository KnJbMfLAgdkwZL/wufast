<form class='form-horizontal' method='post' name='modalform' action='javascript:void(null)'>
    <fieldset>
        <div class='form-group'>
            <label for='login' class='col-lg-2 control-label'>Логин</label>
            <div class='col-lg-10'>
                <input name='login' type='text' class='form-control' placeholder='Логин' />
            </div>
        </div>
        <div class='form-group'>
            <label for='password' class='col-lg-2 control-label'>Пароль</label>
            <div class='col-lg-10'>
                <input type='text' name='password' class='form-control' placeholder='Пароль' />
            </div>
        </div>
        <div class='form-group'>
            <div class='col-lg-10 col-lg-offset-2'>
                <button onclick='RandomPassword()' type='submit' class='btn btn-primary btn-xs'>
                    Сгенерировать новый пароль
                </button>
            </div>
        </div>
        <div class='form-group'>
            <label class='col-lg-2 control-label'>Роль</label>
            <div class='col-lg-10'>
                <div class='radio'>
                    <label>
                        <input type='radio' name='group' value='1' checked=''/>
                        Админ
                    </label>
                </div>
                <div class='radio'>
                    <label>
                        <input type='radio' name='group' value='2'/>
                        Оператор
                    </label>
                </div>
                <div class='radio'>
                    <label>
                        <input type='radio' name='group' value='3'/>
                        Пользователь
                    </label>
                </div>
            </div>
        </div>
        <div class='form-group'>
            <div class='col-lg-10 col-lg-offset-2'>
                <button id="userdel" class='btn btn-danger btn-sm' onclick='DeleteUser($id)'>
                    Удалить Пользователя
                </button>
            </div>
        </div>
    </fieldset>
</form>