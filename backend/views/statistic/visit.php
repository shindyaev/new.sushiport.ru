<?php 
/* @var $this SiteController */

$this->title_h3='Статистика просмотров';

$this->breadcrumbs=array(
	'Статистика просмотров',
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-datepicker/css/datepicker.css',
	'',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.resize.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.time.min.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.pie.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.stack.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/flot/jquery.flot.crosshair.js',
	CClientScript::POS_END
);


$this->menuActiveItems[BController::STATISTIC_VISIT_MENU_ITEM] = 1;

?>


<div>
	
	<form id="statisticMarket-form" class="form-horizontal" method="post">
	
		<div class="control-group">
			<label class="control-label">Период</label>
			<div class="controls">
				<span class="lh-34 ml-20">С</span> <?php echo CHtml::telField('periodStart','', array('class'=>'m-wrap small date-picker', 'readonly'=>'readonly')); ?>
				<span class="lh-34 ml-20">По</span> <?php echo CHtml::telField('periodEnd','', array('class'=>'m-wrap small date-picker', 'readonly'=>'readonly')); ?>
				<?php echo CHtml::htmlButton('Показать', array('class' => 'btn blue', 'type' => 'submit')); ?>
			</div>
		</div>

	</form>
	
	<?php if (!empty($yaData)):?>
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Посещаемость</div>
		</div>
		<div class="portlet-body">
			<div id="chart_2" class="chart"></div>
			
			<div class="form-horizontal">
				<div class="control-group">
					<label class="control-label">Просмотры</label>
					<div class="controls">
						<label class="control-label max-width text-left">
							Количество просмотров страниц на сайте за отчетный период, исключая мгновенные обновления страниц («рефреш», когда повторный просмотр той же страницы произошел в течение 15 секунд после первого). При этом возвраты на уже посещенные страницы также засчитываются в качестве просмотра.
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Визиты</label>
					<div class="controls">
						<label class="control-label max-width text-left">
							Количество сеансов взаимодействия посетителей с сайтом, включающих один и более просмотров страницы. Вы можете установить тайм-аут визита. Это значит, что если в течение указанного количества минут после очередного просмотра страницы пользователь не просмотрел еще одну страницу, визит считается завершенным. По умолчанию тайм-аут визита равен 30 минутам.
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Посетители</label>
					<div class="controls">
						<label class="control-label max-width text-left">
							Количество уникальных пользователей, посетивших сайт (имевших хотя бы один визит) за отчетный период.
						</label>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<?php endif;?>
	
	<?php if (!empty($yaData2)):?>
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Источники</div>
		</div>
		<div class="portlet-body">
			<div id="interactive" class="chart" style="height: 500px;"></div>
		</div>
	</div>
	<?php endif;?>
	
	<?php if (!empty($yaData3)):?>
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Поисковые фразы</div>
		</div>
		<div class="portlet-body">
			
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th id="client-grid_c0">#</th>
						<th id="client-grid_c1">Поисковая фраза</th>
						<th id="client-grid_c2">Визиты</th>
						<th id="client-grid_c3">Просмотры</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($yaData3->data AS $key => $val):?>
					<tr>
						<td><?php echo $key+1?></td>
						<td><?php echo $val->phrase?></td>
						<td><?php echo $val->visits?></td>
						<td><?php echo $val->page_views?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			
		</div>
	</div>
	<?php endif;?>
	
