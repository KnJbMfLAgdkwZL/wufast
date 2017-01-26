        <div class="Content">
            <div id="messages">
                <?php
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
                ?>
            </div>
            <br />
            <form name="SendTicketForm" action="javascript:void(null)" method="post" class="formmess">
                <div class="col-lg-10 textchatwraper">
                    <textarea maxlength="2000" name="message" id="message" rows='5' cols='40' class="form-control" rows="3" id="textArea"></textarea>
                </div>
                <br />
                <input class="btn btn-primary btnsendmess" onclick="<?= $action ?>" type="submit" value="Отправить" />
            </form>
            <script>
                ClientTimerChatStart(<?= $id ?>);
            </script>
        </div>