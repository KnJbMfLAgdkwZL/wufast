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
                        $str .= "<div><div class='orderclientmyacc $clordstat'>
                            <samp>$stat</samp>
                            <div>
                                <samp>{$val['Dcdate']}</samp><br/>
                                <samp>{$val['Dname']}</samp>
                                <samp>{$val['Dcountry']}</samp>
                                <samp>{$val['Dcity']}</samp>
                                <samp>$cat</samp>
                                
                            </div>";
                        $str .= "<br/>
                            <div>
                                <samp>{$val['DOmtcn']}</samp>
                                <samp>{$val['DOcountry']}</samp>
                                <samp>{$val['DOname']}</samp>
                                <br/>
                                <samp>{$val['DOamount']}</samp>
                                <samp>{$val['DOcurrency']}</samp>
                                <br/>
                                <samp>{$val['DOcomment']}</samp>
                                <br/>
                                <samp>{$val['DOorder_creation']}</samp>
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