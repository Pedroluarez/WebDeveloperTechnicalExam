$(document).ready(function () {
    // START
    // check the datatable attributes
    $('#gadgetsTable').DataTable({
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
    $('.btnAddToCart').on('click', function () {
        // start get the row data
        $tablerow = $(this).closest("tr");
        var data = $tablerow.children("td").map(function () {
            return $(this).text();
        }).get();
        // giving content to every column
        $('#rowTargetName').val(data[0]);
        $('#rowTargetShort_description').val(data[1]);
        $('#rowTargetPrice').val(data[2]);
        $('#rowTargetStatus').val(data[3]);
        // end to get row data
    });
    // add to database cart
    $('.btnAddToCartConfirm').click(function () {
        var itemName = $('#rowTargetName').val();
        var itemPrice = $('#rowTargetPrice').val();
        var guestName = $('#tbGuestName').val();

        var itemObj = {
            itemName: itemName,
            itemPrice: itemPrice,
            guestName: guestName
        }
        //alert(2);
        if (guestName.length == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ooppss!!',
                text: 'Enter your name please',
                showConfirmButton: false,
                timer: 2000
            })
        } else {
            $.ajax({
                url: "insertToCart.php",
                method: "POST",
                data: itemObj,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'add to cart',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    });
    // gets the table row in any table pages
    $('.btnRemoveToCart').on('click', function () {
        // start get the row data
        $tableRow = $(this).closest("tr");
        var data = $tableRow.children("td").map(function () {
            return $(this).text();
        }).get();
        // giving content to every column
        $('#rowRemoveName').val(data[0]);
        $('#rowRemovePrice').val(data[1]);
        // end to get row data
    });
    // remove to database cart
    $('.btnRemoveToCartConfirm').click(function () {
        //alert(2)
        var itemName = $('#rowRemoveName').val();

        var removeItemObj = {
            itemName: itemName,
        }
        //alert(2);
        $.ajax({
            url: "deleteFromCart.php",
            method: "POST",
            data: removeItemObj,
            success: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Removed',
                    text: 'Item removed from the cart',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    });
    // get the value
    var cartRowChecker = $('#cartCheckoutModalCheckcer').val();
    // then if 0 button will disable
    if (cartRowChecker == 0) {
        //alert(2);
        $('#btnConfirmCheckout').attr('disabled', true)
    }
    // confirm checkout
    $('#btnConfirmCheckout').click(function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Successfully',
            text: 'Please fill out all the data needed',
            showConfirmButton: false,
            timer: 3000
        }).then(() => {
            window.location.replace("checkOutPage.php");
        });
    });
    //END  
});