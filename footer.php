<script type="text/javascript" integrity="sha256-fVrDNWdB+8wdKusutyJcfq0EFyVZit1SDHEpSEwITio=" crossorigin="anonymous">
    if (document.getElementById("table")) {
        $(document).ready(function () {
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "datatableProcess.php"
            });
        });
    }
    if (document.getElementById("modal")) {
        $(window).on('load', function () {
            $('#modal').modal('show');
        });
    }

</script>
<hr/>
<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">SIO SLAM MyWebApp &copy; 2019</span>
    </div>
</footer>

</body>
</html>
