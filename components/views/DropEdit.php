<form class='form-horizontal' method='post' name='modalform' action='javascript:void(null)'>
    <fieldset>
        <div class='form-group'>
            <label for='login' class='col-lg-2 control-label'>Имя</label>
            <div class='col-lg-10'>
                <input name='name' type='text' class='form-control' placeholder='Имя' />
            </div>
        </div>
        <div class='form-group'>
            <label for='password' class='col-lg-2 control-label'>Страна</label>
            <div class='col-lg-10'>
                <input type='text' name='country' class='form-control' placeholder='Страна' />
            </div>
        </div>
        <div class='form-group'>
            <label for='password' class='col-lg-2 control-label'>Город</label>
            <div class='col-lg-10'>
                <input type='text' name='city' class='form-control' placeholder='Город' />
            </div>
        </div>
        <div class='form-group'>
            <label class='col-lg-2 control-label'>Тип</label>
            <div class='col-lg-10'>
                <div class='radio'>
                    <label>
                        <input type='radio' name='cat' value='0' checked=''/>
                        Luxury Drop
                    </label>
                </div>
                <div class='radio'>
                    <label>
                        <input type='radio' name='cat' value='1'/>
                        Dating Scam Drop
                    </label>
                </div>
                <div class='radio'>
                    <label>
                        <input type='radio' name='cat' value='2'/>
                        Personal Drop
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
</form>    