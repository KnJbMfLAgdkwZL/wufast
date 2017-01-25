        <div class="Content">
            <hr/>
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
                                $dis = "<input class='btncliented' type='button' value='Изменить' onclick='ClientEdit({$val['DOid']})'/>";
                                $dis .= " <input class='btnclientcans' type='button' value='Отменить' onclick='ClientCansel({$val['DOid']})'/>";
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
                        $str .= "<div><div class='orderclientmyacc $clordstat'>
                            <samp>$stat</samp>
                            <div id='dropinfo{$val['DOid']}'>
                                <samp id='Dname{$val['DOid']}'>{$val['Dname']}</samp>
                                <samp id='Dcountry{$val['DOid']}'>{$val['Dcountry']}</samp>
                                <samp id='Dcity{$val['DOid']}'>{$val['Dcity']}</samp>
                                <samp>$cat</samp>
                            </div>";
                        $str .= "<br/>
                            <div>
                                <samp id='DOmtcn{$val['DOid']}'>{$val['DOmtcn']}</samp>
                                <samp id='DOcountry{$val['DOid']}'>{$val['DOcountry']}</samp>
                                <samp id='DOname{$val['DOid']}'>{$val['DOname']}</samp>
                                <br/>
                                <samp id='DOamount{$val['DOid']}'>{$val['DOamount']}</samp>
                                <samp id='DOcurcy{$val['DOid']}'>{$val['DOcurcy']}</samp>
                                <br/>
                                <samp id='DOcomt{$val['DOid']}'>{$val['DOcomt']}</samp>
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
            <div id="Hidenn">
                <div id="hcon">
        			<div id="Book">
                        <form id="orderform" name="order" action="javascript:void(null)" method="post">
                            <input type="hidden" name="action" value="ClientAction"/>
                            <input type="hidden" name="OrderId" value="-1"/>
                            <div class="do">
                                <div id="valueorderform"></div>
                                <br/>
                                <input type="text" name="mtcn" placeholder="MTCN" class="fieldsorder" value="" />
                                <input type="text" name="country" placeholder="Страна" class="fieldsorder" value="" />
                                <br/>
                                <input type="text" name="name" placeholder="Имя" class="fieldsorder" value="" />
                                <input type="text" name="amount" placeholder="Сумма" class="fieldsorder" value="" />
                                <br/>
                                <select class="fieldsorder selectfield" name="currency">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="FS">Sterling funts</option>
                                </select>
                                <input type="text" name="comment" placeholder="Коментарии" value="" class="fieldsorder" />
                                <br/>
                                <div id="butoonsoncns">
                                    <input type="button" value="Подтвердить" onclick="OKclick('OrderEdit')" />
                                    <input type="button" value="Отменить" class="canse" onclick="Hide(false)"/>
                                </div>
                            </div>
                        </form>
        			</div>
        		</div>
            </div>       
        </div>