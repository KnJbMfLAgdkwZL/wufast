        <div class="Content">
            <?php
                if(isset($alert) && !empty($alert))
                {
                    print "<script>alert('$alert')</script>";
                }
            ?>
            
        <div class="mid">
            <div class="LeftOption">
                <form action="" method="post">
                    <input type="hidden" name="action" value="AdminCreateNews"/>
                    <h5>Создать уведомление</h5><br />
                    <span>Текст уведомления: </span>
                    <div>
                        <textarea rows='5' cols='40' name="newstext" maxlength="1000"></textarea>                        
                    </div>  
                    <br />
                    <button class="btn btn-primary btn-sm">Создать уведомление</button>
                </form>
                <br />
            </div>
            
            <div class="LeftOption">
                <form action="" method="post">
                    <input type="hidden" name="action" value="AdminChangeSMS"/>
                    <input type="hidden" name="id" value="1"/>
                    <h5>Номер телефона</h5>
                    <div>
                        <input type='text' name="PhoneNumber" placeholder="Телефон" value="<?= $PhoneNumber ?>"/>                      
                    </div>
                    <br />
                    <button class="btn btn-primary btn-sm">Сменить номер</button>
                </form>
            </div>
            
            <div class="LeftOption">
                <h5>Статистика</h5>
                <samp>Amount For Day: </samp><?= $stat['AmountForDay'] ?><br />
                <samp>Amount For Week: </samp><?= $stat['AmountForWeek'] ?><br />
                <samp>Amount For Month: </samp><?= $stat['AmountForMonth'] ?><br />
                <samp>Amount For AllTime: </samp><?= $stat['AmountForAllTime'] ?><br />
                <form action="" method="post">
                    <input type="hidden" name="action" value="ResetStatistic"/>
                    <br />
                    <button class="btn btn-primary btn-sm">Сбросить статистику</button>
                </form>
            </div>
        </div>
            

            
        </div>