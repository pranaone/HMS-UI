function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function getNowDate() {
    var date = new Date()
    var year = date.getFullYear();
    var month = date.getMonth() + 1;//month start with 0
    var day = date.getDate();

    var today = year + "-" + month + "-" + day;
    return today;
}

function getNowTime() {
    var date = new Date()
    var hour = date.getHours();
    var minute = date.getMinutes();//month start with 0
    var second = date.getSeconds();

    var now = hour + ":" + minute + ":" + second;
    return now;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
 
function isBase64(str) {
    var base64Matcher = new RegExp("^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{4})$");
 
    if (base64Matcher.test(str)) {
        return true;
    } else {
        return false;
    }
}

function setImage(input,output) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#"+output).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function ImageToBlob(object) {
    var profilepic = $(object)[0].files[0];
    objectURL = URL.createObjectURL(profilepic);
    return objectURL;
}
 

function getDataUri(url, callback) {
  var image = new Image();

  image.onload = function() {
    var canvas = document.createElement("canvas");
    canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
    canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

    canvas.getContext("2d").drawImage(this, 0, 0);

    // Get raw image data
    callback(
      canvas
        .toDataURL("image/png")
        .replace(/^data:image\/(png|jpg);base64,/, "")
    );

    // ... or get as Data URI
    callback(canvas.toDataURL("image/png"));
  };

  image.src = url;
}
 
function deleteFile(path){
    $.ajax({
        url: 'delete.php',
        data: { 'file': "<?php echo dirname(__FILE__) . '/uploads/'?>" + file_name },
        success: function (response) {
            // do something
        },
        error: function () {
            // do something
        }
    });
}

function sortTable(tableid) {
    $('#' + tableid + ' .btn-filter').click(function (e) {
        e.preventDefault();
        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function (e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function () {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
        }
    });
}


// d/m/y 9:18 pm
function formatDate(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;

    var date1 = date.getDate();
    var month1 = date.getMonth() + 1;
    var year1 = date.getFullYear();
    //return date.getDate() + "/" + date.getMonth() + 1 +"/" + date.getFullYear() + " " + strTime;
    return year1 + "/" + month1 + "/" + date1 + " " + strTime;
}


//get url param values
var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined
        ? true
        : decodeURIComponent(sParameterName[1]);
    }
  }
};