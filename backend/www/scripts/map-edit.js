var polygon;

$(document).ready(function() {

    ymaps.ready(init);
    function init() {
        var town = [
            53.244301,
            50.206438
        ];

        var points = [];

        if ($('#maps-map').val()) {
            points = JSON.parse($('#maps-map').text());
        }else{
            points.push([town[0] + 0.005 ,town[1] + 0.01]);
            points.push([town[0] - 0.005 ,town[1] + 0.01]);
            points.push([town[0] - 0.005 ,town[1] - 0.01]);
            points.push([town[0] + 0.005 ,town[1] - 0.01]);
            points = [points];
        }

        var map = new ymaps.Map ("YMapsID", {
            center: points[0][0],
            zoom: 11
        });
        map.controls.add('zoomControl', {right : '35px'});
        // Создаем многоугольник без вершин.
        console.log(points);
        polygon = new ymaps.Polygon(points, {}, {
            // Курсор в режиме добавления новых вершин.
            editorDrawingCursor: "crosshair",
            // Максимально допустимое количество вершин.
        //    editorMaxPoints: 5,
            // Цвет заливки.
         //   fillColor: '#00FF00',
            // Цвет обводки.
            strokeColor: '#0000FF',
            // Ширина обводки.
            strokeWidth: 5
        });
        // Добавляем многоугольник на карту.
        map.geoObjects.add(polygon);

        // В режиме добавления новых вершин меняем цвет обводки многоугольника.
        var stateMonitor = new ymaps.Monitor(polygon.editor.state);
        stateMonitor.add("drawing", function (newValue) {
            polygon.options.set("strokeColor", newValue ? '#FF0000' : '#0000FF');
        });

        // Включаем режим редактирования с возможностью добавления новых вершин.
        polygon.editor.startDrawing();
       
    };

    $('#zones-form').on('submit',function() {
        var points = polygon.geometry.getCoordinates();
        $('#maps-map').text(JSON.stringify(points));
        return true
    });
});