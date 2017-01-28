<div class="Content">
    <br />
    <div>
        <button onclick="CreateUser()" class="btn btn-primary">Создать Пользователя</button>
    </div>
    <br />
    <div class='drops dropmanager'>
    <?php
        $str = "";
        if(isset($users) && !empty($users) && count($users)>0)
        {
            foreach($users as $key=>$val)
            {
                $id = $val['id'];
                $nickname = $val['nickname'];
                $group = $val['group'];
                
                $cat = '';
                $castc = '';
                switch($group)
                {
                    case 1:
                        $castc = 'Luxury';
                        $cat = 'Админ';
                    break;
                    case 2:
                        $castc = 'Dating';
                        $cat = 'Оператор';
                    break;
                    case 3:
                        $castc = 'Personal';
                        $cat = 'Пользователь';
                    break;
                }
                $str .= "
                <div class='tabletr dropmanager'>
                                
                    <span hidden id='group$id'>$group</span>
                
                    <span class='midtext clientdname usernameedit' id='nickname$id'>$nickname</span>
                    
                    <span class='midtext clientdcat $castc' id='cat{$val['id']}'>$cat</span>&nbsp;&nbsp;
                    
                    &nbsp;
                    <span class='midtext botnclientorder dropmanager'>
                        <button onclick='EditUser($id)' class='btn btn-primary'>
                            Редактировать
                        </button>
                        &nbsp;
                        <a href='/?action=UserInfo&id=$id' class='btn btn-info'>Инфо</a>
                    </span>
                    
                </div>";
            }
        }
        else
            $str = '<h2>Нету юзеров</h2>';
        print $str;
    ?>
    </div>
</div>

<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="ModalClose()" type="button" class="close">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            
            <div class="modal-body">
            <?php
                require_once('UserEdit.php');
            ?>
            </div>
            
            <div class="modal-footer">
                <button onclick="ModalClose()" type="button" class="btn btn-default">Отмена</button>
                <button id="SaveBtn" type="button" class="btn btn-primary SaveBtn">Сохранить</button>
            </div>
        </div>
    </div>
</div>