</div>
<script type="text/javascript">
	$(document).ready(function() {

<?php if (!empty($yaData)):?>

		var Charts = function () {

		    return {
		        //main function to initiate the module

		        initCharts: function () {

		            if (!jQuery.plot) {
		                return;
		            }

		            var data = [];
		            var totalPoints = 250;

		            //Interactive Chart

		            function chart2() {
		                function randValue() {
		                    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
		                }

                		<?php
			        		$visits = array();
			        		$page_views = array();
			        		$visitors = array();
			        		foreach ($yaData->data AS $key => $val){
			        			$val->date = CDateTimeParser::parse($val->date,'yyyyMMdd');
			        			$visits[] = '['.$val->date.'000, '.$val->visits.']';
			        			$page_views[] = '['.$val->date.'000, '.$val->page_views.']';
			        			$visitors[] = '['.$val->date.'000, '.$val->visitors.']';
			        		}
		        		?>

		        		var visits = [
		        			<?php echo implode(",", $visits); ?>
		        		];

		        		var page_views = [
  		        			<?php echo implode(",", $page_views); ?>
  		        		];

		        		var visitors = [
  		        			<?php echo implode(",", $visitors); ?>
  		        		];

		                var plot = $.plot($("#chart_2"), [{
		                            data: visits,
		                            label: "Визиты"
		                        },
		                        {
		                            data: page_views,
		                            label: "Просмотры"
		                        },
		                        {
		                            data: visitors,
		                            label: "Посетители"
		                        }
		                    ], {
		                        series: {
		                            lines: {
		                                show: true,
		                                lineWidth: 2,
		                                fill: true,
		                                fillColor: {
		                                    colors: [{
		                                            opacity: 0.05
		                                        }, {
		                                            opacity: 0.01
		                                        }
		                                    ]
		                                }
		                            },
		                            points: {
		                                show: true
		                            },
		                            shadowSize: 2
		                        },
		                        grid: {
		                            hoverable: true,
		                            clickable: true,
		                            tickColor: "#eee",
		                            borderWidth: 0
		                        },
		                        colors: ["#d12610", "#37b7f3", "#52e136"],
		                        xaxis: {
		                        	mode: "time",
		                        	timeformat: "%d.%m.%y",
		                        },
		                        yaxis: {
		                            ticks: 11,
		                            tickDecimals: 0
		                        }
		                    });


		                function showTooltip(x, y, contents) {
		                    $('<div id="tooltip">' + contents + '</div>').css({
		                            position: 'absolute',
		                            display: 'none',
		                            top: y + 5,
		                            left: x + 15,
		                            border: '1px solid #333',
		                            padding: '4px',
		                            color: '#fff',
		                            'border-radius': '3px',
		                            'background-color': '#333',
		                            opacity: 0.80
		                        }).appendTo("body").fadeIn(200);
		                }

		                var previousPoint = null;
		                $("#chart_2").bind("plothover", function (event, pos, item) {
		                    $("#x").text(pos.x.toFixed(2));
		                    $("#y").text(pos.y.toFixed(2));

		                    if (item) {
		                        if (previousPoint != item.dataIndex) {
		                            previousPoint = item.dataIndex;

		                            $("#tooltip").remove();
		                            var x = item.datapoint[0],
		                                y = item.datapoint[1];

	                                var dt = new Date(x);
	                                var day = dt.getDate();
	                                if (day < 10)
		                                day = '0' + day;
	                                var month = dt.getMonth();
	                                if (month < 10)
	                                	month = '0' + month;

		                            showTooltip(item.pageX, item.pageY, item.series.label + " " + day + "." + month + " = " + y);
		                        }
		                    } else {
		                        $("#tooltip").remove();
		                        previousPoint = null;
		                    }
		                });
		            }

   		            chart2();
		        },

		        initPieCharts: function () {

		            var data = [];
		            series = <?php echo count($yaData2->data)?>;

		            <?php foreach ($yaData2->data AS $key => $val):?>
		            	data[<?php echo $key?>] = {
	 		                    label: "<?php echo $val->name?>",
	 		                    data: <?php echo $val->visits?>
	 		                }
		            <?php endforeach;?>

		            // INTERACTIVE
		            $.plot($("#interactive"), data, {
		                    series: {
		                        pie: {
		                            show: true
		                        }
		                    },
		                    grid: {
		                        hoverable: true,
		                        clickable: true
		                    }
		                });
		            $("#interactive").bind("plothover", pieHover);
		            $("#interactive").bind("plotclick", pieClick);

		            function pieHover(event, pos, obj) {
		            if (!obj)
		                    return;
		                percent = parseFloat(obj.series.percent).toFixed(2);
		                $("#hover").html('<span style="font-weight: bold; color: ' + obj.series.color + '">' + obj.series.label + ' (' + percent + '%)</span>');
		            }

		            function pieClick(event, pos, obj) {
		                if (!obj)
		                    return;
		                percent = parseFloat(obj.series.percent).toFixed(2);
		                alert('' + obj.series.label + ': ' + percent + '%');
		            }

		        }
		        
		        
		    };

		}();

		Charts.initCharts();
		Charts.initPieCharts();
<?php endif;?>
		
		if ($.datepicker) {
			$('.date-picker').datepicker({
				rtl : App.isRTL(),
				format: "dd.mm.yyyy"
			});
		}

	})
</script>
