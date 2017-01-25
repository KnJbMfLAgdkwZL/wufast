        <div class="Content">
        <?php
            $str = "";
            if(isset($dropinf) && !empty($dropinf) && count($dropinf)>0)
            {
                foreach($dropinf as $key=>$val)
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
                    "<div><div class='orderclientmyacc $clordstat'>
                        <samp>$stat</samp>
                        <div>
                            <samp>{$val['mtcn']}</samp>
                            <samp>{$val['country']}</samp>
                            <samp>{$val['name']}</samp>
                            <br/>
                            <samp>{$val['amount']}</samp>
                            <samp>{$val['currency']}</samp>
                            <br/>
                            <samp>{$val['comment']}</samp>
                            <br/>
                            <samp>{$val['order_creation']}</samp>
                            <div>
                                <a href='/?action=UserInfo&id={$val['ordered_by']}'>
                                    {$val['nickname']}
                                </a>
                            </div>
                        </div>$dis</div>
                    </div>";
                }
            }
            else
            {
                $str = '<br/><br/><h2>Нет заказов</h2>';
            }
            print $str;
        ?>
        </div>