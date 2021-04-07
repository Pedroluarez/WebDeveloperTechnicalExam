$(document).ready(function () {
    // Start
    $('.btnLoginAdmin').click(function () {
        var username = $('#tbUsername').val();
        var password = $('#tbPassword').val();

        var adminCreds = {
            username: username,
            password: password
        }
        if (username != "" && password != "") {
            $.ajax({
                url: "checkIfAdmin.php",
                type: "POST",
                data: adminCreds,
                cache: false,
                success: function (data) {
                    if (data) {
                        window.location.replace("AdminDashboard.php");
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Ooppss..!!',
                            text: 'Incorrect Username or Password!',
                            showConfirmButton: false,
                            timer: 3000
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ooppss..!!',
                text: 'Enter your Username and Password',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.reload();
            });
        }
    })
    // End
});