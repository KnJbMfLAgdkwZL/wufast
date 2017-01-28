<?php
class CDataBase
{
    static protected $Host = 'localhost';
    static protected $DBname = 'mcxrcjrb_db';
    static protected $Username = 'mcxrcjrb_db';
    static protected $Password = 'DD7uhPuA';
    static protected $DBH;
    static function Connect()
    {
        if(!isset(self::$DBH))
        {
            $Connection = 'mysql:host='.self::$Host.';dbname='.self::$DBname.';charset=utf8';
            self::$DBH = new PDO($Connection, self::$Username, self::$Password);
        }
    }
    static function Disconnect()
    {
        self::$DBH = null;
    }
    static function Execute($sql, $params=null)
    {
        self::Connect();
        $stm = self::$DBH->prepare($sql);
        $stm->execute($params);
        $items = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }
    static function CLienGetOrderedDrops($clientid)
    {
        $sql = 'SELECT drop_orders.id as DOid, drop_orders.drop_id as DOdropid, drop_orders.`status` as DOstat,
        drop_orders.ordered_by as DOorderby, drop_orders.mtcn as DOmtcn, drop_orders.country as DOcountry,
        drop_orders.`name` as DOname, drop_orders.amount as DOamount, drop_orders.currency as DOcurcy,
        drop_orders.`comment` as DOcomt, drop_orders.order_creation as DOordcrt, drops.id as Did,
        drops.cdate as Dcdate, drops.frozen_till as Dfrozentill, drops.`name` as Dname,
        drops.country as Dcountry, drops.city as Dcity, drops.cat as Dcat
        FROM `drop_orders`, drops
        WHERE drop_orders.ordered_by = :clientid
        AND drop_orders.drop_id = drops.id
        AND drops.count > -1
        ORDER BY drop_orders.id DESC, drop_orders.name';
        $params = array(':clientid'=>$clientid);
        $result = self::Execute($sql, $params);
        return $result;
    }
    static function GetUserInfo($id)
    {
         $sql = 
         'SELECT
            drop_orders.mtcn as DOmtcn,
            drop_orders.`status` as DOstatus,
            drop_orders.country as DOcountry,
            drop_orders.`name` as DOname,
            drop_orders.amount as DOamount,
            drop_orders.currency as DOcurrency,
            drop_orders.`comment` as DOcomment,
            drop_orders.order_creation as DOorder_creation,
            drops.cdate as Dcdate,
            drops.`name` as Dname,
            drops.count as Dcount,
            drops.country as Dcountry,
            drops.city as Dcity,
            drops.cat as Dcat,
            drops.count as Dcount
        FROM `drop_orders`, `drops`
        WHERE drop_orders.ordered_by = :id
        AND drop_orders.drop_id = drops.id
        AND drops.count > -1
        ORDER BY Dcdate DESC';
        $params = array(':id'=>$id);
        return self::Execute($sql, $params);                
            
    }  
    static function GetDropInfo($id)
    {
        $sql = 'SELECT
        drop_orders.`status`,
        drop_orders.ordered_by,
        drop_orders.mtcn,
        drop_orders.country,
        drop_orders.`name`,
        drop_orders.amount,
        drop_orders.currency,
        drop_orders.`comment`,
        drop_orders.order_creation,
        users.nickname
        FROM `drop_orders`,
        users
        WHERE `drop_orders`.drop_id = :id
        AND users.id = drop_orders.ordered_by
        ORDER BY drop_orders.order_creation DESC';
        $params = array(':id'=>$id);
        return self::Execute($sql, $params); 
    }
    static function CLienOrderDelete($params)
    {
        $sql = 'DELETE FROM `drop_orders` WHERE id = :drop_id AND ordered_by = :ordered_by'; 
        $result = self::Execute($sql, $params);
    }
    static function AdminDroprDelete($params)
    {        
        $sql = 'UPDATE `drops` SET count = -1 WHERE id = :id';
        $result = self::Execute($sql, $params);
    }
    static function ClientSendTickets($params)
    {
        $sql = 'INSERT INTO `tickets`(fromid, text) VALUES(:iduser, :text)';
        self::Execute($sql, $params);
    }
    static function AdminSendTickets($params)
    {
        $sql = 'INSERT INTO `tickets`(toid, text) VALUES(:iduser, :text)';
        self::Execute($sql, $params);
    }
    static function AdminTickets()
    {
        $sql = 'SELECT users.id, users.nickname, tickets.cdate, tickets.text
            FROM tickets, users
            WHERE tickets.toid = 0
            AND tickets.fromid != 0
            AND tickets.fromid = users.id
            AND tickets.new = 1
            GROUP BY users.id
            ORDER BY tickets.cdate DESC';
        return self::Execute($sql);
    }
    static function AdminLookTicket($id)
    {
        $sql = 'UPDATE tickets SET new = 0
        WHERE tickets.toid = :id
        OR tickets.fromid = :id';
        $params = array(':id'=>$id);
        self::Execute($sql, $params);
    }
    static function GetStatistic()
    {
        $sql = 'SELECT * FROM statistic';
        $result = self::Execute($sql);
        if(isset($result) && !empty($result) && count($result)>0)
            return $result[0];
        return false;
    }
    static function ResetStatistic()
    {
        $sql = 'UPDATE statistic
        SET
        AmountForDay = 0,
        AmountForWeek = 0,
        AmountForMonth = 0,
        AmountForAllTime = 0,
        Day = :date,
        Week = :date,
        Month = :date
        WHERE id = 1';
        $date = date('Y-m-d h:i:s', time());
        $params = array(':date'=>$date);
        self::Execute($sql, $params);
    }
    static function AddToStatistic($amn)
    {
        $stat = CDataBase::GetStatistic();
        
        $Day = explode(' ', $stat['Day']);
        $Day = $Day[0];
        $Day = explode('-', $Day);
        
        $Week = explode(' ', $stat['Week']);
        $Week = $Week[0];
        $Week = explode('-', $Week);
        
        $Month = explode(' ', $stat['Month']);
        $Month = $Month[0];
        $Month = explode('-', $Month);
        
        $date = date('Y-m-d h:i:s', time());
        $datefirst = explode(' ', $date);
        $datefirst = $datefirst[0];
        $Current = explode('-', $datefirst);
        
        if($Day[2] < $Current[2])//Обнуляем день
        {
            $sql = 'UPDATE statistic SET
            AmountForDay = 0,
            Day = :date
            WHERE id = 1';
            $params = array(':date'=>$date);
            self::Execute($sql, $params);
        }
        if($Week[2] + 7 < $Current[2])//Обнуляем неделю
        {
            $sql = 'UPDATE statistic SET
            AmountForWeek = 0,
            Week = :date
            WHERE id = 1';
            $params = array(':date'=>$date);
            self::Execute($sql, $params);
        }
        if($Month[1] < $Current[1])//Обнуляем месяц
        {
            $sql = 'UPDATE statistic SET
            AmountForMonth = 0,
            Month = :date
            WHERE id = 1';
            $params = array(':date'=>$date);
            self::Execute($sql, $params);
        }
        $sql = 'UPDATE statistic
        SET
        AmountForDay = :AmountForDay,
        AmountForWeek = :AmountForWeek,
        AmountForMonth = :AmountForMonth,
        AmountForAllTime = :AmountForAllTime
        WHERE id = 1';
        $params = array(
            ':AmountForDay' => $stat['AmountForDay'] + $amn,
            ':AmountForWeek' => $stat['AmountForWeek'] + $amn,
            ':AmountForMonth' => $stat['AmountForMonth'] + $amn,
            ':AmountForAllTime' => $stat['AmountForAllTime'] + $amn,
        );
        self::Execute($sql, $params);
    }
    static function AdminSearch($text)
    {
        $text = "%$text%";
        $sql = 'SELECT * FROM drop_orders
        
        WHERE drop_orders.mtcn LIKE :text
        OR drop_orders.country LIKE :text
        OR drop_orders.`name` LIKE :text
        OR drop_orders.amount LIKE :text
        OR drop_orders.currency LIKE :text
        OR drop_orders.comment LIKE :text
        
        ORDER BY drop_orders.order_creation DESC';
        $params = array(':text'=>$text );
        return self::Execute($sql, $params);
    }
    static function ClientTickets($id)
    {
        $sql = 'SELECT * FROM tickets WHERE fromid = :id OR toid = :id ORDER BY cdate DESC LIMIT 8';
        $params = array(':id'=>$id);
        return self::Execute($sql, $params);
    }
    static function AdminCreateNews($params)
    {
        $sql = 'INSERT INTO `news`(newstext) VALUES(:newstext)';
        $params = array(':newstext'=>$params['newstext']);
        self::Execute($sql, $params);
    }
    static function ClientCloseNews($id, $idNews)
    {
        $sql = 'INSERT INTO `newsusers`(iduser, idnews) VALUES(:id, :idNews)';
        $params = array(':id'=>$id, ':idNews'=>$idNews);
        self::Execute($sql, $params);
    }
    static function UserSeeNews($id, $news)
    {
        $sql = 'SELECT * FROM newsusers WHERE iduser = :id AND idnews = :news';
        $params = array(':id'=>$id, ':news'=>$news);
        $result = self::Execute($sql, $params);
        if(isset($result) && !empty($result))
            if(count($result)>0)
                return true;
        return false;
    }
    static function GetAllNews()
    {
        $sql = 'SELECT * FROM news ORDER BY news.datecreate ASC';
        return self::Execute($sql);
    }
    static function AdminCreateDrop($params)
    {
        $count = 999999;
        if($params['cat'] == 0)
            $count = 1;
        $par = array(
            ':name'=>$params['name'],
            ':country'=>$params['country'],
            ':city'=>$params['city'],
            ':cat'=>$params['cat'],
            ':count'=>$count
            );
        $sql = 'INSERT INTO `drops`(name, country, city, cat, count)
        VALUES(:name, :country, :city, :cat, :count);';
        $result = self::Execute($sql, $par);
    }
    static function GetSMSNumber()
    {
        $sql = 'SELECT * FROM smsnumber';
        $result = self::Execute($sql);
        if(isset($result) && !empty($result) && count($result)>0)
            return $result[0];
        return false;
    }
    static function SetSMSNumber($params)
    {
        $sql = 'UPDATE smsnumber SET PhoneNumber = :PhoneNumber WHERE id = :id';
        self::Execute($sql, $params);
    }
    static function AdminDropEdit($params)
    {
        $count = 999999;
        if($params[':cat'] == 0)
            $count = 1;
        $params[':count'] = $count;
        $sql = 'UPDATE `drops`
        SET name = :name, country = :country, city = :city, cat = :cat, count = :count
        WHERE id = :id';
        //var_dump($params);exit;
        $result = self::Execute($sql, $params);
    }
    static function AdminEditUser($params)
    {
        $sql = 'UPDATE `users`
        SET nickname = :nickname, password = :password, `group` = :group
        WHERE id = :id';
        $result = self::Execute($sql, $params);
    }
    static function AdminDeleteUserById($id)
    {
        $sql = 'DELETE FROM `users` WHERE id =:id';
        $params = array(':id'=>$id);
        return self::Execute($sql, $params);
    }
    static function AdminCreateUser($params)
    {
        $par = array(
            ':nickname'=>$params['nickname'],
            ':password'=>$params['password'],
            ':group'=>$params['group']);
        $sql = 'INSERT INTO users(users.nickname, users.password, users.group)
        VALUES(:nickname, :password, :group);';
        $result = self::Execute($sql, $par);
    }
    static function CLienOrderEdit($params)
    {
        $sql = 'UPDATE `drop_orders`
        SET mtcn = :mtcn, country = :country, name = :name, 
        amount = :amount, currency = :currency, comment = :comment
        WHERE id = :drop_id AND ordered_by = :ordered_by';
        $result = self::Execute($sql, $params);
    }
    static function CLienGetOrder($params)
    {
        $result = self::GetDropsById($params[':drop_id']);
        $count = $result['count'] - 1;
        $sql = 'UPDATE `drops` SET count = :count WHERE id = :id';
        self::Execute($sql, array(':count'=>$count, ':id'=>$params[':drop_id']));
        $sql = 'INSERT INTO `drop_orders`(drop_id, ordered_by, mtcn, country, name, amount, currency, comment)
        VALUES(:drop_id, :ordered_by, :mtcn, :country, :name, :amount, :currency, :comment)';
        self::Execute($sql, $params);
    }
    static function DropOrdersStatus($id, $status)
    {
        $sql = 'UPDATE `drop_orders` SET status= :sta WHERE id= :i';
        $params = array(':sta'=>$status, ':i'=>$id);
        self::Execute($sql, $params);
        $amn = 0;
        $ordr = self::GetDropOrdersById($id);
        if(isset($ordr['amount']) && !empty($ordr['amount']) && is_numeric($ordr['amount']))
            $amn = $ordr['amount'];
        self::AddToStatistic($amn);
    }
    static function GetDropOrdersById($id)
    {
        $sql = 'SELECT * FROM `drop_orders` WHERE id = :id';
        $params = array(':id'=>$id);
        $result = self::Execute($sql, $params);
        if(isset($result[0]) && !empty($result[0]))
        {
            return $result[0];
        }
        return null;
    }
    static function GetDropOrders()
    {
        $sql = 'SELECT *
        FROM `drop_orders`
        WHERE drop_orders.status = 0
        ORDER BY id DESC, name';
        return self::Execute($sql);
    }
    static function GetAllDrops($cat=-1)
    {
        if($cat < 0)
        {
            $sql = 'SELECT * 
            FROM `drops`
            WHERE count > -1
            AND count > 0
            ORDER BY id DESC
            ';
            return self::Execute($sql);
        }
        else
        {
            $sql = 'SELECT * 
            FROM `drops`
            WHERE count > -1
            AND count > 0
            AND cat = :cat
            ORDER BY id DESC
            ';
            $params = array(':cat'=>$cat);
            return self::Execute($sql, $params);
        }
    }
    static function GetDropsById($drop_id)
    {      
        $sql = '
        SELECT * 
        FROM `drops` 
        WHERE id = :drop_id
        AND drops.count > -1
        ';
        $params = array(':drop_id'=>$drop_id);
        $result = self::Execute($sql, $params);
        if(isset($result[0]) && !empty($result[0]))
        {
            return $result[0];
        }
        return null;
    }
    static function Login($login, $password)
    {        
        $sql = 'SELECT * FROM `users` WHERE nickname=:login AND password=:password';
        $params = array(':login'=>$login, ':password'=>$password);
        return self::Execute($sql, $params);
    }
    static function CookieLogin($id, $name)
    {
        $sql = 'SELECT * FROM `sessions` WHERE session=:name AND userid=:id';
        $params = array(':name'=>$name, ':id'=>$id);
        $result = self::Execute($sql, $params);
        if(isset($result))
            if(count($result) > 0)
                return true;
        return false;
    }
    static function GetAllUser()
    {
        $sql = 'SELECT * FROM `users`';
        return self::Execute($sql);
    }                    
    static function GetUserById($id)
    {
        $sql = 'SELECT * FROM `users` WHERE id = :iduser';
        $params = array(':iduser'=>$id);
        $result = self::Execute($sql, $params);
        if(count($result)>0)
            return $result[0];
        else
            return null;
    }
    static function InsertSession($name, $time, $id)
    {        
        $sql = 'INSERT INTO `sessions` (session, lifetime, userid) VALUES (:name, :time, :id)';
        $params = array(':name'=>$name, ':time'=>$time, ':id'=>$id);
        return self::Execute($sql, $params);
    }
    static function DeleteSession($name, $id)
    {
        $sql = 'DELETE FROM `sessions` WHERE `session`=:name AND userid =:id';
        $params = array(':name'=>$name, ':id'=>$id);
        return self::Execute($sql, $params);
    }
}
                            
                            