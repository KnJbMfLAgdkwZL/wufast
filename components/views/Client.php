<div class="Content">
    <div class="shownews">
        <div class="newticikforadmin">
        <?php
            if(isset($news) && !empty($news) && count($news)>0)
            {
                $str = "";
                foreach($news as $key=>$val)
                {
                    $str .= "
                    <div class='alert alert-dismissable alert-info mynews'>
                    <button onclick='ClientCloseNews({$val['id']})' type='button' class='close' data-dismiss='alert'>×</button>
                    {$val['newstext']}
                    </div>";
                }
                print $str;
            }
        ?>
        </div>
    </div>
    <div class="dropcategory">
        <h2 class="catget">Выберите дропа</h2>
        <span class='catelm centrdropclient'>
            <button class="btn btn-primary btn-sm" onclick='ClientChangeCategory(0)' >Luxury Drop</button>
        </span>
        <span class='catelm'>
            <button class="btn btn-success btn-sm" onclick='ClientChangeCategory(1)' >Dating Scam Drop</button>
        </span>
        <span class='catelm'>
            <button class="btn btn-warning btn-sm" onclick='ClientChangeCategory(2)' >Personal Drop</button>
        </span>
    </div>
<?php
    $str = '';
    if(isset($drops) && !empty($drops) && count($drops)>0)
    {
        $str = "<div class='drops'>";
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
            <div id='{$val['id']}' class='tabletr'>
                <span class='midtext clientdname' id='tdname{$val['id']}'>{$val['name']}</span>
                <span class='midtext clientdcountry' id='tdcountry{$val['id']}'>{$val['country']}</span>&nbsp;&nbsp;
                <span class='midtext clientdcity' id='tdcity{$val['id']}'>{$val['city']}</span>
                <span class='midtext clientdcat $castc' id='tdcat{$val['id']}'>$cat</span>
                <span class='midtext botnclientorder'>
                    <input id='ordbtnid{$val['id']}' class='btn btn-primary' type='submit' value='Заказать' onClick='Order({$val['id']})' />
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
<div class="modal leftmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="ModalClose()" type="button" class="close">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            <?php
                require_once('ClientEdit.php');
            ?>
            </div>
            
            <div class="modal-footer">
                <button onclick="ModalClose()" type="button" class="btn btn-default">Отмена</button>
                <button onclick="OKclick('OrderGet')" type="button" class="btn btn-primary SaveBtn">Подтвердить</button>
            </div>
        </div>
    </div>
</div>