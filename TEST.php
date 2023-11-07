<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Webcam app</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.8.25/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</head>

<body>
    <div class="container">
        <?php
        $id = $_GET["qq"];
        echo "<form id='myForm' method='post' action='savepicture.php?qq=$id'>";
        ?>

        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br>
                <input type="button" value="Take Snapshot" onclick="takeSnapshot()" required>
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">
                    Your Captured Image Will Appear Here:
                </div>
            </div>
            <div class="col-md-12 text-center">
                <br>
                <button class="btn btn-success" id="submitButton" disabled>Submit</button>
            </div>
            <div id="searchResults">
               
            </div>
        </div>
        </form>
    </div>

    <script>
        Webcam.set({
            width: 490,
            height: 390,
            image_format: "jpeg",
            jpeg_quality: 90
        });
        Webcam.attach("#my_camera");

        function takeSnapshot() {
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById("results").innerHTML = '<img src="' + data_uri + '"/>';
                searchOnGoogle(data_uri);
                // Enable the submit button
                document.getElementById("submitButton").disabled = false;
            });
        }

        function searchOnGoogle(imageData) {
            // API request code...

        }

        history.pushState(null, null, location.href);
window.onpopstate = function (event) {
    history.go(1);
};

// Disable back button navigation
window.history.pushState(null, "", window.location.href);
window.onbeforeunload = function () {
    window.history.pushState(null, "", window.location.href);
};



        // Form validation
        document.getElementById("myForm").addEventListener("submit", function (event) {
            // Prevent form submission if snapshot is not taken
            if ($(".image-tag").val() === "") {
                event.preventDefault();
                alert("Please take a snapshot before submitting the form.");
            }
        });
    </script>
</body>

</html>

