$(document).ready(function () {
    // START
    // get the date today when click
    $('.submitCheckOutConfirm').click(function () {
        // Swal.fire(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        // )

        $('#tbCreated').val(Date());
        var Name = $('#tbName').val();
        var Email = $('#tbEmail').val();
        var Contact = $('#tbContactNumber').val();
        var Address = $('#tbAddress').val();
        var City = $('#tbCity').val();
        var State_Province = $('#tbStateProvince').val();
        var PZ_Code = $('#tbCode').val();
        var Created_At = $('#tbCreated').val();
        var Updated_At = "N/A";

        var guestInfo = {
            Name: Name,
            Email: Email,
            Contact: Contact,
            Address: Address,
            City: City,
            State_Province: State_Province,
            PZ_Code: PZ_Code,
            Created_At: Created_At,
            Updated_At: Updated_At
        }

        if (Name.length == 0 || Email.length == 0 || Contact.length == 0 || Address.length == 0 || City.length == 0 || State_Province.length == 0 || PZ_Code.length == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ooppss!!',
                text: 'Fill out all the fields.',
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            $.ajax({
                url: "insertToGuest.php",
                method: "POST",
                data: guestInfo,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'addedd to cart',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.replace("index.php");
                    });
                }
            });
        }
    });
    // END   
});