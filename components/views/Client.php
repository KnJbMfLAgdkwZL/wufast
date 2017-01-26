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
                        <span class='midtext clientdcountry' id='tdcountry{$val['id']}'>{$val['country']}&nbsp;&nbsp;</span>
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
                                    <input type="button" value="Подтвердить" onclick="OKclick('OrderGet')" />
                                    <input type="button" value="Отменить" class="canse" onclick="Hide(false)"/>
                                </div>
                            </div>
                        </form>
        			</div>
        		</div>
            </div>
        </div>