<!DOCTYPE html>
<html>
    <head>
        <title>Affiliate file Upload</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <style>
            body{
                background: #ccc;
            }

            form{
                background: #fff;
                padding: 20px;
            }
            h1{
                font-size: 24px;
            }
            #affiliatesWithinRange{
                display: none;
                background: #fff;
                padding: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <form method="POST" action="{{url('/')}}" enctype="multipart/form-data">

                        <h1>Upload Affiliates file</h1>
                        @csrf
                        <div class="form-group">
                            <input name="file" type="file" class="form-control" required><br/>
                            <input type="submit"  value="Submit" class="btn btn-dark btn-lg col-12">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-5" id="affiliatesWithinRange">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <h1>Affiliates within 100 Km</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-sm-4 offset-sm-2">
                    <strong>Name</strong>
                </div>
                <div class="col-6 col-sm-4">
                    <strong>Id</strong>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
        <script type="text/javascript">
            var SITEURL = "{{URL('/')}}";
            $(function () {
                $(document).ready(function () {
                    var bar = $('.bar');
                    var percent = $('.percent');
                    $('form').ajaxForm({
                        complete: function (xhr) {
                            if (xhr.status==200) {
                                var affiliatesWithinRange = $('#affiliatesWithinRange');
                                document.querySelectorAll('.affiatesfound').forEach(element => {element.remove();});
                                xhr.responseJSON.results.forEach(affiliate => {
                                    var row = "\
                                        <div class=\"row affiatesfound\">\
                                            <div class=\"col-6 col-sm-4 offset-sm-2\">\
                                                " + affiliate.name + "\
                                            </div>\
                                            <div class=\"col-6 col-sm-4\">\
                                                " + affiliate.affiliate_id + "\
                                            </div>\
                                        </div>\
                                    ";
                                    affiliatesWithinRange.append(row);
                                });
                                document.querySelector('#affiliatesWithinRange').style.display = 'block';
                            } else {
                                alert('Something went wrong. Please try a different file.');
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>