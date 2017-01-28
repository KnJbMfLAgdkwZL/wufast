        <div class="Content">
        <?php
            $str = '';
            if(isset($result) && !empty($result) && count($result)>0)
            {
                foreach($result as $key=>$val)
                {
                    $clordstat = '';
                    $stat = '';
                    $dis = '';
                    switch($val['status'])
                    {
                        case 0:
                            $stat = 'Ожидание';
                            $clordstat = 'obrab';
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
                    $str .=
                    "<div><div class='OperatorDrops orderclientmyacc $clordstat'>
                        <h4>$stat</h4>
                        <div>
                            <span class='mtcn'>{$val['mtcn']}</span>
                            <span class='country'>{$val['country']}</span>
                            <span class='name'>{$val['name']}</span>
                            <br/>
                            <span class='amountclient'>{$val['amount']}</span>
                            <span class='currency'>{$val['currency']}</span>
                            <br/>
                            <span class='comment'>{$val['comment']}</span>
                            <br/>
                            <span class='cdate'>{$val['order_creation']}</span>
                            <div>
                                <a href='/?action=UserInfo&id={$val['ordered_by']}'>user info</a>
                            </div>
                        </div>$dis</div>
                    </div>"; 
                }
            }
            else
            {
                $str = '<br/><br/><h2>Ничего не найдено</h2>';
            }
            print $str;
        ?>
        </div>