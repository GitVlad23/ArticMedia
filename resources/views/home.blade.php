@extends('layouts.app')

@section('title') ArticMedia @endsection
    
@section('content')

	<h1>Оставьте комментарий</h1>

	<form id="commentForm" action="#">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"> 

		<input type="text" name="name" id="inputName" placeholder="Введите имя">
		<input type="text" name="text" id="inputText" placeholder="Введите текст">

		<button type="submit" value="Register" class="btn btn-success">Отправить</button>
	</form><br>

	<div id="commentDiv"></div>


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


		$("#commentForm").submit(function(){
			var name = $("#inputName").val();
			var text = $("#inputText").val();

			var dataString = "Name: "+name+", Text: "+text;

			$.ajax({
				type: "POST",
				url: "{{ route('store') }}",
				data: {name: name, text: text},
				success: function(data) {
					document.getElementById('commentDiv').append("Пост был успешно добавлен в БД! Имя: "+data.name+", Текст: "+data.text);
				}
			});

			return false;
		});

	</script>

@endsection