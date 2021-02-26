<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="">
    <title>Test site</title>    
    <link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/functions.js"></script>
</head>
<body>
<?
/*include_once('php/Classes/DeliveryClass.php');
$delivery = new DeliveryClass("Уфа","Алексеев Константин Андреевич","2019-08-11","2019-08-12");
echo $delivery->getDeliveryData();*/
?>
<h1>Расписание поездок курьеров в регионы</h1>  

 
    <h2>Добавить новую поездку</h2>


	<div class="inputs">    
	    <label>Выберите регион:</label>
		<select id="region_list">
			
		</select>
	</div>


    <div class="inputs">
	   <label>Выберите курьера:</label>
		<select id="courier_list">
		</select>	
	</div>


    <div class="inputs">
		<label>Выберите дату выезда:</label>
		<input type="date" id="date" name="date"/>
    </div>
	
    <div class="inputs">
		<button id="addRecordBtn">Добавить</button>
    </div>

   <h2>Поиск по таблице</h2>


    <div class="inputs">
		<label>Выберите дату</label>
		<input type="date" id="date" name="date"/>
    </div>
	
    <div class="inputs">
		<button id="create">Найти</button>
    </div>	
	
	<table id="my-table">
	<thead>
		<tr>
			<th>Регион</th>
			<th>Курьер</th>
			<th>Дата отправки</th>
			<th>Дата прибытия</th>
		</tr>
	</thead>
	<tbody id="my-table_body">
	</tbody>
</table>
		
<script>

$(function() {//вывод данных из базы при первоначальной загрузки страницы
	$.ajax({
		  type: 'get',
		  url: 'php/functions.php',
		  dataType:"json",
		  data:{action:"loadData"},
		  success: function(data){
			 
			let tableInner = "";
			for(let i=0;i<data.table.length;i++)
                    {
                      tableInner += "<tr><td>" + data.table[i].region 
					  + "</td><td>" + data.table[i].courier + "</td><td>" 
					  + data.table[i].departure_date + "</td><td>" 
					  + data.table[i].arrival_date + "</td></tr>";
					}
					let couriersListInner = "";
					for(let i=0;i<data.couriers.length;i++){
						couriersListInner +="<option data-id='"+ data.couriers[i].id +"'>"+ data.couriers[i].name + "</option>";
					}
					
					let regionsListInner = "";
					for(let i=0;i<data.regions.length;i++){
						regionsListInner +="<option data-id='"+ data.regions[i].id +"' data-duration='" + data.regions[i].travel_duration + "'>"+ data.regions[i].region + "</option>";
					}
					document.getElementById("region_list").innerHTML = regionsListInner;
					document.getElementById("courier_list").innerHTML = couriersListInner;
					document.getElementById("my-table_body").innerHTML = tableInner;
					
					}
		  });
		  
		  
		  $("#addRecordBtn").click(function(){
			  let selRegion = $("#region_list option:selected").attr('data-id');
			  let selCourier = $("#courier_list option:selected").attr('data-id');
			  let selDuration = $("#region_list option:selected").attr('data-duration');
			  let selDate = $("#date").val();
			  let arrivalDate;
			  //поиск по таблице
			  
			  /*let val = $("#courier_list option:selected").val();
			  let t = $('#my-table tbody  td');
			  let courierFlag = true;
                $.each(t, function (i, v) {
                    if ($(v).text() == val) {
                        $('#my-table tbody  td').css('color', '#333');
                        $(v).css('color', 'red');
						courierFlag = false;
                    }
                });*/
			  
			  //
			  //if(courierFlag==true){
				$.ajax({
					  type: 'post',
					  url: 'php/functions.php',
					  dataType:"json",
					  data: {action:"addData",region:selRegion,duration:selDuration,courier:selCourier,date:selDate},
					  success: function(data){
								if(data.errors.message == "Error"){
									alert("Выбранный Вами курьер занят");
								}else{
									selRegion = $("#region_list option:selected").val();
									selCourier = $("#courier_list option:selected").val();
									selDate = data.results.departure_date;
									arrivalDate = data.results.arrival_date;
									
									let appendRow = "<tr><td>" + selRegion 
												  + "</td><td>" + selCourier + "</td><td>" 
												  + selDate + "</td><td>" 
												  + arrivalDate + "</td></tr>";
												  
								    $('#my-table_body').append(appendRow);
								}
								}
					  });
		    });
		})


	


	

</script>

</body>
</html>