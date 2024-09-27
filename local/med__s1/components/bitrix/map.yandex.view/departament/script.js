if (!window.BX_YMapAddPlacemark)
{
	window.BX_YMapAddPlacemark = function(map, arPlacemark)
	{
		if (null == map)
			return false;

		if(!arPlacemark.LAT || !arPlacemark.LON)
			return false;

		var props = {};
		if (null != arPlacemark.TEXT && arPlacemark.TEXT.length > 0)
		{
			var value_view = '';

			if (arPlacemark.TEXT.length > 0)
			{
				var rnpos = arPlacemark.TEXT.indexOf("\n");
				value_view = rnpos <= 0 ? arPlacemark.TEXT : arPlacemark.TEXT.substring(0, rnpos);
			}

			props.balloonContent = arPlacemark.TEXT.replace(/\n/g, '<br />');
			props.hintContent = value_view;
		}
        props.url = arPlacemark.URL;
        var props2 = {
            balloonCloseButton: true,
            preset: 'islands#icon',
            iconColor: '#0095b6'
        };
		if (arPlacemark.IS_CENTER){
            var centerPlacemark = arPlacemark;
        }
		if (null != arPlacemark.ICON && arPlacemark.ICON.length > 0){
			// props2.iconLayout =  'default#image';
			// props2.iconImageHref = arPlacemark.ICON;
			// props2.iconImageSize = [83, 127];
			// props2.iconImageOffset = [-40, -110];
			props2.preset = 'twirl#redIcon';
			props2.iconColor = '#0095b6';
        }
		var obPlacemark = new ymaps.Placemark(
			[arPlacemark.LAT, arPlacemark.LON],
			props,
            props2
        );
		map.geoObjects.add(obPlacemark);

        var arBoundsMap = map.geoObjects.getBounds();
        if(!(arBoundsMap[0][0] == arBoundsMap[1][0] && arBoundsMap[0][1] == arBoundsMap[1][1])){
            map.setBounds(map.geoObjects.getBounds());
        }
        if (centerPlacemark) {
            setTimeout(function(){
                map.setCenter([centerPlacemark.LAT, centerPlacemark.LON]);
            }, 100);

        }

        map.geoObjects.events.add('click', function (e) {
            var target = e.get('target');
            if(target.properties.get('url'))
                window.location.href = target.properties.get('url');
        });
		return obPlacemark;
	}
}

if (!window.BX_YMapAddPolyline)
{
	window.BX_YMapAddPolyline = function(map, arPolyline)
	{
		if (null == map)
			return false;

		if (null != arPolyline.POINTS && arPolyline.POINTS.length > 1)
		{
			var arPoints = [];
			for (var i = 0, len = arPolyline.POINTS.length; i < len; i++)
			{
				arPoints.push([arPolyline.POINTS[i].LAT, arPolyline.POINTS[i].LON]);
			}
		}
		else
		{
			return false;
		}

		var obParams = {clickable: true};
		if (null != arPolyline.STYLE)
		{
			obParams.strokeColor = arPolyline.STYLE.strokeColor;
			obParams.strokeWidth = arPolyline.STYLE.strokeWidth;
		}
		var obPolyline = new ymaps.Polyline(
			arPoints, {balloonContent: arPolyline.TITLE}, obParams
		);

		map.geoObjects.add(obPolyline);

		return obPolyline;
	}
}