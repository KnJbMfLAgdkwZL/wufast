<form class='form-horizontal' method='post' name='modalform' action='javascript:void(null)'>
    <input type="hidden" name="action" value="ClientAction"/>
    <input type="hidden" name="OrderId" value="-1"/>
    
    <fieldset>
        <div class='form-group'>
            <label for='mtcn' class='col-lg-2 control-label'>MTCN</label>
            <div class='col-lg-10'>
                <input name='mtcn' type='text' class='form-control' placeholder='MTCN' />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='country' class='col-lg-2 control-label'>Страна</label>
            <div class='col-lg-10'>
                <input type='text' name='country' class='form-control' placeholder='Страна' />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='name' class='col-lg-2 control-label'>Имя</label>
            <div class='col-lg-10'>
                <input type='text' name='name' class='form-control' placeholder='Имя' />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='amount' class='col-lg-2 control-label'>Сумма</label>
            <div class='col-lg-10'>
                <input type='text' name='amount' class='form-control' placeholder='Сумма' />
            </div>
        </div>
        
        <div class="form-group">
          <label for="select" class="col-lg-2 control-label">Валюта</label>
          <div class="col-lg-10">
            <select class="form-control" id="select" name="currency">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="FS">Sterling funts</option>
            </select>
          </div>
        </div>
        
        
        <div class='form-group'>
            <label for='comment' class='col-lg-2 control-label'>Коментарии</label>
            <div class='col-lg-10'>
                <input type='text' name='comment' class='form-control' placeholder='Коментарии' />
            </div>
        </div>

    </fieldset>
</form>    