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
                <input type="hidden" name="action" value="AdminCreateNews" />
                <h5>Создать уведомление</h5>
                <br />
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
                <input type="hidden" name="action" value="AdminChangeSMS" />
                <input type="hidden" name="id" value="1" />
                <h5>Номер телефона</h5>
                <div>
                    <input type='text' name="PhoneNumber" placeholder="Телефон" value="<?= $PhoneNumber ?>" />
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
                <input type="hidden" name="action" value="ResetStatistic" />
                <br />
                <button class="btn btn-primary btn-sm">Сбросить статистику</button>
            </form>
        </div>

		<div class="LeftOption">
			<button onclick='ModalOpen()' class="btn btn-danger btn-sm">
				Очистить заявки
			</button>
		</div>
    </div>
</div>

<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="ModalClose()" type="button" class="close">×</button>
                <h4 class="modal-title">
					Вы уверены что хотите удалить все заявки? Внимание! Необработанные заявки будут тоже удалены!
				</h4>
            </div>

			<form class='form-horizontal' method='post' name='modalform' action=''>
				<fieldset>
					<input type="hidden" name="action" value="ClearDropOrder" />
					<div class="modal-body">
						<div class='form-group'>
							<div class="col-lg-10">
								<div class="checkbox">
									<label>
										<input onclick="ConfirmClick()" type="checkbox" name="iconfirm"/>
										Да я хочу удалить все заявки
									</label>
								</div>
							</div>
						</div>
					</div>
	            <div class="modal-footer">
					<button onclick="ModalClose()" type="button" class="btn btn-default">Отмена</button>
					<input name="SaveBtn" type="submit" value="Удалить" id="SaveBtn"
						class="btn btn-danger SaveBtn disabled"/>
				</div>
				</fieldset>
			</form>

        </div>
    </div>
</div>


      

