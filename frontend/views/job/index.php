<div class="small-banner job-banner">
	Вакансии
</div>

<div class="wrapper menu-page">

	<div class="middle">

		<div class="contain">
			<div class="content">
				<ul class="vacansy-list">
					<li class="povar">повара</li>
					<li class="waiter">официанты</li>
					<li class="operator">оператор доставки</li>
					<li class="courier">курьеры с личным автомобилем</li>
				</ul>
				
				<div class="portlet job-portlet">
					<div class="portlet-headline">Анкета соискателя</div>
					<div class="portlet-body">
					
						<div class="control-group width-440 pull-left mr-25">
							<input type="text" class="input-text max" placeholder="ФИО" id="job-name">
						</div>
						
						<div class="control-group width-190 pull-left">
							<input type="text" class="input-text max" placeholder="Гражданство" id="job-nationality">
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<div class="control-group width-105 pull-left mr-25 h32">
							<label class="input-text-label">Дата рождения</label>
						</div>
						
						<div class="control-group width-60 pull-left mr-25">
							<select class="select max" id="job-BDay">
								<?php for ($i = 1; $i < 32; $i++):?>
									<option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
								<?php endfor;?>
							</select>
						</div>
						
						<div class="control-group width-100 pull-left mr-25">
							<select class="select max" id="job-BMonth">
									<option value="1">январь</option>
									<option value="2">феваль</option>
									<option value="3">март</option>
									<option value="4">апрель</option>
									<option value="5">май</option>
									<option value="6">июнь</option>
									<option value="7">июль</option>
									<option value="8">август</option>
									<option value="9">сентябрь</option>
									<option value="10">октябрь</option>
									<option value="11">ноябрь</option>
									<option value="12">декабрь</option>
							</select>
						</div>
						
						<div class="control-group width-100 pull-left mr-25">
							<select class="select max" id="job-BYear">
								<?php for ($i = 2005; $i > 1960; $i--):?>
									<option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
								<?php endfor;?>
							</select>
						</div>
						
						<div class="control-group width-190 pull-left">
							<input type="text" class="input-text max" placeholder="Телефон для связи" id="job-phone">
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<div class="control-group mb-15">
							<input type="text" class="input-text max" placeholder="Email" id="job-email">
						</div>
						
						<div class="control-group mb-15">
							<input type="text" class="input-text max" placeholder="Фактический адрес проживания" id="job-addr">
						</div>
						
						<div class="control-group mb-15">
							<input type="text" class="input-text max" placeholder="Предыдущее или настоящее место работы/учебы" id="job-lastJob">
						</div>
						
						<div class="control-group width-315 pull-left mr-25 h32">
							<label class="input-text-label">ВЫБЕРИТЕ РЕСТОРАН, ГДЕ ЖЕЛАЕТЕ РАБОТАТЬ</label>

						</div>
						
						<div class="control-group width-315 pull-left h32">
							<label class="input-text-label">РАБОТУ В РЕСТОРАНАХ РАССМАТРИВАЮ КАК:</label>
						</div>
						
						<div class="clearfix"></div>
						
						<div class="control-group width-315 pull-left mr-25">
							<div class="radiobuttons-group mb-10">
								<!-- 
								<div class="mb-5">
									<input type="radio" name="place" id="job-place1" value="Московское ш. 81б" >
									<label class="radio-custom" for="job-place1">Московское ш. 81б</label>
								</div>
								-->
								<div class="mb-5">
									<input type="radio" name="place" id="job-place2" value="Куйбышева, 86" checked>
									<label class="radio-custom" for="job-place2">Куйбышева, 86</label>
								</div>
								<!--
								<div>
									<input type="radio" name="place" id="job-place3" value="Могу работать везде">
									<label class="radio-custom" for="job-place3">Могу работать везде</label>
								</div>
								-->
							</div>
						</div>
						
						<div class="control-group width-315 pull-left">
							<div class="radiobuttons-group mb-10">
								<div class="mb-5">
									<input type="radio" name="workType" id="job-workType1" value="Основная работа" checked>
									<label class="radio-custom" for="job-workType1">Основная работа</label>
								</div>
								<div class="mb-5">
									<input type="radio" name="workType" id="job-workType2" value="Работа по совместительству">
									<label class="radio-custom" for="job-workType2">Работа по совместительству</label>
								</div>
								<div class="mb-5">
									<input type="radio" name="workType" id="job-workType3" value="Работа в свободное от учебы время">
									<label class="radio-custom" for="job-workType3">Работа в свободное от учебы время</label>
								</div>
							</div>
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<div class="control-group width-315 pull-left mr-25">
							<input type="text" class="input-text max" placeholder="Желаемая должность" id="job-profession">
						</div>
						
						<div class="control-group width-315 pull-left">
							<input type="text" class="input-text max" placeholder="Желаемый грфик работы" id="job-grafic">
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<input type="checkbox" name="az" checked id="job-confirm">
						<label class="checkbox-custom" for="job-confirm">Я согласен с тем, что мои персональные данные будут <br>использоваться для решения вопроса о моем трудоустройстве.</label>
						
						<div class="clearfix mb-15"></div>
						
						<div class="cart-button clearfix mr-20" id="jobSubmit">Отправить</div>
						
						<div class="clearfix"></div>
						
					</div>
				</div>
				
			</div>
			
		</div>
			
		<div class="left-sidebar">
			
		</div><!-- .left-sidebar -->
			

	</div>

