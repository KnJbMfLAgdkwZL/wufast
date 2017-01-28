        <div class="Content">
            <?php
                $str = "";
                if(isset($userinf) && !empty($userinf) && count($userinf)>0)
                {
                    foreach($userinf as $key=>$val)
                    {
                        $cat = '';
                        switch($val['Dcat'])
                        {
                            case 0:
                                $cat = 'Luxury Drop';
                            break;
                            case 1:
                                $cat = 'Dating Scam Drop';
                            break;
                            case 2:
                                $cat = 'Personal Drop';
                            break;
                        }
                        $clordstat = '';
                        $stat = '';
                        $dis = '';
                        switch($val['DOstatus'])
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
                        $str .= "<div><div class='OperatorDrops orderclientmyacc $clordstat'>
                            <h4>$stat</h4>
                            <div>
                                <span class='cdate'>{$val['Dcdate']}</span><br/>
                                <span class='mtcn'>{$val['Dname']}</span>
                                <span class='country'>{$val['Dcountry']}</span>
                                <span>{$val['Dcity']}</span>
                                <span>$cat</span>
                                
                            </div>";
                        $str .= "<br/>
                            <div>
                                <span>{$val['DOmtcn']}</span>
                                <span>{$val['DOcountry']}</span>
                                <span>{$val['DOname']}</span>
                                <br/>
                                <span class='amountclient'>{$val['DOamount']}</span>
                                <span>{$val['DOcurrency']}</span>
                                <br/>
                                <span>{$val['DOcomment']}</span>
                                <br/>
                                <span class='cdate'>{$val['DOorder_creation']}</span>
                            </div>$dis</div>
                        </div>";
                    }
                }
                else
                {
                    $str = '<br/><br/><h2>У юзера нету заказов</h2>';
                }
                print $str;
            ?>
        </div>