        <div class="Content">
            <form name="oper" action="javascript:void(null)" method="post">
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
                            <div id='status{$val['id']}'>$status</div>
                            {$di['name']}, {$di['country']}, {$di['city']}
                            <br/>
                            {$val['mtcn']} {$val['country']} {$val['name']} {$val['amount']}
                            {$val['currency']}
                            <br/>
                            {$val['comment']}
                            <br/>
                            <input class='OK' type='submit' value='OK' onClick='OpOk({$val['id']})' />
                            <input class='Cancel' type='submit' value='Cancel' onClick='OpCans({$val['id']})' /> 
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