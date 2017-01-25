        <div class="Content">
            <br />
            <div class="newticikforadmin">
                <?php
                $str = "";
                if(isset($messages) && !empty($messages) && count($messages)>0)
                {
                    $str .= "<h3>Новые Тикеты:</h3>";
                    foreach($messages as $key=>$val)
                    {
                        $text = $val['text'];
                        if(strlen($text) > 50)
                            $text = substr($text, 0, 50)."...";
                        $str .= "<div class='adminticketwraper'>
                            <span onclick='AdminLookTicket({$val['id']})' class='closetickadmin'>x</span>
                            <a class='adminticketuri' href='/?action=AdminLookTicket&id={$val['id']}'>
                                <div class='cdate'>{$val['cdate']}</div>
                                <div class='nickname'>{$val['nickname']}</div>
                                <div class='text'>$text</div>
                            </a>
                        </div>";
                    }
                }
                else
                {
                    $str = '<br/><br/><h2>Новых тикетов нет</h2>';
                }
                print $str;
                ?>
            </div>
        </div>