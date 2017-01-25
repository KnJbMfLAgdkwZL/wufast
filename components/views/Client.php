        <div class="Content">
            <div class="shownews">
                <div class="newticikforadmin">
                <?php
                    if(isset($news) && !empty($news) && count($news)>0)
                    {
                        $str = "";
                        foreach($news as $key=>$val)
                        {
                            $str .= "<div class='clientnews'>
                            <span onclick='ClientCloseNews({$val['id']})' class='closetickadmin'>x</span>
                            <div class='newstextmain'>{$val['newstext']}</div>
                            </div>";
                        }
                        print $str;
                    }
                ?>
                </div>
            </div>
            <div class="dropcategory">
                <?php
                    $check = -1;
                    if(isset($checed))
                        $check = $checed;
                ?>
                <span class='catelm'><input <?= ($check==0)?'checked':'' ?> type="radio" onclick='ClientChangeCategory(0)' name="cat" value="0"/> Luxury Drop</span>
                <span class='catelm'><input <?= ($check==1)?'checked':'' ?> type="radio" onclick='ClientChangeCategory(1)' name="cat" value="1"/> Dating Scam Drop</span>
                <span class='catelm'><input <?= ($check==2)?'checked':'' ?> type="radio" onclick='ClientChangeCategory(2)' name="cat" value="2"/> Personal Drop</span>
            </div>
        <?php
            $str = '';
            if(isset($drops) && !empty($drops) && count($drops)>0)
            {
                $str = "<table class='drops'>";
                foreach($drops as $key=>$val)
                {
                    $cat = '';
                    $catclas ='';
                    switch($val['cat'])
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
                    $str .="<tr id='drop{$val['id']}' class='$catclas tabletr'>
                        <td id='tdname{$val['id']}'>{$val['name']}</td>
                        <td id='tdcountry{$val['id']}'>{$val['country']}</td>
                        <td id='tdcity{$val['id']}'>{$val['city']}</td>
                        <td id='tdcat{$val['id']}'>$cat</td>
                        <td>
                            <input id='ordbtnid{$val['id']}' class='Order' type='submit' value='Заказать' onClick='Order({$val['id']})' />
                        </td>
                    </tr>";
                }
                $str .= "</table>";
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