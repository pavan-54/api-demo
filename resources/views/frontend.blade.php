<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Help</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            .left-img {
                display: none;
            }
        }
    
        #submit {
            background-color: #373eab;
            color: #fff;
        }
    
        img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col left-img"> 
            <img src="https://th.bing.com/th/id/OIP.zPqd3CZJBiOuWlYPJHhyHwHaEK?pid=ImgDet&rs=1" alt="">
        </div>
        
        <div class="col">
            <form>
                <div class="header">
                    <h1>Let's level up Your</h1>
                    <h1>Brand, together</h1>
                </div>
                <div class="subline">
                    <p>You can reach us anytime via h@untiled.com</p>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="You@company.com">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" placeholder="+1(555) 000-0000">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">How can we Help You?</label>
                    <input type="text" class="form-control" id="description" placeholder="Tell us a little about the project">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Website Design</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">UX Design</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">User research</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Content Creation</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Strategy & consulting</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="services" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Other</label>
                        </div>
                    </div>
                </div>
                <input type="submit" class="form-control" id="submit" value="Send Message">
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    var formData = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        description: $('#description').val()
                    };

                    $.ajax({
                        url: 'https://formz.in/api/task',
                        type: 'POST',
                        data: formData,
                        success: function(data, textStatus, xhr) {
                            
                            if (xhr.status === 201) {
                                alert('Form submitted successfully.');
                            } else {
                                alert('An error occurred while submitting the form.');
                            }
                        },
                    });
                }
            });
        });

        function validateForm() {
            var name = $('#name').val().trim();
            var phone = $('#phone').val().trim();
            var helpDesc = $('#description').val().trim();
    
            if (name === '') {
                alert('Please enter your name.');
                return false;
            }
    
            if (phone === '') {
                alert('Please enter your phone number.');
                return false;
            }
    
            if (helpDesc === '') {
                alert('Please provide a description of how we can help you.');
                return false;
            }
    
            return true;
        }
    </script>
</body>
</html>
