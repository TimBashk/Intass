function tablePag(){
	const rowsPerPage = 3;
	const rows = $('#my-table tbody tr');
	const rowsCount = rows.length;
	const pageCount = Math.ceil(rowsCount / rowsPerPage); // avoid decimals
	const numbers = $('#numbers');
	
	// генерация пагинации
	numbers.empty();
	for (var i = 0; i < pageCount; i++) {
		numbers.append('<li><a href="#">' + (i+1) + '</a></li>');
	}
		
	// активация ссылки на первую страницу таблицы
	$('#numbers li:first-child a').addClass('active');

	// показываем первую порцию таблицы
	displayRows(1);
	
	// работа с пагинацией
	$('#numbers li a').click(function(e) {
		var $this = $(this);
		
		e.preventDefault();
		
		// меняем активные ссылки пагинации
		$('#numbers li a').removeClass('active');
		
		// делаем активную ссылку текущей порции таблицы
		$this.addClass('active');
		
		// показываем порцию таблицы выбранной пагинации.
		displayRows($this.text());
	});
	
	// функция показа выбранной порции таблицы
	function displayRows(index) {
		var start = (index - 1) * rowsPerPage;
		var end = start + rowsPerPage;
		$("#p").html(start);
		// Hide all rows.
		rows.hide();
		
		// Show the proper rows for this page.
	rows.slice(start, end).show();
	}
}    
	
	
	
	
