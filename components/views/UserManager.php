        <div class="Content">
            <div class="centr">
                <form action="" method="post">
                    <input type="hidden" name="action" value="AdminCreateUser"/>
                    <h3>Создать Пользователя</h3><br />
                    <span>Логин: </span> <div><input name="login" type="text"/></div>
                    <span>Пароль: </span> <div><input name="password" type="text"/></div>  
                    Группа:<br />
                    <input type="radio" name="groop" value="1" checked="" /> Админ<br/>
                    <input type="radio" name="groop" value="2"/> Оператор<br/>
                    <input type="radio" name="groop" value="3"/> Пользователь
                    <br /><br />
                    <button>Создать Пользователя</button>
                </form>
            </div>
            <form name="editusers" action="javascript:void(null)" method="post">
                <?php
                    $str = "";
                    if(isset($users) && !empty($users) && count($users)>0)
                    {
                        foreach($users as $key=>$val)
                        {
                            $id = $val['id'];
                            $nickname = $val['nickname'];
                            $s1 = $s2 = $s3 = '';
                            if($val['group'] == 1)
                                $s1 = 'selected';
                            if($val['group'] == 2)
                                $s2 = 'selected';
                            if($val['group'] == 3)
                                $s3 = 'selected';
                            $str .= "
                            <div class='usereditwraper'>
                                <input type='text' name='nickname$id' value='$nickname' placeholder='Логин' />
                                <input type='text' name='password$id' value='' placeholder='Новый Пароль' />
                                <input type='button' value='New Pass' onclick='GetRandomPassword($id)' />
                                
                                <select name='group$id'>
                                    <option value='1' $s1>Админ</option>
                                    <option value='2' $s2>Оператор</option>
                                    <option value='3' $s3>Пользователь</option>
                                </select>
                                <input type='checkbox' name='delete$id' value=''/> Удалить
                                
                                <input type='button' value='Редактировать' onclick='AdminEditUser($id)' />
                                <a class='userinf' href='/?action=UserInfo&id=$id'>Инфо</a>             
                            </div>
                            ";
                        }
                    }
                    else
                    {
                        $str = '<br/><br/><h2>Нету юзеров</h2>';
                    }
                    print $str;
                ?>
            </form>
        </div>
        