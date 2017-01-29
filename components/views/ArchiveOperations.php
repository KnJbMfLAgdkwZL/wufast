<div class="Content">
    <div class="dropcategory">
        <span class='catelm centrdropclient'>
            <a href="/?action=ArchiveOperations&amp;status=-1&amp;page=0" class="btn btn-info btn-sm">
                Все
            </a>
        </span>
        <span class='catelm centrdropclient'>
            <a href="/?action=ArchiveOperations&status=0&page=0" class="btn btn-success btn-sm">Ожидание</a>
        </span>
        <span class='catelm'>
            <a href="/?action=ArchiveOperations&status=1" class="btn btn-primary btn-sm">Обработан</a>
        </span>
        <span class='catelm'>
            <a href="/?action=ArchiveOperations&status=2" class="btn btn-warning btn-sm">Отказано</a>
        </span>
    </div>
<?php
$str = ""; 
if(isset($archive) && !empty($archive) && count($archive)>0)
{          
    foreach($archive as $key=>$val)
    {
        $cat = '';
        switch($val['Dcat'])
        {  
            case 0:
                $cat = 'Luxury Drop';
            break;
            case 1:
                $cat = 'Dating Scam Drop';
            break;
            case 2:
                $cat = 'Personal Drop';
            break;
        }  
        $clordstat = '';
        $stat = '';
        $dis = '';
        switch($val['DOstatus'])
        {  
            case 0:
                $stat = 'Ожидание';
                $clordstat = 'obrab';
                break;
            case 1:
                $stat = 'Обработан';
                $clordstat = 'odobr';
                $dis = '<br/>';
                break;
            case 2:
                $stat = 'Отказано';
                $clordstat = 'otkaz';
                $dis = '<br/>';
                break;
        }
        if($status == $val['DOstatus'] || $status < 0)
        {  
            $str .= "
            <div>
                <div class='OperatorDrops orderclientmyacc $clordstat'>
                    <h4>$stat</h4>
                    <div>
                        <span class='cdate'>{$val['Dcdate']}</span><br/>
                        <span class='mtcn'>{$val['Dname']}</span>
                        <span class='country'>{$val['Dcountry']}</span>
                        <span>{$val['Dcity']}</span>
                        <span>$cat</span>
                    </div>
                    <br/>
                    <div>
                        <span>{$val['DOmtcn']}</span>
                        <span>{$val['DOcountry']}</span>
                        <span>{$val['DOname']}</span>
                        <br/>
                        <span class='amountclient'>{$val['DOamount']}</span>
                        <span>{$val['DOcurrency']}</span>
                        <br/>
                        <span>{$val['DOcomment']}</span>
                        <br/>
                        <span class='cdate'>{$val['DOorder_creation']}</span>
                    </div>
                    <a href='/?action=UserInfo&id={$val['ordered_by']}'>user info</a>
                </div>
            </div>";
        }
    }      
}          
else       
{          
    $str = '<br/><br/><h2>Нету заказов</h2>';
}          
print $str;
?>

    <ul class="pagination">
        <?php
        if($pages!="")
        {
            //$pages = "Страницы: $pages";
            echo "$pages";
        }
        ?>
    </ul>
</div>

