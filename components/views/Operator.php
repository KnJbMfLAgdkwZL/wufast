        <div class="Content">
        <?php
            if(self::UserCheck() == 1)
                print '<a href="/?action=ArchiveOperations&status=-1&page=0" class="btn btn-primary">Архив операций</a>';
        ?>
            
            <br />
            <form name="oper" action="javascript:void(null)" method="post" class="droporderoeration">
                <input type="hidden" name="action" value="Operator"/>
            <?php
                $drops = "";
                if(isset($do) && !empty($do) && count($do)>0)
                {
                    foreach($do as $key=>$val)
                    {
                        $di = $val['di'];
                        $status = 'Ожидание'; 
                        if($val['status'] != 0)
                        {
                            if($val['status'] == 1)
                                $status = 'Обработан';
                            elseif($val['status'] == 2)
                                $status = 'Отказано';
                        }
                        $drops .= "
                        <div id='do{$val['id']}' class='OperatorDrops'>
                            <h4><div id='status{$val['id']}'>$status</div></h4>
                            <span class='dropname'>{$di['name']}</span> 
                            <span class='countrycity'>{$di['country']} {$di['city']}</span>
                            <br/>
                            <span class='mtcn'>{$val['mtcn']}</span>
                            <span class='country'>{$val['country']}</span>
                            <span class='name'>{$val['name']}</span>
                            <span class='amount'>{$val['amount']}</span>
                            <span class='currency'>{$val['currency']}</span>
                            <br/>
                            <span class='comment'>{$val['comment']}</span>
                            <br/>
                            <br/>
                            <input class='btn btn-primary' type='submit' value='OK' onClick='OpOk({$val['id']})' />
                            <input class='btn btn-danger' type='submit' value='Cancel' onClick='OpCans({$val['id']})' /> 
                        </div>";   
                    }
                }
                else
                {
                    $drops = '<br/><br/><h2>Заявок нет</h2>';
                }
                print $drops;
            ?>
            </form>
        </div>