$(function () {
    $('#form').validate({
        rules: {
            name: {
                required: true,
                customNameValidation: true
            },
            email: {
                required: true,
                customEmailValidation: true
            },
            mobile: {
                required: true,
                customMobileValidation: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter your email",
                customEmailValidation: "Invalid email format"
            },
            mobile: {
                required: "Please enter your mobile number",
                customMobileValidation: "Mobile should only contain numbers and should be 10 digits"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            insertData(form);
        }
    });

    $("#name").rules("add", {
        minlength: 2,
        customNameValidation: true,
        messages: {
            minlength: jQuery.validator.format("Please enter at least {0} characters for the name"),
            customNameValidation: "Name can't contain digits or special characters"
        }
    });

    $.validator.addMethod("customNameValidation", function (value, element) {
        return /^[a-zA-Z\s]+$/.test(value);
    }, "Name can't contain digits or special characters");

    $.validator.addMethod("customEmailValidation", function (value, element) {
        return /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(value);
    }, "Invalid email format");

    $.validator.addMethod("customMobileValidation", function (value, element) {
        return /^\d{10}$/.test(value);
    }, "Mobile should only contain numbers and should be 10 digits");
    

    function insertData(form) {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: $(form).serialize(),
            success: function (response) {
            
                // Set a timeout for 3 seconds before redirecting to display.php
                setTimeout(function () {
                    window.location.href = 'display.php';
                }, 3000); 
            },
            error: function (error) {
                console.error('Error inserting data:', error);
            }
        });
    }
    
}); 
$(document).ready(function () {
    $('#editForm').validate({
        rules: {
            name: {
                required: true,
                customNameValidation: true,
                minlength: 2// Minimum length of  characters
            },
            email: {
                required: true,
                customEmailValidation: true
            },
            mobile: {
                required: true,
                customMobileValidation: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be greater than 2 characters",
            },
            email: {
                required: "Please enter your email",
                customEmailValidation: "Invalid email format"
            },
            mobile: {
                required: "Please enter your mobile number",
                customMobileValidation: "Mobile should only contain numbers and should be 10 digits"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            // AJAX submit form data
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    // Redirect to display.php upon successful update
                    window.location.href = 'display.php';
                },
                error: function (error) {
                    console.error('Error updating record:', error);
                }
            });
        }
    });

    $.validator.addMethod("customNameValidation", function (value, element) {
        return /^[a-zA-Z\s]+$/.test(value);
    }, "Name can't contain digits or special characters");

    $.validator.addMethod("customEmailValidation", function (value, element) {
        return /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(value);
    }, "Invalid email format");

    $.validator.addMethod("customMobileValidation", function (value, element) {
        return /^\d{10}$/.test(value);
    }, "Mobile should only contain numbers and should be 10 digits");
});