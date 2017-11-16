<div class="content">

	<div class="">
	
		<ul class="milimon-breadcrumb">
			<li>
				<a href="/">Milimon</a>
			</li>
			<li class="breadcrumbs-splitter"></li>
			<li>
				<a class="text-black">Отзывы</a>
			</li>
			<li class="breadcrumbs-splitter"></li>
		</ul>
		<div class="clearfix"></div>
	
		<div class="main-h2 mt-30">
			Отзывы о службе доставки
		</div>

		<div class="text-center fs-16  mt-20 lh-20 ">
			Оставьте свое пожелание или впечаление от работы службы доставки<br>
			Milimon. Мы рады всем замечаниям и предложениям и не оставим без<br>
			внинмая ни одно сообщение. Спасибо что вы с нами!
		</div>
		
		<div class="mt-20">
		
			<div id="review-form" style="display: none;">
			
				<div class="form-group">
					<label for="exampleInputEmail1">Имя</label>
					<input class="form-control" id="review-name">
				</div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input class="form-control" id="review-email">
				</div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Текст сообщения</label>
					<textarea resize='false' class="form-control" id="review-text"></textarea>
				</div>
				<div class="form-group hidden">
					<label for="validate">Антиспам</label>
					<input class="form-control" id="validate">
				</div>
			</div>
			
			<a href="javascript:void(0)" id="write-review-link">Оставить отзыв</a>
			
			<ul class="review-list">

					<?php foreach ($reviews AS $key => $val):?>
						
						<li class="review-page-list-item">
							<div class="review-page-list-item-date">
								<?php echo Yii::app()->dateFormatter->format('d MMMM', $val['date']);?>
							</div>
							<div class="review-list-item-q">
								«<?php echo $val['text']?>» – <span class="text-italic"><?php echo $val['name']?>.</span>
								<div class="review-page-list-item-review-time"><?php echo Yii::app()->dateFormatter->format('H:mm', $val['date']);?></div>
							</div>
							
							<?php if (!empty($val['answer'])) :?>
								<div class="review-page-list-item-date">
								<?php echo Yii::app()->dateFormatter->format('d MMMM', $val['answerDate']);?>
							</div>
								<div class="review-list-item-a">
									«<?php echo $val['answer']?>» – <span class="text-italic">Milimon</span>
									<div class="review-page-list-item-review-time"><?php echo Yii::app()->dateFormatter->format('H:mm', $val['answerDate']);?></div>
								</div>
							<?php endif;?>
						</li>
						
					<?php endforeach;?>
				
				</ul>
				
				<div class="clearfix"></div>
				
				<br><br><br>
				<div class="pagination-container">
					<?php $this->widget('CLinkPager', array(
						'pages' => $pages,
						'cssFile' => false,
						'header' => false,
						'lastPageLabel' => 'В конец',
						'firstPageLabel' => 'В начало',
						'htmlOptions' => array(
							'class' => 'pagination'
						),   
					))?>
				</div>
				
			
				<br><br><br>
		
		</div>
	</div>	
</div><!-- .content-->



<script type="text/javascript">
	$(document).ready(function() {
			var review_submit = function() {
			var data = new Object;
			data['review'] = new Object;
			
			data['review']['name'] = $("#review-name").val();
			data['review']['email'] = $("#review-email").val();
			data['review']['text'] = $("#review-text").val();
			data['validate'] = $("#validate").val();

			if (data['review']['name'] == '') {
				Alert('Необходимо указать имя!');
				return;
			}

			if (data['review']['text'] == '') {
				Alert('Необходимо указать текст сообщения!');
				return;
			}
			
			if (data['validate'] != '') {
				Alert('Спам не пройдет!');
				return;
			}
			else {
				$.ajax({
					cache 		: false,
					type 		: 	'POST',
					url			:	'/review/submit/',
					data		:	data,
					dataType	:	'json',
					success		:	function(response) {
						Alert("Ваша отзыв отправлен!");
						$("#review-name").val("");
						$("#review-email").val("");
						$("#review-text").val("");
						$("#review-form").slideUp();
					},
				})
			}
			
		};

		$("#write-review-link").click(function() {
			if (!$("#review-form").is(":visible")) {
				$("#write-review-link").text("Отправить отзыв");
				$("#review-form").slideDown();
			} else {
				review_submit();
			}
			return false;
		})

	})
</script>
