                                        <div class="Content">
            <br />
            <div>
                <button class="btn btn-primary" onclick="CreateDrop()">Создать Дропа</button>
            </div>
            <br />
            <?php
            $str = '';
            if(isset($drops) && !empty($drops) && count($drops)>0)
            {
                $str = "<div class='drops dropmanager'>";
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
                    <div id='{$val['id']}' class='tabletr dropmanager'>
                        <span class='midtext clientdname' id='tdname{$val['id']}'>{$val['name']}</span>
                        <span class='midtext clientdcountry' id='tdcountry{$val['id']}'>{$val['country']}</span>&nbsp;&nbsp;
                        <span class='midtext clientdcity' id='tdcity{$val['id']}'>{$val['city']}</span>
                        <span class='midtext clientdcat $castc' id='cat{$val['id']}'>$cat</span>&nbsp;&nbsp;
                        <input type='hidden' id='category{$val['id']}' value='{$val['cat']}' />
                        <span class='midtext botnclientorder dropmanager'>
                            <input id='ordbtnid{$val['id']}' class='btn btn-primary' type='submit' type='submit' value='Редактировать' onClick='DroprEdit({$val['id']})' />
                            <input id='ordbtnid{$val['id']}' class='btn btn-danger' type='submit' value='Удалить' onClick='DroprDelete({$val['id']})' />
                            <a class='dropinf' class='btn btn-info' type='submit' href='/?action=DropInfo&id={$val['id']}'>
                            <input class='btn btn-info' type='submit' value='Инфо'/>
                            </a>  
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
            
                            