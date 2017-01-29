<?php
class CController
{
    static protected $header = array();
    static function Route()
    {   
        $action = '';
        $params = null;
        if(isset($_POST))
            $_POST = self::ClearHtml($_POST);
        if(isset($_GET))
            $_GET = self::ClearHtml($_GET);
        if(isset($_POST['action']))
        {
            $action = $_POST['action'];
            unset($_POST['action']);
            $params = $_POST;
        }
        elseif(isset($_GET['action']))
        {
            $action = $_GET['action'];
            unset($_GET['action']);
            $params = $_GET;
        }
        self::HeaderCreate();
        switch($action)
        {
            case 'Login':
				self::Login($params);
			break;
            case 'Logout':
				self::Logout();
			break;
            case 'OperatorAction':
				self::OperatorAction($params);
			break;
            case 'ClientAction':
                $params['COOKIE'] = $_COOKIE;
                self::ClientAction($params);
            break;
            case 'AdminAction':
                $params['COOKIE'] = $_COOKIE;
                self::AdminAction($params);
            break;
            case 'MyAccount':
                self::MyAccount();
            break;
            default:
                self::Main();
            break;
            case 'AdminPanel':
                self::AdminPanel();
            break;
            case 'AdminCreateDrop':
				self::AdminCreateDrop($params);
            break;
            case 'AdminCreateUser':
				self::AdminCreateUser($params);
            break;
            case 'AdminCreateNews':
                self::AdminCreateNews($params);
            break;
            case 'DropManager':
                self::DropManager();
            break;
            case 'UserManager':
                self::UserManager();
            break;
            case 'DropArchive':
                self::DropArchive();
            break;
            case 'AdminTickets':
                self::AdminTickets();
            break;
            case 'AdminLookTicket':
                self::AdminLookTicket($params);
            break;
            case 'ClientTickets':
                self::ClientTickets();
            break;
            case 'UserInfo':
                self::UserInfo($params);
            break;
            case 'DropInfo':
                self::DropInfo($params);
            break;
            case 'GetNewMessages':
                self::GetNewMessages($params['id']);
            break;
            case 'AdminChangeSMS':
                self::AdminChangeSMS($params);
            break;
            case 'AdminSearch':
                self::AdminSearch($params);
            break;
            case 'ResetStatistic':
                self::ResetStatistic();
            break;
            case 'ArchiveOperations':
                self::ArchiveOperations($params);
            break;
            
        }
    }
    static function ArchiveOperations($params)
    {   
        if(self::UserCheck() == 1)
        {
            $itemsonpage = 15;
            $status = -1;
            $con = "WHERE drop_orders.drop_id = drops.id AND drops.count > -1";
            if(isset($params['status']) && $params['status'] >= 0)
            {
                $status = $params['status'];
                $con .= " AND status = $status";
            }
            $str = "/?action=ArchiveOperations&status=$status&page=";
            $count = CDataBase::GetCount('`drop_orders`, `drops`', $con);
            $pages = self::CreatePages($str, $itemsonpage, $count, $params['page']);
            if($status != -1)
                $archive = CDataBase::ArchiveOperations((int)$params['page'], $itemsonpage, $status);
            else
                $archive = CDataBase::ArchiveOperationsAll((int)$params['page'], $itemsonpage);
            $model = array('archive'=>$archive, 'status'=>$status, 'pages'=>$pages);
            self::Render('ArchiveOperations.php', $model);
        }
    }
    static function CreatePages($str, $limit, $count, $start=0)
    {
        $pages = "";
        $len = round($count/$limit-0.50001);
        $begin = 0;
        if($limit < $count)
        {
            $begin = $start - 5;
            if($begin<0)
                $begin = 0;
            elseif($start-5>0)
            {
                $pages = "
                <li><a href='{$str}0'>0</a>...</li>";
            }
                
            for($i = $begin; $i<=$len; $i++)
            {
                if($i<$begin + 9)
                {
                    if($start==$i)
                        $pages.="
                        <li class='active'>
                            <a href='$str$i'>$i</a>
                        </li>";
                    else
                        $pages.="
                        <li>
                            <a href='$str$i'>$i</a>
                        </li>";
                }
                else
                    break;
            }
        }
        $pages = substr($pages, 0, strlen($pages)-2);
        if($len>$begin + 9)
        {
            $i = $len;
            $pages.= "<li>...<a href='$str$i'>$i</a></li>";
        }
        return $pages;
    }
    static function Main()
    {
        switch(self::UserCheck())
        {
            case 1://Admin
                $do = CDataBase::GetDropOrders();
                foreach($do as $key=>$val)
                {
                    $drop = CDataBase::GetDropsById($val['drop_id']);
                    if(isset($drop) && !empty($drop))
                    {
                        $do[$key]['di'] = $drop;
                    }
                    else
                        unset($do[$key]);
                }
                $model = array('do'=>$do);
                self::Render('Operator.php', $model);
            break;
            case 2://Operator
                $do = CDataBase::GetDropOrders();
                foreach($do as $key=>$val)
                {
                    $drop = CDataBase::GetDropsById($val['drop_id']);
                    if(isset($drop) && !empty($drop))
                    {
                        $do[$key]['di'] = $drop;
                    }
                    else
                        unset($do[$key]);
                }
                $model = array('do'=>$do);
                self::Render('Operator.php', $model);
            break;
            case 3://Client
                $drops = CDataBase::GetAllDrops();
                $news = CDataBase::GetAllNews();
                $id = $_COOKIE['uid'];
                
                $countnew = 0;
                foreach($news as $key=>$val)
                {
                    if(CDataBase::UserSeeNews($id, $val['id']) === true)
                    {
                        unset($news[$key]);
                    }
                    else
                    {
                       $countnew++;
                    }
                    if($countnew>5)
                    {
                        unset($news[$key]);
                    }
                }
                $model = array('drops'=>$drops, 'news'=>$news);
                self::Render('Client.php', $model);
            break;
            default:
                $model = array('alert'=>'');
                self::Render('Main.php', $model);
            break;
        }
    }
    static function ResetStatistic()
    {
        if(self::UserCheck() == 1)
        {
            CDataBase::ResetStatistic();
            $model = array('alert'=>'Статистика обнулена');
            self::AdminPanel($alert = 'Статистика обнулена');
        }
    }
    static function AdminSearch($params)
    {
        if(self::UserCheck() == 1)
        {   
            $text = $params['Search'];
            $result = CDataBase::AdminSearch($text);
            $model = array('result'=>$result);
            self::Render('AdminSearch.php', $model);
        }
    }
    static function AdminTickets()
    {
        if(self::UserCheck() == 1)
        {
            $messages = CDataBase::AdminTickets();
            $model = array('id'=>0, 'messages'=>$messages);
            self::Render('AdminTickets.php', $model);
        }
    }
    static function AdminLookTicket($params)
    {
        if(self::UserCheck() == 1)
        {
            $id = $params['id'];
            //$messages = CDataBase::AdminLookTicket($id);
            $messages = CDataBase::ClientTickets($id);
            $messages = array_reverse($messages);
            $action = "AdminSendTickets($id)";
            $model = array('id'=>$id, 'action'=>$action, 'messages'=>$messages);
            self::Render('ClientTickets.php', $model);
        } 
    }
    static function ClientTickets()
    {
        if(self::UserCheck() == 3)
        {
            $id = $_COOKIE['uid'];
            $messages = CDataBase::ClientTickets($id);
            $messages = array_reverse($messages);
            $action = "ClientSendTickets($id)";
            $model = array('id'=>$id, 'action'=>$action, 'messages'=>$messages);
            self::Render('ClientTickets.php', $model);
        } 
    }
    static function GetNewMessages($id = 0)
    {
        if(self::UserCheck() == 3 || self::UserCheck() == 1)
        {
            
            $messages = CDataBase::ClientTickets($id);
            $messages = array_reverse($messages);
            $str = '';
            foreach($messages as $key=>$val)
            {
                $class = 'alert alert-dismissable alert-success';
                    if($val['fromid'] != 0)
                        $class = 'alert alert-dismissable alert-info';
                    $str .= "
                    <div class='messages $class'>
                        <div class='time'>{$val['cdate']}</div>
                        <div class='textm'>{$val['text']}</div>
                    </div>";
            }
            print $str;
        }
    }
    static function AdminCreateUser($params)
    {
        if(self::UserCheck() == 1)
        {
            $salt = 'lasASKFJASKFJ12ASFj';
            $params['password'] = md5(md5($params['password']).$salt);
            CDataBase::AdminCreateUser($params);
            $model = array('alert'=>'Пользователь создан');
            self::UserManager();
        }
    }
    static function AdminAction($params)
    {
        if(self::UserCheck() == 1) 
        {
            switch($params['AdAction'])
            {
                case 'DropEdit':
                    $rows = array();
                    $rows[':id'] = $params['id'];
                    $rows[':name'] = $params['name'];
                    $rows[':country'] = $params['country'];
                    $rows[':city'] = $params['city'];
                    $rows[':cat'] = $params['cat'];
                    CDataBase::AdminDropEdit($rows);
                    self::DropManager();
                break;
                case 'DroprDelete':
                    $rows = array();
                    $rows[':id'] = $params['id'];
                    CDataBase::AdminDroprDelete($rows);
                    self::DropManager();
                break;
                case 'AdminEditUser':
                    $rows = array();
                    $user = CDataBase::GetUserById($params['id']);
                    if($params['delete'] == 'true')
                        CDataBase::AdminDeleteUserById($params['id']);
                    else
                    {
                        if(strlen($params['password']) > 0)
                        {
                            $salt = 'lasASKFJASKFJ12ASFj';
                            $password = md5(md5($params['password']).$salt);
                            $rows[':password'] = $password;
                        }
                        else
                            $rows[':password'] = $user['password'];
                        $rows[':id'] = $params['id'];
                        $rows[':nickname'] = $params['nickname'];
                        $rows[':group'] = $params['group'];
                        CDataBase::AdminEditUser($rows);
                    }
                    self::UserManager();
                break;
                case 'AdminSendTickets':
                    $rows = array();
                    $rows[':iduser'] = $params['id'];
                    $rows[':text'] = $params['message'];
                    CDataBase::AdminSendTickets($rows);
                    self::GetNewMessages($params['id']);
                break;
                case 'AdminLookTicket':
                    $id = $params['id'];
                    $messages = CDataBase::AdminLookTicket($id);
                    self::AdminTickets();
                break;
            }
        }
    }
    static function ClientAction($params)
    {
        if(self::UserCheck() == 3)
        {
            switch($params['ClAction'])
            {
                case 'OrderGet':
                    $rows = array();
                    $rows[':drop_id'] = $params['id'];
                    $rows[':ordered_by'] = $params['COOKIE']['uid'];
                    $rows[':mtcn'] = $params['mtcn'];
                    $rows[':country'] = $params['country'];
                    $rows[':name'] = $params['name'];
                    $rows[':amount'] = $params['amount'];
                    $rows[':currency'] = $params['currency'];
                    $rows[':comment'] =  $params['comment'];
                    CDataBase::CLienGetOrder($rows);
                    //Смска если все заполненно
                    if(
                    !empty($params['mtcn']) &&
                    !empty($params['country']) &&
                    !empty($params['name']) &&
                    !empty($params['amount']) &&
                    !empty($params['currency']) &&
                    !empty($params['comment']))
                    {
                        $id = $_COOKIE['uid'];
                        $result = CDataBase::GetUserById($id);
                        $nick = $result['nickname'];
                        self::SendSMS($nick);
                    }
                break;
                case 'OrderEdit':
                    $rows = array();
                    $rows[':drop_id'] = $params['id'];
                    $rows[':ordered_by'] = $params['COOKIE']['uid'];
                    $rows[':mtcn'] = $params['mtcn'];
                    $rows[':country'] = $params['country'];
                    $rows[':name'] = $params['name'];
                    $rows[':amount'] = $params['amount'];
                    $rows[':currency'] = $params['currency'];
                    $rows[':comment'] =  $params['comment'];
                    CDataBase::CLienOrderEdit($rows);
                    $params = $params['COOKIE'];
                    self::MyAccount($params);
                    //Смска если все заполненно
                    if(
                    !empty($params['mtcn']) &&
                    !empty($params['country']) &&
                    !empty($params['name']) &&
                    !empty($params['amount']) &&
                    !empty($params['currency']) &&
                    !empty($params['comment']))
                    {
                        $id = $_COOKIE['uid'];
                        $result = CDataBase::GetUserById($id);
                        $nick = $result['nickname'];
                        self::SendSMS($nick);
                    }
                break;
                case 'OrderDelete':
                    $rows = array();
                    $rows[':drop_id'] = $params['id'];
                    $rows[':ordered_by'] = $params['COOKIE']['uid'];
                    CDataBase::CLienOrderDelete($rows);
                    $params = $params['COOKIE'];
                    self::MyAccount($params);
                break;
                case 'ClientChangeCategory':
                    $drops = CDataBase::GetAllDrops($params['cat']);
                    $model = array('drops'=>$drops, 'checed'=>$params['cat']);
                    self::Render('Client.php', $model);
                break;
                case 'ClientSendTickets':
                    $rows = array();
                    $rows[':iduser'] = $params['id'];
                    $rows[':text'] = $params['message'];
                    CDataBase::ClientSendTickets($rows);
                    self::GetNewMessages($_COOKIE['uid']);
                break;
                case 'ClientCloseNews':
                    CDataBase::ClientCloseNews($_COOKIE['uid'], $params['id']);
                    self::Main();
                break;
            }
        }
    }
    static function OperatorAction($params)
    {
        if(self::UserCheck() == 2 || self::UserCheck() == 1)
        {
            switch($params['OpAction'])
            {
                case 'clickOk':
                    CDataBase::DropOrdersStatus($params['id'], 1);
                    self::Main();
                    
                break;
                case 'clickCans':
                    CDataBase::DropOrdersStatus($params['id'], 2);
                    self::Main();
                    
                break;
            }
        }
    }
    static function UserInfo($params)
    {
        if(self::UserCheck() == 1)
        {
            $userinf = CDataBase::GetUserInfo($params['id']);
            $model = array('userinf'=>$userinf);
            self::Render('UserInfo.php', $model);
        }
    }
    static function DropInfo($params)
    {
        if(self::UserCheck() == 1)
        {
            $dropinf = CDataBase::GetDropInfo($params['id']);
            $model = array('dropinf'=>$dropinf);
            self::Render('DropInfo.php', $model);
        }
    }
    static function MyAccount()
    {
		if(self::UserCheck() == 3)
        {
			$drops = CDataBase::CLienGetOrderedDrops($_COOKIE['uid']);
			$model = array('drops'=>$drops);
			self::Render('ClientMyAccount.php', $model);
        }
    }
    static function DropManager()
    {
        if(self::UserCheck() == 1)
        {
            $drops = CDataBase::GetAllDrops();
            $model = array('drops'=>$drops);
            self::Render('DropManager.php', $model);
        }
    }
    static function UserManager()
    {
        if(self::UserCheck() == 1)
        {
            $users = CDataBase::GetAllUser();
            $model = array('users'=>$users);
            self::Render('UserManager.php', $model);
        }
    }
    static function DropArchive()
    {
        if(self::UserCheck() == 1)
        {   
            self::Render('DropArchive.php');
        }
    }
    static function AdminCreateDrop($params)
    {
        if(self::UserCheck() == 1)
        {
            $params['cat'] = $params['cat'];
            CDataBase::AdminCreateDrop($params);
            $model = array('alert'=>'Дроп создан');
            self::DropManager();
        }
    }
    static function AdminCreateNews($params)
    {
        if(self::UserCheck() == 1)
        {
            CDataBase::AdminCreateNews($params);
            $model = array('alert'=>'Новость создана');
            self::Render('AdminPanel.php', $model);
        }
    }
    static function HeaderCreate()
    {
        switch(self::UserCheck())
        {
            case 1:
                self::$header[] = "<a href='/'>Операции</a>";
                self::$header[] = "<a href='/?action=AdminPanel'>Настройки</a>";
                self::$header[] = "<a href='/?action=DropManager'>Дропы</a>";
                self::$header[] = "<a href='/?action=UserManager'>Пользователи</a>";
                self::$header[] = "<a href='/?action=AdminTickets'>Тикеты</a>";
                self::$header[] = '
                <form class="navbar-form navbar-left" name="Search" action="" method="post">
                    <input type="hidden" name="action" value="AdminSearch"/>
                    <input type="text" name="Search" class="form-control col-lg-8" placeholder="Поиск...">
                </form>
                ';
                self::$header[] = "<a href='?action=Logout'>Выход</a>";
            break;
            case 2:
                self::$header[] = "<a href='?action=Logout'>Выход</a>";
            break;
            case 3:
                self::$header[] = "<a href='/'>Дропы</a>";
    			self::$header[] = "<a href='/?action=MyAccount'>Мой кабинет</a>";
    			self::$header[] = "<a href='/?action=ClientTickets'>Тикеты</a>";
                self::$header[] = "<a href='/?action=Logout'>Выход</a>";
            break;
        }
    }
    static function AdminPanel($alert = '')
    {
        if(self::UserCheck() == 1)
        {
            $result = CDataBase::GetSMSNumber();
            $stat = CDataBase::GetStatistic();
            $model = array('stat'=>$stat, 'PhoneNumber'=>$result['PhoneNumber'], 'alert'=>$alert);
            self::Render('AdminPanel.php', $model);
        }
    }
    static function AdminChangeSMS($params)
    {
        if(self::UserCheck() == 1)
        {
            CDataBase::SetSMSNumber($params);
            self::AdminPanel('Номер изменен');
        }
    }
    static function Logout()
    {
        if(self::UserCheck() > 0)
        {
            CDataBase::DeleteSession($_COOKIE['sess'], $_COOKIE['uid']);
            setcookie('sess', '', time() * 2);
            setcookie('uid', '', time() * 2);
            header('Location: /');
        }
    }
    static function Login($params)
    {
        $login = $params['login'];
        $password = $params['password'];
        $salt = 'lasASKFJASKFJ12ASFj';
        $password = md5(md5($password).$salt);
        $result = CDataBase::Login($login, $password);
        if(count($result) > 0)
        {
            $name = md5($login.$password.mt_rand(11111, 999999));
            $time = time() + (60 * 60 * 24 * 7);
            $userid = $result[0]['id'];
            CDataBase::InsertSession($name, $time, $userid); 
            setcookie('sess', $name, $time);
            setcookie('uid', $userid, $time);
            header('Location: /');
        }
        else
        {
            $model = array('alert'=>'Неправильный логин или пароль');
            self::Render('Main.php', $model);
        }
    }
    static function SendSMS($str)
    {
        $result = CDataBase::GetSMSNumber();
        if(isset($str) && isset($result))
        {
            if(!empty($str) && !empty($result))
            {
                if(strlen($str) > 0 && count($result) > 0)
                {
                    $phones = $result['PhoneNumber'];
                    if(strlen($phones) > 0)
                    {
                        $login = 'Bonik';
                        $psw = '3536265asd';
                        $mes = "У вас новая заявка от: $str";
                        $sendstr = "http://smsc.ru/sys/send.php?login=$login&psw=$psw&phones=$phones&mes=$mes";
                        $sendstr = iconv('UTF-8', 'windows-1251', $sendstr);
                        file_get_contents($sendstr);
                    }
                }
            }
        }
    }
    static function UserCheck($cookie = null)
    {
		if(isset($cookie))
			$_COOKIE = $cookie;
        if(isset($_COOKIE) && !empty($_COOKIE))
        {
            $_COOKIE = self::ClearHtml($_COOKIE);
            if(isset($_COOKIE['uid']) && isset($_COOKIE['sess'])
             && !empty($_COOKIE['uid']) && !empty($_COOKIE['sess'])
            )
            {
                $id = $_COOKIE['uid'];
                $name = $_COOKIE['sess'];
                $res = CDataBase::CookieLogin($id, $name);
                if(isset($res) && !empty($res))
                {
                    $useer = CDataBase::GetUserById($id);
                    if(isset($useer['group']))
                    {
                        return $useer['group'];
                    }
                }
            }
        }
        return 0;
    }
    static function ClearHtml($mass) 
    {
        foreach($mass as $key=>$val)
        {
            $mass[$key] = trim($mass[$key]);
            $mass[$key] = stripslashes($mass[$key]);
            $mass[$key] = htmlspecialchars($mass[$key]);
        }
        return $mass;
    }
    static function Render($page='', $model=null)
    {
        $header = '';
        $cur = -1;
        $uri = explode('&', $_SERVER['REQUEST_URI']);
        $uri = $uri[0];
        foreach(self::$header as $key=>$val)
        {
            $pos = strpos($val, $uri);
            if (!$pos === false)
            {
               $cur = $key;
               break;
            }
        }
        foreach(self::$header as $key=>$val)
        {
            $class = '';
            if($cur == $key)
                $class .= 'active ';
            if($key == count(self::$header)-1)
                $class .= 'exit ';
            $header .= "<li class='$class'>$val</li> ";    
        }
        if(isset($model))
        {
            extract($model, EXTR_PREFIX_SAME, '');
        }
        require_once('header.php');
        require_once($page);
        require_once('footer.php');
    }
}                       