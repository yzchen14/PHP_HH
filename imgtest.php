

<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle2.css?version=51">
<script src="inc/jquery.min.js"></script>

</head>

<body>

<img id="1" data-toggle="modal" data-target="#myModal" class="image" src="OM/01.jpg">

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-responsive" src=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
alter("OK");
$(document).ready(function () {
        $('#myModal').on('show.bs.modal', function (e) {
            var image = $(e.relatedTarget).attr('src');
            $(".img-responsive").attr("src", image);
        });
});
</script>
</body>

</html>

