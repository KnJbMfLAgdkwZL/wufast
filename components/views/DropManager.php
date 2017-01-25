        <div class="Content">
            <br />
            <div>
                <button class="butondropcreate" onclick="CreateDrop()">Создать Дропа</button>
            </div>
            <br />
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
                            <input type='hidden' id='cat{$val['id']}' value='{$val['cat']}'/>
                            <td>
                                <input id='ordbtnid{$val['id']}' class='Order' type='submit' value='Редактировать' onClick='DroprEdit({$val['id']})' />
                                <input id='ordbtnid{$val['id']}' class='Orderdel' type='submit' value='Удалить' onClick='DroprDelete({$val['id']})' />
                                <a class='dropinf' href='/?action=DropInfo&id={$val['id']}'>Инфо</a>
                            </td>
                        </tr>";
                    }
                    $str .= "</table>";
                }
                else
                {
                    $str = '<br/><br/><h2>Нету дропов</h2>';
                }
                print $str;
            ?>
        </div>
        <div id="Hidenn">
            <div id="hcon">
    			<div id="Book">
                    <form id="orderform" name="order" action="javascript:void(null)" method="post">
                        <input type="hidden" name="action" value="AdminAction"/>
                        <input type="hidden" name="OrderId" value="-1"/>
                        <input type="hidden" name="category" value="-1"/>
                        <div class="do">
                            <div id="valueorderform"></div>
                            <br/>
                            <input type="text" name="name" placeholder="Имя" class="fieldsorder" value="" />
                            <br />
                            <input type="text" name="country" placeholder="Страна" class="fieldsorder" value="" />
                            <br />
                            <input type="text" name="city" placeholder="Город" class="fieldsorder" value="" />
                            <br />
                            Категория:<br />
                            <input type="radio" name="cat" value="0" checked="" /> Luxury Drop<br/>
                            <input type="radio" name="cat" value="1"/> Dating Scam Drop<br/>
                            <input type="radio" name="cat" value="2"/> Personal Drop
                            <br /><br />
                            <div id="butoonsoncns">
                                <input type="button" value="Подтвердить" onclick="DroprEditOKclick('DropEdit')" />
                                <input type="button" value="Отменить" class="canse" onclick="Hide(false)"/>
                            </div>
                        </div>
                    </form>
    			</div>
    		</div>
        </div>
            