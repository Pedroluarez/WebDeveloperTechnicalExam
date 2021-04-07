$(document).ready(function () {
    // Start
    // datatable activate
    $('#gadgetsItemTable').DataTable({
        retrieve: true,
        responsive: true,
        info: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        autoWidth: true,
        select: true,
    });
    // gets the table row in any table pages
    $('.btnEdit').on('click', function () {
        // start get the row data
        $tableRow = $(this).closest("tr");
        var data = $tableRow.children("td").map(function () {
            return $(this).text();
        }).get();
        // giving content to every column
        $('#itemListName').val(data[0]);
        $('#itemListDescription').val(data[1]);
        $('#itemListPrice').val(data[2]);
        $('#itemListStatus').val(data[3]);
        // end to get row data
    });
    $('.btnEditToCartConfirm').click(function () {
        //alert(2)
        //get the date today
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();
        //format of the date output
        var output =
            (month < 10 ? '0' : '') + month + '/' +
            (day < 10 ? '0' : '') + day + '/' +
            d.getFullYear();

        $('#tbUpdateDate').val(output);
        var itemName = $('#itemListName').val();
        var itemDescription = $('#itemListDescription').val();
        var itemPrice = $('#itemListPrice').val();
        var itemStatus = $('#itemListStatus').val();
        var itemUpdateDate = $('#tbUpdateDate').val();

        var updateObj = {
            itemName: itemName,
            itemDescription: itemDescription,
            itemPrice: itemPrice,
            itemStatus: itemStatus,
            itemUpdateDate: itemUpdateDate
        }

        if (itemDescription.length == 0 || itemPrice.length == 0 || itemStatus.length == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ooppss!!',
                text: 'Fill ddout all the fields.',
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            $.ajax({
                url: "editItemList.php",
                method: "POST",
                data: updateObj,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Updated',
                        text: 'Item information updated!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }

    });
    // when delete button click get thw row data
    $('.btnSoftDelete').on('click', function () {
        // start get the row data
        $tableRow = $(this).closest("tr");
        var data = $tableRow.children("td").map(function () {
            return $(this).text();
        }).get();
        // giving content to every column
        $('#itemListName').val(data[0]);
        // end to get row data
    });
    $('.btnDeleteToCartConfirm').click(function () {
        //alert(2)
        //get the date today
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();
        //format of the date output
        var output =
            (month < 10 ? '0' : '') + month + '/' +
            (day < 10 ? '0' : '') + day + '/' +
            d.getFullYear();

        $('#tbDeleteDate').val(output);
        var itemName = $('#itemListName').val();
        var itemStatus = "In-Active";
        var itemDeleteDate = $('#tbDeleteDate').val();

        var deleteObj = {
            itemName: itemName,
            itemStatus: itemStatus,
            itemDeleteDate: itemDeleteDate
        }
        $.ajax({
            url: "deleteItemList.php",
            method: "POST",
            data: deleteObj,
            success: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updated',
                    text: 'Item information updated!',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    });
    // add a new item
    $('.btnAddToCartConfirm').click(function () {
        //alert(2);
        //alert(2)
        //get the date today
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();
        //format of the date output
        var output =
            (month < 10 ? '0' : '') + month + '/' +
            (day < 10 ? '0' : '') + day + '/' +
            d.getFullYear();

        $('#tbAddDate').val(output);
        var itemName = $('#itemAddName').val();
        var itemDescription = $('#itemAddDescription').val();
        var itemPrice = $('#itemAddPrice').val();
        var itemStatus = $('#itemAddStatus').val();
        var itemAddDate = $('#tbAddDate').val();
        var itemUpdate = "N/A";
        var itemDelete = "N/A";

        var addObj = {
            itemName: itemName,
            itemDescription: itemDescription,
            itemPrice: itemPrice,
            itemStatus: itemStatus,
            itemAddDate: itemAddDate,
            itemUpdate: itemUpdate,
            itemDelete: itemDelete
        }

        if (itemName.length == 0 || itemDescription.length == 0 || itemPrice.length == 0 || itemStatus.length == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ooppss..!!',
                text: 'Fill out all the fields.',
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            $.ajax({
                url: "insertToProduct.php",
                method: "POST",
                data: addObj,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'addedd to item list',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.replace("admindashboard.php");
                    });
                }
            });
        }
    });
    // End
});