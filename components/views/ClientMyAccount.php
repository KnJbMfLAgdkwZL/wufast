        <div class="Content">
            <hr/>
            
        <div class="droporderoeration">
        
            <?php
                $str = "";
                if(isset($drops) && !empty($drops) && count($drops)>0)
                {
                    foreach($drops as $key=>$val)
                    {
                        $cat = '';
                        $catclas = '';
                        switch($val['Dcat'])
                        {
                            case 0:
                                $cat = 'Luxury Drop';
                                $catclas = 'Luxury';
                            break;
                            case 1:
                                $cat = 'Dating Scam Drop';
                                $catclas = 'Dating';
                            break;
                            case 2:
                                $cat = 'Personal Drop';
                                $catclas = 'Personal';
                            break;
                        }
                        $clordstat = '';
                        $stat = '';
                        $dis = '';
                        switch($val['DOstat'])
                        {
                            case 0:
                                $stat = 'Ожидание';
                                $clordstat = 'obrab';
                                $dis = "<br/><input class='btn btn-primary' type='button' value='Изменить' onclick='ClientEdit({$val['DOid']})'/>";
                                $dis .= " <input class='btn btn-danger' type='button' value='Отменить' onclick='ClientCansel({$val['DOid']})'/>";
                                if(empty($val['DOmtcn']) || empty($val['DOcountry']) || empty($val['DOname']) || 
                                empty($val['DOamount']) || empty($val['DOcurcy']) || empty($val['DOcomt']))
                                {
                                   $stat .= ' Не заполнено';
                                   $clordstat .= ' orderdropempty';
                                }
                                break;
                            case 1:
                                $stat = 'Обработан';
                                $clordstat = 'odobr';
                                $dis = '<br/>';
                                break;
                            case 2:
                                $stat = 'Отказано';
                                $clordstat = 'otkaz';
                                $dis = '<br/>';
                                break;
                        }
                        $str .= "<div><div class='OperatorDrops orderclientmyacc $clordstat'>
                            <h4>$stat</h4>
                            <div id='dropinfo{$val['DOid']}'>
                                <span class='dropclientname' id='Dname{$val['DOid']}'>{$val['Dname']}</span>
                                <span id='Dcountry{$val['DOid']}'>{$val['Dcountry']}</span>
                                <span id='Dcity{$val['DOid']}'>{$val['Dcity']}</span>
                                <span>$cat</span>
                            </div>";
                        $str .= "<br/>
                            <div>
                                <span class='mtcn' id='DOmtcn{$val['DOid']}'>{$val['DOmtcn']}</span>
                                <span id='DOcountry{$val['DOid']}'>{$val['DOcountry']}</span>
                                <span id='DOname{$val['DOid']}'>{$val['DOname']}</span>
                                <br/>
                                <span class='amountclient' id='DOamount{$val['DOid']}'>{$val['DOamount']}</span>
                                <span id='DOcurcy{$val['DOid']}'>{$val['DOcurcy']}</span>
                                <br/>
                                <span id='DOcomt{$val['DOid']}'>{$val['DOcomt']}</span>
                                </div>$dis</div>
                            </div>";
                    }
                }
                else
                {
                    $str = '<br/><br/><h2>Нету запросов</h2>';
                }
                print $str;
            ?>
            <hr/>  
        </div>
    </div>
        
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
                <button onclick="OKclick('OrderEdit')" type="button" class="btn btn-primary SaveBtn">Подтвердить</button>
            </div>
        </div>
    </div>
</div>
        