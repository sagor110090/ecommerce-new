/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

//delete sweet alert
function sweetalertDelete(id) {
    event.preventDefault();
    swal({
        title: "Are you sure?",
        text: "To continue this action!",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(willDelete => {
        if (willDelete) {
            swal("Your action has beed done! :)", {
                icon: "success",
                buttons: false,
                timer: 1000
            });
            $("#deleteButton" + id).submit();
        }
    });
}
// multiple click privent
$(".oneTimeSubmit").click(function () {
    var count1 = 0;
    var count2 = -1;

    const inputs = document.querySelectorAll("#oneTimeSubmit input");
    const requiredFields = Array.from(inputs).filter(input => input.required);
    for (let index = 0; index < requiredFields.length; index++) {
        count1 = index;

        if (requiredFields[index].value) {
            count2++;
        }
    }
    if (count1 == count2) {
        $(".oneTimeSubmit").addClass("btn-progress");
    }
});

// image upload js start

function showMyImage(fileInput, imagePreview) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById(imagePreview);
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
    files = "";
    img = "";
}

//   image upload js end

// placeholder loding start

// $(function () {
//     $("#divID")
//         .remove();
//     $("#divIDsidebar")
//         .remove();
//     window.addEventListener("load", () => {
//         $("#placeholderLoading")
//             .fadeIn("slow")
//             .show();
//         $("#placeholderLoadingSidebar")
//             .fadeIn("slow")
//             .show();
//     });
//     setTimeout(function () {

//     }, 1000);
// });
// placeholder loding end
    window.addEventListener("load", () => {
$("#divID").remove();

        $("#loading")
            .fadeIn("slow")
            .show();
    });
//for validation start
$("input, textarea, select").keyup(function (e) {
    $(this)
        .closest("form")
        .addClass("was-validated");
});
//validation end

// category to Subcategory

function subCategorySearch() {
    var value = $('#category_id').val();
    $.ajax({
        type: "GET",
        url: "/admin/SubCategory/set/" + value,
        dataType: "json",
        success: function (response) {
            var vue = '';
            $('#subcategory_id').closest('option').remove();
            $.each(response, function (indexInArray, valueOfElement) {
                vue += '<option value="' + valueOfElement.id + '">' + valueOfElement.name +
                    '</option>'
            });
            $('#subcategory_id').replaceWith(
                '<select class="form-control selectric" name="subcategory_id" id="subcategory_id" onchange="miniCategorySearch()"><option value="" id="subCategoryAppend">---Select---</option>' +
                vue + '</select>'
            );

        }
    });
}
// subcategory to miniCategory

function miniCategorySearch() {
    var value = $('#subcategory_id').val();
    $.ajax({
        type: "GET",
        url: "/admin/MiniCategory/set/" + value,
        dataType: "json",
        success: function (response) {
            var vue = '';
            $('#subcategory_id').closest('option').remove();
            $.each(response, function (indexInArray, valueOfElement) {
                vue += '<option value="' + valueOfElement.id + '">' + valueOfElement.name +
                    '</option>'
            });
            console.log(vue);
            $('#minicategory_id').replaceWith(
                '<select class="form-control selectric" name="minicategory_id" id="minicategory_id"><option value="">---Select---</option>' +
                vue + '</select>'
            );

        }
    });
}

function Payment(id) {
    $('#payment-form'+id).submit();
}
function Delivery(id) {
    $('#delivery-form'+id).submit();
}


