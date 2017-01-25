        <div class="Content">
            <div id="messages">
                <?php
                $str = '';
                foreach($messages as $key=>$val)
                {
                    $class = 'adminmes';
                    if($val['fromid'] != 0)
                        $class = 'clienmes';
                    $str .= "
                    <div class='$class'>
                        <div class='time'>{$val['cdate']}</div>
                        <div class='textm'>{$val['text']}</div>
                    </div>";
                }
                print $str;
                ?>
            </div>
            <form name="SendTicketForm" action="javascript:void(null)" method="post">
                <div>
                    <textarea rows='10' cols='92' name="message" id="message" maxlength="2990"></textarea>
                </div>
                <div>                
                    <input onclick="<?= $action ?>" type="submit" value="Отправить" />
                </div>
            </form>
        <script>
            ClientTimerChatStart(<?= $id ?>);
        </script>
        </div>