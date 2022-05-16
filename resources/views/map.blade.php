@extends('layouts.app')

@section('title') Yandex Map @endsection

@section('content')

	<h1>Яндекс.Карты</h1>

	<div id="map" style="width: 400px; height: 300px;"></div>

	<h2>Координаты:</h2>

	<div id="coords"></div>


	<script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?apikey=a10e24d5-a724-4cf4-98dc-6f6929908f6a&lang=ru_RU"></script>
	<script type="text/javascript">
		
	ymaps.ready(init);

	function init() 
	{
	    var myPlacemark,
	        myMap = new ymaps.Map('map', 
	        {
	            center: [55.753994, 37.622093],
	            zoom: 9
	        }, 
	        {
	            searchControlProvider: 'yandex#search'
	        });

	    myMap.events.add('click', function(e) 
	    {
	        var coords = e.get('coords');

	        if (myPlacemark) 
	        {
	            myPlacemark.geometry.setCoordinates(coords);
	        } else 
	        {
	            myPlacemark = createPlacemark(coords);

	            myMap.geoObjects.add(myPlacemark);

	            myPlacemark.events.add('dragend', function() 
	            {
	                getAddress(myPlacemark.geometry.getCoordinates());
	            });
	        }

	        getAddress(coords);
	    });

	    function createPlacemark(coords) 
	    {
	        return new ymaps.Placemark(coords, 
	        {
	            iconCaption: 'поиск...'
	        }, 
	        {
	            preset: 'islands#violetDotIconWithCaption',
	            draggable: true
	        });
	    }

	    
	    function getAddress(coords) 
	    {
	        myPlacemark.properties.set('iconCaption', 'поиск...');
	        ymaps.geocode(coords).then(function (res) 
	        {
	            var firstGeoObject = res.geoObjects.get(0);

	            myPlacemark.properties
	                .set({
	                    iconCaption: [
	                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
	                      
	                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
	                    ].filter(Boolean).join(', '),
	                    balloonContent: firstGeoObject.getAddressLine()
	                });
	        });

	        document.getElementById("coords").append(coords+' ');
	    }
	}



	</script>

@endsection