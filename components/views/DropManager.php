<div class="Content">
    <br />
    <div>
        <button class="btn btn-primary" onclick="DropCreate()">Создать Дропа</button>
    </div>
    <br />
    <?php
    $str = '';
    if(isset($drops) && !empty($drops) && count($drops)>0)
    {
        $str = "<div class='drops dropmanager'>";
        foreach($drops as $key=>$val)
        {
            $cat = '';
            $castc = '';
            switch($val['cat'])
            {
                case 0:
                    $castc = 'Luxury';
                    $cat = 'Luxury Drop';
                break;
                case 1:
                    $castc = 'Dating';
                    $cat = 'Dating Scam Drop';
                break;
                case 2:
                    $castc = 'Personal';
                    $cat = 'Personal Drop';
                break;
            }
            $str .=
            "
            <div id='{$val['id']}' class='tabletr dropmanager'>
                <span class='midtext clientdname textsizedrop' id='tdname{$val['id']}'>{$val['name']}</span>
                <span class='midtext clientdcountry' id='tdcountry{$val['id']}'>{$val['country']}</span>&nbsp;&nbsp;
                <span class='midtext clientdcity' id='tdcity{$val['id']}'>{$val['city']}</span>
                <span class='midtext clientdcat $castc' id='cat{$val['id']}'>$cat</span>&nbsp;&nbsp;
                <input type='hidden' id='category{$val['id']}' value='{$val['cat']}' />&nbsp;&nbsp;
                <span class='midtext botnclientorder dropmanager'>
                    <input id='ordbtnid{$val['id']}' class='btn btn-primary' type='submit' type='submit' value='Редактировать' onClick='DropEdit({$val['id']})' />
                    &nbsp;
                    <input id='ordbtnid{$val['id']}' class='btn btn-danger' type='submit' value='Удалить' onClick='DroprDelete({$val['id']})' />
                    &nbsp;
                    <a class='dropinf' class='btn btn-info' type='submit' href='/?action=DropInfo&id={$val['id']}'>
                        <input class='btn btn-info' type='submit' value='Инфо'/>
                    </a>  
                </span>
            </div>
            ";
        }
        $str .= "</div>";
    }
    else
    {
        $str = '<br/><br/><h2>Дропов пока нет</h2>';
    }
    print $str;
?>
</div>

<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="ModalClose()" type="button" class="close">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            <?php
                require_once('DropEdit.php');
            ?>
            </div>
            <div class="modal-footer">
                <button onclick="ModalClose()" type="button" class="btn btn-default">Отмена</button>
                <button id="SaveBtn" type="button" class="btn btn-primary SaveBtn">Сохранить</button>
            </div>
        </div>
    </div>
</div>  