</div><!-- .wrapper -->

<div class="bottom-border"></div>

<script type="text/javascript">

	$(document).ready(function() {
	
		$("#job-phone").inputmask({"mask": "+7 (999) 999-99-99"});

		$("#jobSubmit").on("click", function() {
			var data = new Object;
			data['job'] = new Object;
			var tm;

			tm = $("#job-name").val();
			if (tm == "") {
				Alert("Необходимо указать имя!");
				return;
			}
			data['job']['name'] = tm;

			tm = $("#job-nationality").val();
			if (tm == "") {
				Alert("Необходимо указать национальность!");
				return;
			}
			data['job']['nationality'] = tm;

			tm = $("#job-phone").val();
			if (!$("#job-phone").inputmask("isComplete")) {
				Alert("Необходимо указать телефон!");
				return;
			}
			data['job']['phone'] = tm;

			tm = $("#job-BDay").val();
			data['job']['BDay'] = tm;

			tm = $("#job-BMonth").val();
			data['job']['BMonth'] = tm;

			tm = $("#job-BYear").val();
			data['job']['BYear'] = tm;

			tm = $("#job-email").val();
			if (tm == "") {
				Alert("Необходимо указать email!");
				return;
			}
			data['job']['email'] = tm;
			
			tm = $("#job-addr").val();
			if (tm == "") {
				Alert("Необходимо указать фактический адрес проживания!");
				return;
			}
			data['job']['addr'] = tm;
			

			tm = $("#job-lastJob").val();
			if (tm == "") {
				Alert("Необходимо указать предыдущее или настоящее место работы/учебы!");
				return;
			}
			data['job']['lastJob'] = tm;

			tm = $("input[name='place']").val();
			data['job']['place'] = tm;

			tm = $("input[name='workType']").val();
			data['job']['workType'] = tm;

			tm = $("#job-profession").val();
			if (tm == "") {
				Alert("Необходимо указать желаемую должность!");
				return;
			}
			data['job']['profession'] = tm;

			tm = $("#job-grafic").val();
			if (tm == "") {
				Alert("Необходимо указать желаемый грфик работы!");
				return;
			}
			data['job']['grafic'] = tm;

			if ($("#job-confirm:checked").length == 0) {
				Alert("Необходимо дать согласие на использование данных!");
				return;
			}

			$.ajax({
				cache 		: false,
				type 		: 	'POST',
				url			:	'/job/submitJob/',
				data		:	data,
				dataType	:	'json',
				success		:	function(response) {
					Alert("Ваша анкета отправлена!");
					window.reload();
				},
			})
					
		})
	})
	
</script>