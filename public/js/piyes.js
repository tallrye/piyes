function cropTheImage(files, cropOptions){
    $('.jcrop-holder').remove();
    $(cropOptions.fileInput).attr('src', files.result); 
    $(cropOptions.targetInput).val(files.result);

    $.Jcrop(cropOptions.fileInput).destroy();
    $(cropOptions.fileInput).Jcrop({
      boxWidth: 600,
      boxHeight: 400,
        onSelect: updateCoords,
        onChange: updateCoords,
        setSelect:[400,400,200,200],
        bgOpacity: 0.4,
        aspectRatio: cropOptions.aspectRatio,
      });

    function updateCoords(c){
        $(cropOptions.cropX).val(c.x);
        $(cropOptions.cropY).val(c.y);
        $(cropOptions.cropW).val(c.w);
        $(cropOptions.cropH).val(c.h);
    };
}

function initializeDatatable($selector, $pageLength = 10){
    $($selector).DataTable({
        pageLength: $pageLength,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Roles'},
            {extend: 'pdf', title: 'Roles'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });

}